<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

/**
 */
class ClientRepository extends EntityRepository
{

    public function test($idClient)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('cc.idContrat')
           ->from($this->getEntityName(), 'c')
           ->join('c.contrat','cc')
           ->where($qb->expr()
                ->eq('c.idClient', ':idClient'))

        ->setParameters(array(
            'idClient' => $idClient
        ));
        $result = $qb->getQuery()->getResult();

        return $result;
    }

    public function getBasicInfo($idClient)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c', 'cv', 's', 'cy')
            ->from($this->getEntityName(), 'c')
            ->leftJoin('c.stockMsisdn', 's')
            ->leftJoin('c.civilite', 'cv')
            ->leftJoin('c.cycle', 'cy')
            ->where($qb->expr()
                    ->eq('c.idClient', ':idClient'))
            ->setParameters(array(
                    'idClient' => $idClient
                ));
        $result = $qb->getQuery()->getArrayResult();

        return (isset($result[0]))?$result[0]:null;
    }

    /**
     * @param $idClient
     *
     * @return Client
     */
    public function getClient($idClient)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from($this->getEntityName(), 'c')
            ->where($qb->expr()
                    ->eq('c.idClient', ':idClient'))
            ->setParameters(array(
                    'idClient' => $idClient
                ));

        return $qb->getQuery()->getSingleResult();
    }

    public function updateAdresse($idClient, $info)
    {
        //to upper case
        $numeroRue = strtoupper($info['numeroRue']);
        $adresse = strtoupper($info['adresse']);
        $adresseComplement = strtoupper($info['adresseComplement']);
        $ville = strtoupper($info['ville']);

        $qb = $this->_em->createQueryBuilder();
        $qb->update($this->getEntityName(), 'c')
            ->set('c.numeroRue', $qb->expr()->literal($numeroRue))
            ->set('c.adresse', $qb->expr()->literal($adresse))
            ->set('c.adresseComplement', $qb->expr()->literal($adresseComplement))
            ->set('c.codePos', $qb->expr()->literal($info['codePos']))
            ->set('c.ville', $qb->expr()->literal($ville))
            ->where($qb->expr()->eq('c.idClient', $idClient))
        ;

        return $qb->getQuery()->execute();
    }

    public function getAdresses($offset, $max)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c.idClient', 'c.numeroRue', 'c.adresse', 'c.adresseComplement', 'c.codePos', 'c.ville')
           ->from($this->getEntityName(), 'c')
           ->where($qb->expr()->neq('c.nom', $qb->expr()->literal('ANONYMATOR')))
           ->andWhere($qb->expr()->neq('c.nom', $qb->expr()->literal('ROBOT_ACTIVATION_PREPAYE')))
           ->andWhere($qb->expr()->neq('c.prenom', $qb->expr()->literal('ANONYMATOR')))
           ->andWhere($qb->expr()->neq('c.prenom', $qb->expr()->literal('ROBOT_ACTIVATION_PREPAYE')))
           ->andWhere($qb->expr()->neq('c.adresse', $qb->expr()->literal('ANONYMATOR')))
           ->andWhere($qb->expr()->neq('c.adresseComplement', $qb->expr()->literal('ANONYMATOR')))
           ->andWhere($qb->expr()->neq('c.ville', $qb->expr()->literal('ANONYMATOR')))
           ->andWhere($qb->expr()->neq('c.ville',$qb->expr()->literal( 'ANONYMATOR')))
           ->setFirstResult($offset)
           ->setMaxResults($max)
           ;
        return $qb->getQuery()->getArrayResult();
    }

    public function getClientFrom4P($idFoyer, $typeClient = "EST_MOBILE", $typeFoyer = "4P")
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.foyer', 'f')
            ->where('c.foyer = :idFoyer')
            ->andWhere('c.typeClient = :typeClient')
            ->andWhere('f.typeFoyer = :typeFoyer')
            ->setParameters(
                array(
                    'idFoyer'   => $idFoyer,
                    'typeClient' => $typeClient,
                    'typeFoyer'  => $typeFoyer
                )
            );

        if($typeClient == "EST_3P") {
            // recherche du client ADSL associe:
            // on ne retourne que la ligne active
            $statutSouscriptionLigneActive = 2;
            $qb = $qb->innerJoin('c.contrat', 'co');
            $qb = $qb->andWhere('co.statutSouscription = :statutSouscriptionLigneActive');
            $qb = $qb->setParameter('statutSouscriptionLigneActive', $statutSouscriptionLigneActive);
        } else {
            // recherche du client mobile associe:
            // on ne retourne que la ligne active
            $statutAbonnementLigneActive = 'A';
            $qb = $qb->innerJoin('c.stockMsisdn', 'ms');
            $qb = $qb->innerJoin('ms.diseAbonnement', 'da');
            $qb = $qb->andWhere('da.statutAbonnement = :statutAbonnementLigneActive');
            $qb = $qb->setParameter('statutAbonnementLigneActive', $statutAbonnementLigneActive);
        }

        $qb->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getDistributorFromClient($clientId)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('sn.idDis', 'sn.idMag')
            ->from($this->getEntityName(), 'c')
            ->innerJoin('c.stockMsisdn', 'sm')
            ->innerJoin('sm.stocknsce', 'sn')
            ->where($qb->expr()->eq('c.idClient', ':clientId'))
            ->andWhere($qb->expr()->eq('sn.etat', ':state'))
            ;
        $qb->setParameter('clientId', $clientId);
        $qb->setParameter('state', 1);

        return $qb->getQuery()->getSingleResult();
    }
    
    /**
     * Recupere l'offre d'un client adsl
     * @param integer $idClient
     */
    public function getOffreFromIdClientAdsl($idClient){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f.refSap')
            ->from($this->getEntityName(), 'c')
            ->innerJoin('c.contrat', 'cc')
            ->innerJoin('cc.ligneAdsl', 'la')
            ->innerJoin('la.article', 'a')
            ->innerJoin('a.forfait', 'f')
            ->innerJoin('a.referentielMaterielsForfait','rmf')
            ->where($qb->expr()->eq('c.idClient', ':idClient'))
            ->andWhere($qb->expr()->eq('c.typeClient', ':adsl'))
            ;
        $qb->setParameters(array('idClient'=> $idClient, 'adsl' => 'EST_3P'));
        
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function getOffreFromIdClientAdslCompose($idClient){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f.refSap')
        ->from($this->getEntityName(), 'c')
        ->innerJoin('c.contrat', 'cc')
        ->innerJoin('cc.ligneAdsl', 'la')
        ->innerJoin('la.article', 'a')
        ->innerJoin('a.artCombiPere', 'ap')
        ->innerJoin('ap.articleFils', 'af')
        ->leftJoin('af.forfait', 'f')
        ->leftJoin('af.referentielMaterielsForfait','rmf')
        ->where($qb->expr()->eq('c.idClient', ':idClient'))
        ->andWhere($qb->expr()->eq('c.typeClient', ':adsl'))
        ->andWhere($qb->expr()->isNotNull('rmf.idReferenceMaterielsForfait'))
        ;
        $qb->setParameters(array('idClient'=> $idClient, 'adsl' => 'EST_3P'));
    
        return $qb->getQuery()->getOneOrNullResult();
    }
}
