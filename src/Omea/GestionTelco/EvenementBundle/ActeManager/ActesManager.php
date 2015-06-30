<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 12:18
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager;

use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementActesProviderInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsSerializer;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeDefinitionInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ConfigurableActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\SMSActe;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\HistoActe;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\BridageActe;

/**
 * Gestionnaire d'actes
 */
class ActesManager
{
    private $actes;

    private $evenementActesProvider;

    private $serializer;

    public function __construct(
        ActeOptionsSerializer $serializer,
        EvenementActesProviderInterface $evenementActesProvider
    ) {
        $this->serializer = $serializer;
        $this->evenementActesProvider = $evenementActesProvider;
    }

    /**
     * Prise en charge d'un évènement
     *
     * @param  EvenementInterface $evenement
     * @return void
     */
    public function handle(EvenementInterface $evenement)
    {
        $actesDefinitions = $this->evenementActesProvider->findActesByEvenementId($evenement->getId());

        if (empty($actesDefinition)) {
            throw new \RuntimeException("Aucun acte n'est capable de prendre en charge le code evenement " . $evenement->getCode());
        }

        foreach ($actesDefinitions as $acteDefinition) {
            $acte = $this->getActe($acteDefinition);
            $acte->handle($evenement,$acte->getIdActe());
        }
    }

    /**
     * Enregistre un acte dans le manager
     *
     * @param  string $acteName      nom de l'acte
     * @param  string $acteClassname class correspondant à l'acte
     * @return void
     */
    public function registerActe($acteName, $acteClassname)
    {

        if (!class_exists($acteClassname)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'La classe "%s" n\'a pas pu être trouvée',
                    $acteClassname
                )
            );
        }

        // Vérifie que le nom de l'acte n'est pas déj� associé à une classe
        if (isset($this->actes[$acteName])) {
            $previousActeClassname = $this->actes[$acteName];
            throw new \RuntimeException(
                sprintf(
                    'Le nom "%s" a déjà été assigné pour "%s"',
                    $acteName,
                    $previousActeClassname
                )
            );
        }

        $this->actes[$acteName] = $acteClassname;
    }

    /**
     * Crée un acte à partir de sa définition
     *
     * @param  ActeDefinitionInterface $actesDefinition
     * @return ActeInterface
     */
    private function getActe(ActeDefinitionInterface $actesDefinition)
    {
        if (!isset($this->actes[$actesDefinition->getName()])) {
            throw new \InvalidArgumentException(
                sprintf('Aucun acte portant le nom "%s" n\'a été trouvé', $actesDefinition->getName())
            );
        }

        $acteClassname = $this->actes[$actesDefinition->getName()];

        // Création de l'acte
        $acte = new $acteClassname;

        if (!($acte instanceof ActeInterface)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'La classe "%s" n\'implémente pas ActeInterface',
                    get_class($acte)
                )
            );
        }

        // Création des options de l'acte
        if ($acte instanceof ConfigurableActeInterface) {
            $acteOptions = $this->serializer->unserialize($acte->getOptionsClassname(), $actesDefinition->getoptions());
            $acte->setOptions($acteOptions);
        }

        //@todo Validation des options de l'acte à cet endroit ??? A vous de voir

        return $acte;
    }
}