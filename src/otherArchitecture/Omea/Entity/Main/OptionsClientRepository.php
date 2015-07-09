<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class OptionsClientRepository extends EntityRepository
{

    /**
     * Recupere le faire use brut du client
     * @param  int $idClient
     * @return int $fairUse
     */
    public function GetFairUseByClient($idClient)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('ds.realValue')
        ->from($this->getEntityName(), 'oc')
        ->join('oc.forfaitOption','fo')
        ->join('fo.diseService','ds')
        ->where($qb->expr()
            ->eq('oc.idClient', ':idClient'))
        ->andWhere($qb->expr()
                ->orx()
                ->add($qb->expr()
                    ->gte('oc.dateFin', 'CURRENT_DATE()'))
                ->add($qb->expr()
                    ->isNull('oc.dateFin')))
        ->andWhere($qb->expr()
             ->lte('oc.dateDebut', 'CURRENT_DATE()'))
        ->andWhere($qb->expr()
              ->eq('ds.serviceType', ':serviceType'))

        ->setParameters(array(
            'idClient' => $idClient,
            'serviceType' => 'FAIRUSE'
        ));

        $result = $qb->getQuery()->getResult();

        if ($result) {
            return $result[0]['realValue'];
        } else {
            return 0;
        }
    }

    /**
     * Recupere le faire use roaming brut du client
     * @param  int $idClient
     * @return int $fairUse
     */
    public function GetFairUseRoamingByClient($idClient)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('ds.realValue')
        ->from($this->getEntityName(), 'oc')
        ->join('oc.forfaitOption','fo')
        ->join('fo.diseService','ds')
        ->where($qb->expr()
            ->eq('oc.idClient', ':idClient'))
            ->andWhere($qb->expr()
                ->orx()
                ->add($qb->expr()
                    ->gte('oc.dateFin', 'CURRENT_DATE()'))
                ->add($qb->expr()
                    ->isNull('oc.dateFin')))
        ->andWhere($qb->expr()
            ->lte('oc.dateDebut', 'CURRENT_DATE()'))
        ->andWhere($qb->expr()
            ->eq('ds.serviceType', ':serviceType'))

        ->setParameters(array(
            'idClient' => $idClient,
            'serviceType' => 'FAIRUSE_ROAMING'
        ));

        $result = $qb->getQuery()->getResult();

        if ($result) {
            return $result[0]['realValue'];
        } else {
            return 0;
        }
    }

    /**
     * verifi si le client a l'option actif
     * @param  int $idClient
     * @return boolean $fairUse
     */
    public function HasOption($idClient, $idOption)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('oc.idOc')
        ->from($this->getEntityName(), 'oc')
        ->join('oc.forfaitOption','fo')
        ->where($qb->expr()
            ->eq('oc.idClient', ':idClient'))
        ->andWhere($qb->expr()
            ->orx()
            ->add($qb->expr()
                ->gte('oc.dateFin', 'CURRENT_DATE()'))
            ->add($qb->expr()
                ->isNull('oc.dateFin')))
        ->andWhere($qb->expr()
            ->lte('oc.dateDebut', 'CURRENT_DATE()'))
        ->andWhere($qb->expr()
                ->eq('fo.idOption', ':idOption'))

        ->setParameters(array(
            'idClient' => $idClient,
            'idOption' => $idOption
        ));

        $result = $qb->getQuery()->getResult();

        if (sizeof($result) && $result[0]['idOc']) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * verifi si le client a l'option actif ou l'aura après provisioning
     * @param  int $idClient
     * @return int $fairUse
     */
    public function willHaveOption($idClient, $idOption)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('oc.idOc')
        ->from($this->getEntityName(), 'oc')
        ->join('oc.forfaitOption','fo')
        ->where($qb->expr()
            ->eq('oc.idClient', ':idClient'))
        ->andWhere($qb->expr()
            ->orx()
            ->add($qb->expr()
                ->gte('oc.dateFin', 'CURRENT_DATE()'))
            ->add($qb->expr()
                ->isNull('oc.dateFin')))
        ->andWhere($qb->expr()
            ->eq('fo.idOption', ':idOption'))

        ->setParameters(array(
            'idClient' => $idClient,
            'idOption' => $idOption
        ));

        $result = $qb->getQuery()->getResult();

        if (sizeof($result) && $result[0]['idOc']) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retourne toutes les options actives du client
     * @param  int $idClient
     * @return arrau $options
     */
    public function getOptionsActive($idClient)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('fo.idOption')
        ->from($this->getEntityName(), 'oc')
        ->join('oc.forfaitOption','fo')
        ->where($qb->expr()
        ->eq('oc.idClient', ':idClient'))
        ->andWhere(
            $qb->expr()->orx()
                ->add($qb->expr()->gte('oc.dateFin', 'CURRENT_DATE()'))
                ->add($qb->expr()->isNull('oc.dateFin'))
        )
        ->andWhere(
            $qb->expr()->lte('oc.dateDebut', 'CURRENT_DATE()')
        )

        ->setParameter('idClient', $idClient);

        $result = $qb->getQuery()->getResult();

        return $result;
    }

    /**
     * Liaison d'une option client en mode performant
     * @param integer $idClient
     * @param integer $idForfaitOption
     * @param \DateTime $dateRAZMoinsUn
     * @return \Doctrine\DBAL\Statement $statement
     */
    public function insertOption($idClient, $idForfaitOption, \DateTime $dateRAZMoinsUn)
    {
        $con = $this->getEntityManager()->getConnection();
        $metadata = $this->getClassMetadata();
        $sql = sprintf('INSERT INTO %s (%s, %s, %s) VALUES (%d, %d, %s)',
            $metadata->getTableName(),
            $metadata->getColumnName('idForfaitOption'),
            $metadata->getColumnName('idClient'),
            $metadata->getColumnName('dateDebut'),
            $idClient,
            $idForfaitOption,
            $con->quote($dateRAZMoinsUn->format('Y-m-d'))
        );
        return $con->executeQuery($sql);
    }

    /**
     * @param $idClient
     * @param \DateTime $dateMig
     * @return \Doctrine\DBAL\Statement $statement
     */
    public function getPendingOptions($idClient, \DateTime $dateMig)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT ID_OC FROM
                MAIN_VM.OPTIONS_CLIENT OC
                WHERE OC.ID_CLIENT = " . $idClient . "
                AND OC.DATE_DEBUT >= " . $conn->quote($dateMig->format('Y-m-d'));

        $statement = $conn->executeQuery($sql);

        return $statement;
    }

}
