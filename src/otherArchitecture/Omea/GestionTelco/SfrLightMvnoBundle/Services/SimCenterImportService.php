<?php
namespace Omea\GestionTelco\SfrLightMvnoBundle\Services;

use Omea\GestionTelco\PatesBundle\Exception\TechnicalException;
use Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatEntite;
use Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatStock;
use Omea\GestionTelco\SfrLightMvnoBundle\SimCenter\StockNsceIterator;
use Omea\GestionTelco\SfrLightMvnoBundle\SimCenter\SimCenterParser;
use Psr\Log\LoggerInterface;
use SebastianBergmann\Exporter\Exception;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;

class SimCenterImportService
{
    protected $logger;
    protected $doctrine;

    const BATCH_SIZE = 500;
    const TODO_DIR_PATH = '/TO_DO/';
    const ERROR_DIR_PATH = '/ERROR/';
    const DONE_DIR_PATH = '/DONE/';
    const DEFAULT_ETAT_ENTITE = 0;
    const DEFAULT_ETAT_STOCK = 1;
    const SFR_ID_NETWORK = 2;

    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine) {
        $this->logger = $logger;
        $this->doctrine = $doctrine;
    }

    private function moveFileToDir($path, $directory)
    {
        $file = new File($path);
        return $file->move($directory);
    }

    /*
     * Function checkFileIsNotAlreadyImported
     *
     * Vérifie que le fichier n'a pas déjà été importé, en vérifiant si la première ligne n'est pas présente dans la BDD
     *
     *
     * @param (EntityManager $em)
     * @param (Object $simcenterParser) Classe parsant le fichier à importer, contenant également un itérateur sur celui-ci
     * @return (void)
     */
    public function checkFileIsNotAlreadyImported($filename, $simCenterParser)
    {
        $em = $this->doctrine->getManager('main');
        $it = $simCenterParser->getStockNsceIterator();
        $it->next();


        $stockNsce = $em->getRepository('SfrLightMvnoBundle:StockNsce')->findOneBy(array(
            'lot' => $it->current()->getLot(),
            'imsi' => $it->current()->getImsi(),
            'iccid' => $it->current()->getIccid(),
            'puk1' => $it->current()->getPuk1(),
            'puk2' => $it->current()->getPuk2()
        ));

        if ($stockNsce != null)
            throw new TechnicalException("Le fichier $filename est déjà présent en base de données.");
    }

    /**
     * Importe les carte sim depuis les fichiers sim center
     *
     * @todo Rendre les exceptions plus explicite
     * @return bool
     */
    public function import($importPath)
    {
        $this->logger->info("Début traitement SimCenter");
        $finder = new Finder();
        $finder->files()->in($importPath . self::TODO_DIR_PATH);

        /** @var \SplFileInfo $fileInfo */
        foreach ($finder as $fileInfo) {

            $filename = $fileInfo->getPathname();

            $this->logger->info("Début import fichier SimCenter", array('filename' => $filename));

            $simCenterParser = new SimCenterParser($filename);
            try {
                $this->checkFileIsNotAlreadyImported($filename, $simCenterParser);

                $this->batchPersist($simCenterParser->getStockNsceIterator());
                $this->moveFileToDir($filename, $importPath . self::DONE_DIR_PATH);
            // fichier invalide
            } catch (\RuntimeException $e) {
                $file = $this->moveFileToDir($filename, $importPath . self::ERROR_DIR_PATH);
                $this->logger->error('Fichier SimCenter invalide',
                    array(
                        'filename' => $file->getPathname(),
                        'message' => $e->getMessage()
                    ));
            // erreur doctrine
            } catch (\TechnicalException $e) {
                $file = $this->moveFileToDir($filename, $importPath . self::ERROR_DIR_PATH);
                $this->logger->error('Fichier SimCenter déjà importé',
                    array(
                        'filename' => $file->getPathname(),
                        'message' => $e->getMessage()
                    ));
                // erreur doctrine
            } catch (\Exception $e) {
                $file = $this->moveFileToDir($filename, $importPath . self::ERROR_DIR_PATH);
                $this->logger->error('Erreur lors de l\'écriture des données',
                    array(
                        'filename' => $file->getPathname(),
                        'message' => $e->getMessage()
                    )
                );
            }

            $this->logger->info("Fin import fichier SimCenter", array('filename' => $filename));
        }

        $this->logger->info('Fin traitement SimCenter');

        return true;
    }

    private function batchPersist(StockNsceIterator $iterator)
    {
        $em = $this->doctrine->getManager('main');
        $conn = $em->getConnection();

        $conn->beginTransaction();

        // Récupération des relations pour enrichir stockNsce

        try {
            $i = 0;

            $etatEntite = $em->getRepository('SfrLightMvnoBundle:EtatEntite')->find(self::DEFAULT_ETAT_ENTITE);
            $etatStock = $em->getRepository('SfrLightMvnoBundle:EtatStock')->find(self::DEFAULT_ETAT_STOCK);

            /** @var \Omea\GestionTelco\SfrLightMvnoBundle\Entity\StockNsce $stockNsce */
            foreach ($iterator as $stockNsce) {

                $this->logger->debug('Import Sim', array(
                    'lot'   => $stockNsce->getLot(),
                    'imsi'  => $stockNsce->getImsi(),
                    'iccid' => $stockNsce->getIccid(),
                    'puk1'  => $stockNsce->getPuk1(),
                    'puk2'  => $stockNsce->getPuk2(),
                ));

                // Ajoutes les relations adéquats
                $stockNsce->setEtatStock($etatStock);
                $stockNsce->setEtatEntite($etatEntite);
                $stockNsce->setIdNetwork(self::SFR_ID_NETWORK);

                $em->persist($stockNsce);

                $i++;
                // A implémenter
                if ($i % self::BATCH_SIZE) {
                    $em->flush();
                    $em->clear('Omea\GestionTelco\SfrLightMvnoBundle\Entity\StockNsce');
                }
            }
            $em->flush();
            $em->clear();
            $conn->commit();
        } catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }

}
