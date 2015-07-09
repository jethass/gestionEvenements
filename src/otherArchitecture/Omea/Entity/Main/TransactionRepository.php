<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class TransactionRepository extends EntityRepository
{

    /**
     * Counts number of commands with an ID_TRANS
     * @param $idTrans
     * @return mixed
     */
    public function getCountCommandesByIdTrans($idTrans)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('COUNT(c)')
            ->from($this->getEntityName(), 't')
            ->innerJoin('t.commandes', 'c')
            ->where($qb->expr()->eq('t.idTrans', $idTrans));

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * fetch mobile name & price from a transaction id
     * @param $idTrans
     * @param null $idTe
     * @return mixed
     */
    public function getMobileInfoByIdTrans($idTrans, $idTe = null)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a.titreAdv', 'fp.montantNuTTC')
            ->from($this->getEntityName(), 't')
            ->innerJoin('t.commandes', 'c')
            ->innerJoin('c.article', 'a')
            ->innerJoin('a.fidelisationProduit', 'fp')
            ->where($qb->expr()->eq('t.idTrans', $idTrans))
            ;
        if($idTe!==null){
            $qb->andWhere($qb->expr()->eq('a.typeEntite', $idTe));
        }

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param $idTrans
     * @return mixed
     */
    public function getTransaction($idTrans)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from($this->getEntityName(), 'c')
            ->where($qb->expr()
                    ->eq('c.idTrans', ':idTrans'))
            ->setParameters(array(
                    'idTrans' => $idTrans
                ));

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * met à jour l'adresse de livraison
     * @param $idTrans
     * @param $info
     * @return mixed
     */
    public function updateAdresse($idTrans, $info)
    {
        //to upper case
        $numeroRue = strtoupper($info['numeroRue']);
        $adresse = strtoupper($info['adresse']);
        $adresseComplement = strtoupper($info['adresseComplement']);
        $ville = strtoupper($info['ville']);

        $qb = $this->_em->createQueryBuilder();
        $qb->update($this->getEntityName(), 't')
            ->set('t.numeroRue', $qb->expr()->literal($numeroRue))
            ->set('t.adrLiv', $qb->expr()->literal($adresse))
            ->set('t.adrComplLiv', $qb->expr()->literal($adresseComplement))
            ->set('t.codposLiv', $qb->expr()->literal($info['codePos']))
            ->set('t.villeLiv', $qb->expr()->literal($ville))
            ->where($qb->expr()->eq('t.idTrans', $idTrans))
        ;

        return $qb->getQuery()->execute();
    }

    /**
     * @param $idClient
     * @param $idArtPackTelib
     * @return mixed
     */
    public function getTelibCommande($idClient, $idArtPackTelib)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idCmd');
        $qb->from($this->getEntityName(), 't');
        $qb->innerJoin('t.commandes', 'c');
        $qb->where($qb->expr()->eq('c.idArt', ':idArtPackTelib'));
        $qb->andWhere($qb->expr()->eq('t.idClient', ':idClient'));
        $qb->andWhere($qb->expr()->isNull('t.transAnnule'));
        $qb->setParameter('idArtPackTelib', $idArtPackTelib);
        $qb->setParameter('idClient', $idClient);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param string $msisdn
     *
     * @return integer
     */
    public function countSimSavTransactionsForMsisdn($msisdn)
    {
        $results = $this->createQueryBuilder('t')
            ->select('COUNT(t) as nbTransactions')
            ->innerJoin('t.commandes', 'co')
            ->innerJoin('t.client', 'cl')
            ->innerJoin('cl.stockMsisdn', 'sm')
            ->innerJoin('co.article', 'a')
            ->innerJoin('a.simTypes', 'st')
            ->innerJoin('st.simFormats', 'sf')
            ->where('st.usage = :usageSav')
            ->setParameter('usageSav', 'SAV')
            ->andWhere('sm.msisdn = :msisdn')
            ->setParameter('msisdn', $msisdn)
            ->groupBy('t.idTrans')
            ->getQuery()
            ->getArrayResult();

            return isset($results[0]['nbTransactions'])
                ? $nbTransactions = $results[0]['nbTransactions']
                : 0;
    }

    /**
     * @param integer $clientId
     *
     * @return Transaction|null
     */
    public function findLastSimSAVByClient($clientId)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.commandes', 'c')
            ->leftJoin('c.stockNsce', 'sn')
            ->where('t.idClient = :idClient')
            ->andWhere('t.idDis = :idDis')
            ->andWhere('t.idMag = :idMag')
            ->andWhere('sn.msisdn IS NULL')
            ->setParameters(array(
                'idClient'  => $clientId,
                'idDis'     => 500,
                'idMag'     => 5,
            ))
            ->orderBy('t.dateDerneMaj', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
