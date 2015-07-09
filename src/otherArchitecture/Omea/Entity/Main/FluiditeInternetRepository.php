<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class FluiditeInternetRepository extends EntityRepository
{
    /**
     * @param $etat
     * @param $date
     * @return array
     */
    public function getFluiditeATraite($etat, $date)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('fi,fio,a')
            ->from($this->getEntityName(), 'fi')
            ->leftJoin('fi.fluiditeInternetOptions', 'fio')
            ->leftJoin('fi.adresse', 'a')
            ->where($qb->expr()->lte('fi.dateDemande', ':date'))
            ->andWhere($qb->expr()->eq('fi.etat', ':etat'))
            ->orderBy('fi.idFluiditeInternet', 'DESC')
        ->setParameters(array('date' => $date, 'etat' => $etat));

        $result = $qb->getQuery()->getArrayResult();

        return $result;
    }

    /**
     * @param $etat
     * @param $date
     * @return array
     */
    public function getFluiditeAFinalise($etat, $date)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('fi,fio')
        ->from($this->getEntityName(), 'fi')
        ->leftJoin('fi.fluiditeInternetOptions', 'fio')
        ->where($qb->expr()->lte('fi.dateFluidite', ':date'))
        ->andWhere($qb->expr()->eq('fi.etat', ':etat'))
        ->orderBy('fi.idFluiditeInternet', 'DESC')
        ->setParameters(array('date' => $date, 'etat' => $etat));

        $result = $qb->getQuery()->getArrayResult();

        return $result;
    }

    public function getFluiditeByDateFluidite(array $etat, \DateTime $date) {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('fi')
        ->from($this->getEntityName(), 'fi')
        ->where($qb->expr()->in('fi.etat', ':etat'))
        ->andWhere($qb->expr()->like('fi.dateFluidite', ':date'))
        ->orderBy('fi.dateDemande', 'DESC')
        ->setParameters(array('date' => $date->format('Y-m-d').'%', 'etat' => $etat));

        $result = $qb->getQuery()->getResult();
        return $result;
    }
}
