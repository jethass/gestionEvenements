<?php
/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 16/06/15
 * Time: 11:23
 */

namespace Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces;

/**
 * Un evenement
 */
interface EvenementInterface {
    public function getCode();
    public function getType();
    public function getDateAppel();
    public function getDateTraitement();
    public function getMsisdn();
}