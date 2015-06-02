<?php
namespace Omea\GestionTelco\SfrLightMvnoBundle\SimCenter;

/**
 * Parse un fichier SimCenter est retourne une collection d'Entit� StockNSCE
 * @see Document de spécification des interfaces Sim Center
 */
class SimCenterParser
{
    /**
     * Flux à parser
     * @var string
     */
    private $stream;

    /**
     * Url vers le fichier SimCenter
     * @var [type]
     */
    private $url;

    /**
     * Gestionnaire d'erreur fopen
     * @var string
     */
    private $errorMessage;

    /**
     * Numéro du lot
     * @var integer
     */
    private $batchNumber;

    /**
     * Checksum du fichier sim center
     * @var string
     */
    private $checksum;

    /**
     * Validation du numéro du lot
     */
    const BATCH_NUMBER_PATTERN = "/[0-9]{17}\s{2}/";

    /**
     * Validation du checksum
     */
    const CHECKSUM_PATTERN = "/\n[0-9]{4}\n/";

    public function __construct($stream)
    {
        if (is_resource($stream)) {
            $this->stream = $stream;
        } elseif (is_string($stream)) {
            $this->url = $stream;
        } else {
            throw new \InvalidArgumentException("\$stream doit être soit une ressource soit une chaine.");
        }
    }

    /**
     * Retourne un flux à partir de l'adresse d'un fichier
     * @return resource
     */
    public function getStream()
    {
        if(!is_resource($this->stream)) {
            $this->errorMessage = null;
            set_error_handler(array($this, 'fileErrorHandler'));
            $this->stream = fopen($this->url, 'rb');
            restore_error_handler();

            if (!is_resource($this->stream)) {
                $this->stream = null;
                throw new \UnexpectedValueException(sprintf('The stream or file "%s" could not be opened: ' . $this->errorMessage, $this->url));
            }

            if (false === $this->isValid()) {
                throw new \RuntimeException('This is not a valid SimCenter file');
            }
        }

        return $this->stream;
    }

    /**
     * Gestionnaire d'erreur pour fopen
     * @return void
     */
    private function fileErrorHandler($code, $msg)
    {
        $this->errorMessage = preg_replace('{^fopen\(.*?\): }', '', $msg);
    }

    public function getBatchNumber()
    {
        if (null === $this->batchNumber) {
            $stream = $this->getStream();
            rewind($stream);
            $buffer = fread($stream, 19);
            if (1 !== preg_match(self::BATCH_NUMBER_PATTERN, $buffer)) {
                throw new \RuntimeException("Impossible d'extraire le numéro du lot");
            }
            $this->batchNumber = (int) $buffer;
        }

        return $this->batchNumber;
    }

    /**
     * Récupère le checksum du fichier
     *
     * @return string
     */
    public function getChecksum()
    {
        if (null === $this->checksum) {
            $stream = $this->getStream();
            fseek($stream, -6, SEEK_END);
            $checksum = fread($stream, 6);
            if (1 !== preg_match(self::CHECKSUM_PATTERN, $checksum)) {
                throw new \RuntimeException('Cannot extract checksum from file');
            }
            $this->checksum = trim($checksum);
        }

        return $this->checksum;
    }

    /**
     * Le fichier est-il un fichier SimCenter?
     *
     * @todo Valider le checksum, ici on s'assure seulement qu'on arrive à l'extraire du fichier
     * @return bool
     */
    public function isValid()
    {
        $valid = true;
        try {
            $this->getChecksum();
        } catch (\RuntimeException $e) {
            $valid = false;
        }

        return $valid;
    }

    /**
     * Retourne une intérateur d'entité StockNsce
     * @return StockNsceIterator
     */
    public function getStockNsceIterator()
    {
        return new StockNsceIterator($this->getStream(), $this->getBatchNumber());
    }
}
