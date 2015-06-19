<?php
namespace Omea\GestionTelco\EvenementBundle\Entity;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeDefinitionRepositoryInterface;
use Omea\GestionTelco\EvenementBundle\Entity\ActeDefinition;

class ActeDefinitionRepository  extends \Doctrine\ORM\EntityRepository implements ActeDefinitionRepositoryInterface
{
    public function findActesByCodeEvenement($codeEvenement)
    {
        $qb = $this->_em->createQueryBuilder();
        $query = $qb->select('ad')
            ->from('ActeDefinition', 'ad')
            ->join('ad.evenementDefinition', 'e')
            ->join('ad.acte', 'a')
            ->where('e.code = :code')
            ->orderBy('ad.poids', 'ASC')
            ->setParameter('code', $codeEvenement)
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