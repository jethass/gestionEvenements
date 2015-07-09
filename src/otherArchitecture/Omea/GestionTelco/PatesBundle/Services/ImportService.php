<?php
namespace Omea\GestionTelco\PatesBundle\Services;

use Doctrine\ORM\EntityManager;
use Omea\Entity\Main\StockImei;
use Omea\GestionTelco\PatesBundle\Entity\FemtoStock;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Omea\GestionTelco\PatesBundle\Exception\TechnicalException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ImportService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityManager
     */
    private $emMain;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var array
     */
    private $importConfig;

    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param array $importConfig
     */
    public function __construct(
        LoggerInterface $logger,
        RegistryInterface $doctrine,
        array $importConfig
    ) {
        $this->logger = $logger;
        $this->em = $doctrine->getManager();
        $this->emMain = $doctrine->getManager('main');
        $this->importConfig = $importConfig;
    }

    /**
     * Handle the import of an application
     *
     * @param $application
     * @return bool
     * @throws \Exception
     */
    public function import($application)
    {
        $this->logger->info('Start import of '.$application);

        // Prod conf: /home/gestiontelco_vm
        $dirPath = $this->importConfig['data_path'];
        $applicationPath = $dirPath.$application;

        // Check that the application directory exists
        if (!is_dir($applicationPath)) {
            $error = 'Import - the folder '.$applicationPath.' does not exists';
            $this->logger->error($error);
            throw new NotFoundException($error);
        }

        $todoPath = $applicationPath.'/TO_DO';

        $this->logger->info('Get files to proceed from '.$todoPath);

        $finder = new Finder();
        // Find all the .csv files in the given path
        $finder->files()
            ->in($todoPath)
            ->name('*.csv')
        ;

        foreach ($finder as $file) {
            $this->logger->info('Start treatment of file ' . $file->getPathName());

            // Start the transactions
            $this->logger->info('Begin transaction');
            $this->em->getConnection()->beginTransaction();
            $this->emMain->getConnection()->beginTransaction();

            try {
                $this->logger->info('Parsing');
                $rows = $this->parseCSVFile($file);
                $this->logger->info('Insert rows parsed');
                $this->insertRows($rows);

                $this->logger->info('Flush');
                $this->em->flush();
                $this->emMain->flush();

                $this->logger->info('Commit the transaction');
                $this->em->getConnection()->commit();
                $this->emMain->getConnection()->commit();

                $this->logger->info('Move the file to the DONE directory');
                $this->moveCSVFile($file, $applicationPath.'/DONE');
            } catch (\Exception $e) {
                $this->em->getConnection()->rollBack();
                $this->emMain->getConnection()->rollBack();

                $this->logger->error('Error on the file '.$file->getPathName().' with message : '.$e->getMessage());

                $this->logger->info('Move the file to the ERROR directory');
                $this->moveCSVFile($file, $applicationPath.'/ERROR');
            }
            $this->logger->info('End of treatment of file ' . $file->getPathName());
        }
        $this->logger->info('End import of '.$application);
        return true;
    }

    /**
     * Parse the given file
     *
     * @param SplFileInfo $file
     * @return array
     */
    public function parseCSVFile(SplFileInfo $file)
    {
        $rows = array();
        if (($handle = fopen($file->getPathName(), "r")) !== false) {
            $i = 0;
            while (($data = fgetcsv($handle, null, ";")) !== false) {
                $i++;
                if ($i == 1) {
                    continue;
                }
                $rows[] = $data;
            }
            fclose($handle);
        }
        return $rows;
    }

    /**
     * Move the given file to the given path
     *
     * @param SplFileInfo $file
     * @param $path
     * @return bool
     */
    public function moveCSVFile(SplFileInfo $file, $path)
    {
        $currentPath = $file->getPathname();

        if (!file_exists($currentPath)) {
            throw new NotFoundException('The file '.$currentPath.' does not exists');
        }

        if (!is_dir($path)) {
            throw new NotFoundException('The path '.$path.' does not exists');
        }

        return rename($currentPath, $path.'/'.$file->getFilename());
    }

    /**
     * Insert an array of row to database
     *
     * @param array $rows
     * @return bool
     * @throws \Exception
     */
    public function insertRows(array $rows)
    {
        $article = $this->emMain->getRepository('Omea\Entity\Main\Article')->find(556000);

        if (empty($article)) {
            throw new TechnicalException('The article with id 556000 does not exists');
        }

        foreach ($rows as $row) {
            try {
                $femtoStock = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoStock')->find($row[0]);
                $stockImei = $this->emMain->getRepository('Omea\Entity\Main\StockImei')->find($row[0]);

                if (!empty($femtoStock)) {
                    throw new TechnicalException('A FemtoStock object already exists for imei :'.$row[0]);
                }
                if (empty($stockImei)) {
                    $stockImei = new StockImei();
                    $stockImei->setImei($row[0]);
                    $stockImei->setArticle($article);
                    $stockImei->setIdEs(1);
                    $stockImei->setDateCreation(new \DateTime());
                    $stockImei->setDateDernMaj(new \DateTime());

                    $this->emMain->persist($stockImei);
                }

                $femtoStock = new FemtoStock();
                $femtoStock->setImei($row[0]);
                $femtoStock->setAdresseMac($row[2]);
                $femtoStock->setManufacturer('Ubiquisys');
                $femtoStock->setProductClass($row[4]);
                $femtoStock->setOui(substr(str_replace(':', '', $row[2]), 0, 6));

                $this->em->persist($femtoStock);
            } catch (\Exception $e) {
                $this->logger->error('Error during insert of row '.$row[0].' with message : '.$e->getMessage());
                throw $e;
            }
        }
        return true;
    }
}
