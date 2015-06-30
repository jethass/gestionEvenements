<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 12:16
 */

namespace Omea\GestionTelco\EvenementBundle\ActeManager;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsInterface;
/**
 * Classe de sérialisation et de désérialisation pour les options des actes
 */
class ActeOptionsSerializer
{
    public function serialize(ActeOptionsInterface $acteOptions)
    {
        return http_build_query(get_object_vars($acteOptions));
    }

    public function unserialize($acteOptionsClassname, $serializedOptions)
    {
        if (!class_exists($acteOptionsClassname)) {
            throw new \InvalidArgumentException($acteOptionsClassname . " does not exist");
        }

        $acteOptions = new $acteOptionsClassname;
        if (!($acteOptions instanceof ActeOptionsInterface)) {
            throw new \InvalidArgumentException($acteOptionsClassname . " does not implements ActeOptionsInterface");
        }

        parse_str($serializedOptions, $options);
        foreach ($options as $key => $value) {

            if (!property_exists($acteOptionsClassname, $key)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'property "%s" does not exist in "%s"',
                        $key,
                        $acteOptionsClassname
                    )
                );
            }

            $acteOptions->$key = $value;
        }

        return $acteOptions;
    }
}
