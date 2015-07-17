<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\Options\HistoActeOptions;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\Options\BridageActeOptions;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\Options\SMSActeOptions;

/**
 * Classe de sérialisation et de désérialisation pour les options des actes.
 */
class ActeOptionsSerializer
{
    public function serialize(ActeOptionsInterface $acteOptions)
    {
        // prend un objet => retourne un tableau, puis prend le tableau et retourne une http query  "key=value&key2=value2"
        return http_build_query(get_object_vars($acteOptions));
    }

    public function unserialize($acteOptionsClassname, $serializedOptions)
    {
        if (!class_exists($acteOptionsClassname)) {
            throw new \InvalidArgumentException($acteOptionsClassname.' does not exist');
        }

        $acteOptions = new $acteOptionsClassname(); //initialisation de notre objet
        if (!($acteOptions instanceof ActeOptionsInterface)) {
            throw new \InvalidArgumentException($acteOptionsClassname.' does not implements ActeOptionsInterface');
        }

        parse_str($serializedOptions, $options); //prend une http query et le transforme en tableau
        foreach ($options as $key => $value) { //parcour le tableau
            if (!property_exists($acteOptionsClassname, $key)) { // vérifi si la cle de tableau sont des attribut de notre classe objet "acteOptionsClassname"
                throw new \InvalidArgumentException(
                    sprintf(
                        'property "%s" does not exist in "%s"',
                        $key,
                        $acteOptionsClassname
                    )
                );
            }

            $acteOptions->$key = $value; //création de l'objet a partir de tableau
        }

        return $acteOptions;
    }
}
