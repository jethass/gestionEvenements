<?php
namespace Omea\GestionTelco\EvenementBundle\Entity;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\EvenementActesProviderInterface;
use Omea\GestionTelco\EvenementBundle\DTO\ActeDefinition as ActeDefinitionDTO;
use Omea\GestionTelco\EvenementBundle\Entity\ActeDefinition;
use Omea\GestionTelco\EvenementBundle\Exception\NotFoundException;

class ActeDefinitionRepository  extends \Doctrine\ORM\EntityRepository implements EvenementActesProviderInterface
{
    /**
     * @param $evenementId
     * @return array
     *
     */
    public function findActesByEvenementId($evenementId)
    {

        // 1. récupérer l'événement (EVENEMENTS)
        // 2. vérifier que le code événement se trouve bien dans evenementDefinition (EVENEMENTS_DEFINITIONS)
            // non -> Exception: Evenement non pris en charge
            // oui -> on continue
        // 3. récupérer les actes liés à événement définition (ACTE_DEFINITIONS)
        $query="";
        $em = $this->getEntityManager();

        $evenement = $em->getRepository("OmeaGestionTelcoEvenementBundle:Evenement")
                    ->findOneBy(array("idEvenement" => $evenementId));

        $evenementDefinition = $em->getRepository("OmeaGestionTelcoEvenementBundle:EvenementDefinition")
                    ->findOneBy(array("code" => $evenement->getCode()));
        if ($evenementDefinition == null)
            throw new NotFoundException(sprintf("Le code %s ne correspond à aucun évènement.", $evenementDefinition->getCode()));

        $query = $em->createQueryBuilder("actdef")
            ->where("actdef.evenementDefinition = :evenementDefinition")
            ->orderBy("actdef.poids", "ASC")
            ->setParameter("evenementDefinition", $evenementDefinition)
            ->getQuery();

        return array_map(function(ActeDefinition $acteDefinition) {

            $acte = $acteDefinition->getActe();
            return new ActeDefinitionDTO(
                $acte->getService()->getNom(),
                $acte->getOptions()
            );

        }, $query->getResult());

    }
}