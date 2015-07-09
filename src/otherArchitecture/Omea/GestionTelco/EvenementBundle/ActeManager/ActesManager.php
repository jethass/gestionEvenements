<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager;

use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsSerializer;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeDefinitionInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ConfigurableActeInterface;
use Omea\Entity\GestionEvenements\EvenementDefinitionRepository;

/**
 * Gestionnaire d'actes.
 */
class ActesManager
{
    private $actes;

    private $evenementDefinitionRepository;

    private $serializer;
    
    private $failedActe;
    
    private $actesDefinitions;

    public function __construct(
        ActeOptionsSerializer $serializer,
        EvenementDefinitionRepository $evenementDefinitionRepository
    ) {
        $this->serializer = $serializer;
        $this->evenementDefinitionRepository = $evenementDefinitionRepository;
    }

    /**
     * Prise en charge d'un évènement.
     *
     * @param EvenementInterface $evenement
     */
    public function handle(EvenementInterface $evenement, $idClient)
    {
        $evenementsDefinition = $this->evenementDefinitionRepository->findOneBy(array('code' => $evenement->getCode()));
        
        if (!$evenementsDefinition || !$evenementsDefinition->getActesDefinition()) {
            throw new \RuntimeException("Aucun acte n'est capable de prendre en charge le code evenement ".$evenement->getCode());
        }
        
        foreach ($evenementsDefinition->getActesDefinition() as $acteDefinition) {
            $acte = $this->getActe($acteDefinition);
            try {
                $acte->handle($evenement, $idClient);
            } catch (Exception $e) {
                $this->failedActe = $acte;
                throw $e;
            }            
        }
    }

    /**
     * Enregistre un acte dans le manager.
     *
     * @param string $acteName      nom de l'acte
     * @param string $acteClassname class correspondant à l'acte
     */
    public function registerActe($acteName, ActeInterface $acte)
    {
        $this->actes[$acteName] = $acte;
    }

    /**
     * Crée un acte à partir de sa définition.
     *
     * @param ActeDefinitionInterface $actesDefinition
     *
     * @return ActeInterface
     */
    private function getActe($actesDefinition)
    {
        if (!isset($this->actes[$actesDefinition->getName()])) {
            throw new \InvalidArgumentException(
                sprintf('Aucun acte portant le nom "%s" n\'a été trouvé', $actesDefinition->getName())
            );
        }

        $acte = $this->actes[$actesDefinition->getName()];
        
        // Création des options de l'acte
        if ($acte instanceof ConfigurableActeInterface) {
            $acteOptions = $this->serializer->unserialize($acte->getOptionsClassname(), $actesDefinition->getoptions());
            $acte->setOptions($acteOptions);
        }

        //@todo (Validation des options de l'acte à cet endroit) 

        return $acte;
    }
    
    public function getFailedActe()
    {
        return $this->failedActe;
    }
    
    public function getActesDefinitions()
    {
        return $this->actesDefinitions;
    }
}
