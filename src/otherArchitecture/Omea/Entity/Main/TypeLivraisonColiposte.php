<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\Entity\TypeLivraisonColiposte
 *
 * @ORM\Table(name="TYPE_LIVRAISON_COLIPOSTE")
 * @ORM\Entity
 */
class TypeLivraisonColiposte
{

    /**
     *
     * @var string @ORM\Column(name="TYPE_ETAT_LIVRAISON", type="string", length=6, nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $typeEtatLivraison;

    /**
     *
     * @var string @ORM\Column(name="DESCRIPTION_ETAT", type="string", length=100, nullable=true)
     */
    private $descriptionEtat;

    /**
     *
     * @var string @ORM\Column(name="LIVRAISON_DESTINATAIRE_OK", type="string", nullable=false)
     */
    private $livraisonDestinataireOk;

    /**
     *
     * @return the $typeEtatLivraison
     */
    public function getTypeEtatLivraison()
    {
        return $this->typeEtatLivraison;
    }

    /**
     *
     * @return the $descriptionEtat
     */
    public function getDescriptionEtat()
    {
        return $this->descriptionEtat;
    }

    /**
     *
     * @return the $livraisonDestinataireOk
     */
    public function getLivraisonDestinataireOk()
    {
        return $this->livraisonDestinataireOk;
    }

    /**
     *
     * @param string $typeEtatLivraison
     */
    public function setTypeEtatLivraison($typeEtatLivraison)
    {
        $this->typeEtatLivraison = $typeEtatLivraison;
    }

    /**
     *
     * @param string $descriptionEtat
     */
    public function setDescriptionEtat($descriptionEtat)
    {
        $this->descriptionEtat = $descriptionEtat;
    }

    /**
     *
     * @param string $livraisonDestinataireOk
     */
    public function setLivraisonDestinataireOk($livraisonDestinataireOk)
    {
        $this->livraisonDestinataireOk = $livraisonDestinataireOk;
    }
}
