<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class FidelisationHistoriqueRepository extends EntityRepository
{
    public function getRmInfo($idClient)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('f.idfhis', 'f.prixFidHt', 'f.subventionHt', 'f.dateEngagement', 'a.titreMarket', 'e.idEngagement', 'e.dateFin', 't.montantTotal', 't.idTrans'))
            ->from($this->getEntityName(), 'f')
            ->innerJoin('f.client', 'c')
            ->innerJoin('c.stockMsisdn', 's')
            ->leftJoin('c.engagements', 'e', JOIN::WITH , 'e.motif = :motif and e.etat = \'1\'')
            ->innerJoin('f.transaction', 't')
            ->innerJoin('t.commandes', 'comm')
            ->innerJoin('comm.article', 'a')
            ->where($qb->expr()->eq('f.idClient', $idClient))
            ->andWhere($qb->expr()->isNull('t.transAnnule'))
            ->orderBy('f.idfhis', 'DESC');

        $qb->setParameter('motif', 'FIDE');

        $result = $qb->getQuery()->getArrayResult();

        return (isset($result[0])) ? $result[0] : null;
    }

    public function getLastRmInfo($idClient)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('f.idfhis', 'f.prixFidHt', 'f.subventionHt', 'f.dateEngagement', 'a.titreMarket', 'e.idEngagement', 'e.dateFin', 't.montantTotal', 't.idTrans'))
            ->from($this->getEntityName(), 'f')
            ->innerJoin('f.client', 'c')
            ->innerJoin('c.stockMsisdn', 's')
            ->leftJoin('c.engagements', 'e', JOIN::WITH , 'e.etat = \'1\'')
            ->innerJoin('f.transaction', 't')
            ->innerJoin('t.commandes', 'comm')
            ->innerJoin('comm.article', 'a')
            ->where($qb->expr()->eq('f.idClient', $idClient))
            ->orderBy('f.idfhis', 'DESC');

        $result = $qb->getQuery()->getArrayResult();

        return (isset($result[0])) ? $result[0] : null;
    }

    public function getRmInfoWithMig($idClient, $idMig)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select(array('f.idfhis', 'f.prixFidHt', 'f.subventionHt', 'f.dateEngagement', 'a.titreMarket', 'e.idEngagement', 'e.dateFin', 't.montantTotal', 't.idTrans'))
            ->from($this->getEntityName(), 'f')
            ->innerJoin('f.client', 'c')
            ->innerJoin('c.stockMsisdn', 's')
            ->leftJoin('c.engagements', 'e', JOIN::WITH , 'e.motif = :motif and e.etat = \'1\'')
            ->innerJoin('f.transaction', 't')
            ->innerJoin('t.commandes', 'comm')
            ->innerJoin('comm.article', 'a')
            ->where($qb->expr()->eq('f.idClient', $idClient))
            ->andWhere($qb->expr()->isNull('t.transAnnule'))
            ->andWhere($qb->expr()->eq('f.idMig', $idMig))
            ->orderBy('f.idfhis', 'DESC');

            $qb->setParameter('motif', 'FIDE');

            $result = $qb->getQuery()->getArrayResult();

            return (isset($result[0])) ? $result[0] : null;
    }

    public function checkIfTransactionAnnulee($idClient)
    {
        $mailVM = "MAIN_VM";
        $sql = "
          SELECT TR.* FROM " . $mailVM . ".TRANSACTION TR
                INNER JOIN " . $mailVM . ".FIDELISATION_HISTORIQUE FH ON FH.IDFHIS = TR.IDFHIS
                WHERE FH.ID_CLIENT = :idClient AND TR.TRANS_ANNULE IS NOT NULL ORDER BY FH.IDFHIS DESC LIMIT 1";

        $stmt = $this->_em->getConnection()->prepare($sql);
        $stmt->bindValue('idClient', $idClient);

        $stmt->execute();
        $res = $stmt->fetchAll();
        $stmt->closeCursor();

        return (isset($res[0])) ? $res[0] : null;
    }
}
