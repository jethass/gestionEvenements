<?php
namespace Omea\GestionTelco\SfrLightMvnoBundle\SimCenter;

use Omea\GestionTelco\SfrLightMvnoBundle\Entity\StockNsce;

class StockNsceIterator implements \Iterator, \Countable
{
    protected $f;

    protected $data;

    protected $key;

    protected $batchNumber;

    protected $stockNsce;

    protected $count;

    const FILE_OFFSET = 19;

    /**
     * @param $file resource
     * @param $batchNumber integer
     * @throws \InvalidArgumentException
     */
    public function __construct($file, $batchNumber)
    {
        if (!is_resource($file)) {
            throw new \InvalidArgumentException('File sould be a resource');
        }

        if (!is_int($batchNumber)) {
            throw new \InvalidArgumentException('BatchNumber should be an integer');
        }
        $this->f = $file;
        $this->batchNumber = $batchNumber;
    }

    public function __destruct()
    {
        fclose($this->f);
    }

    public function current()
    {
        if (null === $this->stockNsce) {
            $values = array_map(function($line) {
                $value = trim(substr($line, 1));
                $value = ('' !== $value) ? $value : null;
                return $value;
            }, explode(';', $this->data));

            // Création de l'entité StockNsce
            $this->stockNsce = new StockNsce();
            $this->stockNsce
                ->setLot($this->batchNumber)
                ->setImsi($values[0])
                ->setIccid(substr($values[1], -14))
                ->setPuk1($values[3])
                ->setPuk2($values[5]);
        }

        return $this->stockNsce;
    }

    public function key()
    {
        return $this->key;
    }

    public function next()
    {
        $this->data = fgets($this->f);
        $this->stockNsce = null;
        $this->key++;
    }

    public function rewind()
    {
        fseek($this->f, self::FILE_OFFSET);
        $this->data = fgets($this->f);
        $this->key = 0;
    }

    public function valid()
    {
        return ((false !== $this->data) && 119 === strlen($this->data));
    }

    public function count()
    {
        if (null === $this->count) {
            $i = 0;
            $this->rewind();
            while ($this->valid()) {
                $this->next();
                $i++;
            }
            $this->count = $i;
        }

        return $this->count;
    }
}
