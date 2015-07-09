<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class RegulPrepaiementRepository extends EntityRepository
{

    /**
     * @param $interval
     * @return array
     */
    public function getRegulationsToSendMit($interval)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select(
            'c.idClient',
            'cp.idClientPrepaiement',
            'rp.idRegulPrepaiement',
            'ccm.codeComptable',
            'ccm.signe',
            'rp.dateEffetMit',
            'rp.montant'
            )
            ->from($this->getEntityName(), 'rp')
            ->innerJoin('rp.clientPrepaiement', 'cp')
            ->innerJoin('cp.client', 'c')
            ->innerJoin('rp.codeComptableMit', 'ccm')
            ->innerJoin('rp.billing', 'b')
            ->where($qb->expr()->isNull('b.idBilling'))
            ->andWhere($qb->expr()->isNull('rp.dateEnvoiMit'))
            ->andWhere($qb->expr()->eq('rp.dateEffetMit', ':dateEffetMit'))
            ->orderBy('rp.idRegulPrepaiement', 'ASC')
            ;

        $qb->setParameter('dateEffetMit', (new \DateTime($interval))->format('Y-m-d'));

        return $qb->getQuery()->getResult();
    }

    /**
     * update a regulation
     * @param $idRegul
     * @param $idBilling
     * @return mixed
     */
    public function setMitSent($idRegul, $idBilling)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->update($this->getEntityName(), 'rp')
            ->set('rp.dateEnvoiMit', ':current')
            ->set('rp.billing', ':idBilling')
            ->where($qb->expr()->eq('rp.idRegulPrepaiement', ':idRegul'))
            ->setMaxResults(1)
            ;
        $qb->setParameter('current', new \DateTime());
        $qb->setParameter('idBilling', $idBilling);
        $qb->setParameter('idRegul', $idRegul);

        return $qb->getQuery()->execute();
    }
}
