<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 15:41
 */

namespace Omea\GestionTelco\EvenementBundle\Tests\Stubs;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeDefinitionRepositoryInterface;

class InMemoryActeDefinitionRepository implements ActeDefinitionRepositoryInterface
{
    private $actesDefinitions;

    public function __construct(array $actesDefinitions)
    {
        $this->actesDefinitions = $actesDefinitions;
    }

    public function findActesByCodeEvenement($codeEvenement)
    {
        if(!isset($this->actesDefinitions[$codeEvenement])) {
            throw new Exception(sprintf('Aucun actes associé au code événement "%s" n\'a été trouvé', $codeEvenement));
        }

        return $this->actesDefinitions[$codeEvenement];
    }
}