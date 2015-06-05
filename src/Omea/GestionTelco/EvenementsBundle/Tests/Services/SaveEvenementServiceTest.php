<?php
namespace Omea\GestionTelco\EvenementsBundle\Tests\Services;

use Omea\GestionTelco\EvenementsBundle\Entity\Evenement;

class SaveEvenementServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testSaveEvenement()
    {
        $msisdn = "0785478865";
        $code = "HFF25BBH1";
        $type= "Notification";
        $evenement= new Evenement();
        
        $evenement->setMsisdn($msisdn);
        $evenement->setCode($code);
        $evenement->setType($type);
        $evenement->setDateAppel(new \Datetime('now'));
        $evenement->setDateTraitement(Null);
        $evenement->setCodeRetour(null);

        $this->em->persist($evenement);
        $this->em->flush();

        // vérifie que votre classe a correctement calculé!
        $this->assertEquals(42, $result);
    }
}