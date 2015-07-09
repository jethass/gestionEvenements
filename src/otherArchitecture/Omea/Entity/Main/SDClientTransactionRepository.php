<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class SDClientTransactionRepository extends EntityRepository {

    public function getTransactionsByClientIdSIMM($clientId)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('sd')
            ->from($this->getEntityName(), 'sd')
            ->innerJoin('sd.client', 'c')
            ->innerJoin('sd.transaction', 't')
            ->where($qb->expr()->eq('c.idClient', $clientId))
            ->orderBy('sd.dateCreationSD', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * fetch mobile name & price from a transaction id
     * @param $idTrans
     * @param null $idTe
     * @return mixed
     */
    public function getMobileInfoByIdTransSd($idTrans, $idTe)
    {
        //first, get idFils
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a2.idArticle', 'a2.titreAdv')
            ->from($this->getEntityName(), 'sd')
            ->innerJoin('sd.transaction', 't')
            ->innerJoin('t.commandes', 'c')
            ->innerJoin('c.article', 'a')
            ->innerJoin('a.artCombiPere', 'ac')
            ->innerJoin('ac.articleFils', 'a2')
            ->where($qb->expr()->eq('t.idTrans', $idTrans))
            ->andWhere($qb->expr()->eq('a2.typeEntite', $idTe))
        ;

        $result = $qb->getQuery()->getArrayResult();


        //if nothing found
        if (!isset($result[0])) return null;

        $fidelisationProduitRepo = $this->_em->getRepository('Omea\Entity\Main:FidelisationProduits');
        $fideProduit = $fidelisationProduitRepo->findOneBy(array('idArt' => $result[0]['idArticle']));

        $result[0]['montantNuTTC'] = $fideProduit->getMontantNuTTC();

        return $result[0];
    }

    /**
     * Fetch Client's ID from a transaction Id
     * @param $idTransSD
     * @return mixed string|null : If the client's id is find then it return
     *               it as a string, else null.
     */
    public function getClientIdByIdTransactionSIMM($idTransSIMM){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idClient')
           ->from($this->getEntityName(), 'sd')
           ->innerJoin('sd.client', 'c')
           ->where($qb->expr()->eq('sd.transaction', $idTransSIMM));

        $result =  $qb->getQuery()->getArrayResult();
        return (isset($result[0])?$result[0]:null);

    }

    /**
     * @param $idTransSIMM
     *
     * @return null
     */
    public function getTransactionSDByIdTransactionSIMM($idTransSIMM){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('sd')
           ->from($this->getEntityName(), 'sd')
           ->innerJoin("sd.transaction", "t")
           ->where($qb->expr()->eq('t.idTrans', $idTransSIMM));

        return  $qb->getQuery()->getSingleResult();
    }
}
