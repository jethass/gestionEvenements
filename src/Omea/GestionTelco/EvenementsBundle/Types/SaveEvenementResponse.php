<?php
namespace Omea\GestionTelco\EvenementsBundle\Types;

class SaveEvenementResponse extends BaseResponse
{

    /**
     * Code Retour
     *
     * @var string
     */
    public $codeRetour = '';

    /**
     * @param string $responseCode
     * @param string $message
     * @param string $codeRetour
     */
    public function __construct($responseCode, $message, $codeRetour)
    {
        $this->codeRetour = $codeRetour;

        parent::__construct($responseCode, $message);
    }
}
