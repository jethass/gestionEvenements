<?php
namespace Omea\GestionTelco\EvenementBundle\Tests\Services;
use Omea\Entity\GestionEvenements\Evenement;

/**
 * Description of ActesManagerServiceTest
 *
 * @author hlataoui
 */
class ActesManagerServiceTest extends \PHPUnit_Framework_TestCase {
    

    public function setUp(){
        
    }
        
    public function MockEvenements(){
        $evenement1=new Evenement();
        $evenement1->setCode('Alerte_BRI');
        $evenement1->setDateAppel(new \Datetime('now'));
        $evenement1->setDateTraitement(null);
        $evenement1->setMsisdn('601088866');
        $evenement1->setType('NOTIFICATION');
        
     
    }
    public function handleEvenementsTest(){
      
    }
  
}
