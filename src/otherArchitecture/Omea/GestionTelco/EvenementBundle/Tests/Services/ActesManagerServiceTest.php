<?php
namespace Omea\GestionTelco\EvenementBundle\Tests\Services;

use Omea\Entity\GestionEvenements\Evenement;
use Omea\Entity\GestionEvenements\GestionEvenementErreur;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager;
use Omea\GestionTelco\EvenementBundle\Services\ActesManagerService;
/**
 * Description of ActesManagerServiceTest
 *
 * @author hlataoui
 */
class ActesManagerServiceTest extends WebTestCase 
{
    public $evenementRepository;
    public $gestionEvenementErreurRepository;
    public $logger;

    public function setUp()
    {
        $this->evenementRepository = $this->getMockBuilder('Omea\Entity\GestionEvenements\EvenementRepository')->disableOriginalConstructor()->getMock();
        $this->gestionEvenementErreurRepository = $this->getMockBuilder('Omea\Entity\GestionEvenements\GestionEvenementErreurRepository')->disableOriginalConstructor()->getMock();
        $this->logger=$this->getMockBuilder('\Psr\Log\LoggerInterface')->getMock();
    }
        
    public function MockEvenements()
    {
        $evenement1 = new Evenement();
        $evenement1->setCode('Alerte_HIS');
        $evenement1->setDateAppel(new \Datetime('now'));
        $evenement1->setDateTraitement(null);
        $evenement1->setMsisdn('601088866');
        $evenement1->setType('NOTIFICATION');
        
        $evenement2 = new Evenement();
        $evenement2->setCode('Alerte_OCR');
        $evenement2->setDateAppel(new \Datetime('now'));
        $evenement2->setDateTraitement(null);
        $evenement2->setMsisdn('601698866');
        $evenement2->setType('NOTIFICATION');
        
        return array($evenement1, $evenement2);
     
    }
    
    /* test la partie1 (si le traitement des evenements passe et ne catch pas d'erreurs */
    public function testHandleEvenementsOk()
    {
        /* Prépare tous les mock pour l'appel de service ActesManagerService*/
        $mockEvenements = $this->MockEvenements();
        $this->evenementRepository->expects($this->once())->method('findBy')->will($this->returnValue($mockEvenements));
        
        $stockMsisdn = new \Omea\Domain\Main\StockMsisdn();
        $stockMsisdn->setIdClient(42);
        
        /* Mock StockMsisdnRepository */
        $mockStockMsisdnRepository = $this->getMockBuilder('Omea\Entity\Main\StockMsisdnRepository')->disableOriginalConstructor()->getMock();
        
        /* StockMsisdnRepository Mock va accepter plusieur fois la méthode find qui va retourné un $stockMsisdn qui contient un IdClient=42 tjs  */
        $mockStockMsisdnRepository->expects($this->any())->method('find')->will($this->returnValue($stockMsisdn));
        
        /* Mock ActeManager */
        $mockActeManager = $this->getMockBuilder('Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager')->disableOriginalConstructor()->getMock();
         /* Appel la function handle d'ActeManager 2 fois (qui est égal au nombre de mock des evenements)*/
        $mockActeManager->expects($this->exactly(2))->method('handle');
        
        $gestionEvenementManager = $this->getMockBuilder('\Doctrine\ORM\EntityManagerInterface')->getMock();
        $gestionEvenementManager->expects($this->once())->method('flush');
        
        /* instancation de  ActesManagerService*/
        $service = new ActesManagerService(
            $this->logger,
            $gestionEvenementManager,
            $mockActeManager,
            $mockStockMsisdnRepository,
            $this->evenementRepository,
            $this->gestionEvenementErreurRepository    
        );
        
        /* Appel de la function handleEvenements de ActesManagerService */
        $service->handleEvenements();

        /* vérifie que DateTraitement est mis à jour par une \DateTime */
        foreach ($mockEvenements as $evenement) {
            $this->assertInstanceOf('\DateTime', $evenement->getDateTraitement());
        }
    }
    
    /* test la partie2 (si le traitement des evenements catch une erreur */
    public function testHandleEvenementsKo()
    {

         /* Prépare tous les mock pour l'appel de service ActesManagerService*/
        $mockEvenements = $this->MockEvenements();
        $this->evenementRepository->expects($this->once())->method('findBy')->will($this->returnValue($mockEvenements));

        /*initialisation d'objet $stockMsisdn null pour lui faire passer au StockMsisdnRepository et pour que le traitement de handle retourne une erreur*/
        $stockMsisdn = null;
        
        /* Mock StockMsisdnRepository */
        $mockStockMsisdnRepository = $this->getMockBuilder('Omea\Entity\Main\StockMsisdnRepository')->disableOriginalConstructor()->getMock();
        
        /* StockMsisdnRepository Mock va accepter plusieur fois la méthode find qui va retourné un $stockMsisdn null  */
        $mockStockMsisdnRepository->expects($this->any())->method('find')->will($this->returnValue($stockMsisdn));

        /* Mock ActeManager */
        $mockActeManager = $this->getMockBuilder('Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager')->disableOriginalConstructor()->getMock();
        /*vérifie que l'ActeManager n'appelle pas la function handle car on est dans la deusième partie de fonction ou on catch un erreur */
        $mockActeManager->expects($this->never())->method('handle');

        $gestionEvenementManager = $this->getMockBuilder('\Doctrine\ORM\EntityManagerInterface')->getMock();
        $gestionEvenementManager->expects($this->once())->method('flush');
        
        /* instancation de  ActesManagerService*/
        $service = new ActesManagerService(
            $this->logger,
            $gestionEvenementManager,
            $mockActeManager,
            $mockStockMsisdnRepository,
            $this->evenementRepository,
            $this->gestionEvenementErreurRepository
        );

        /* Appel de la function handleEvenements de ActesManagerService */
        $service->handleEvenements();

        /* vérifie que DateTraitement reste Null */
        foreach ($mockEvenements as $evenement) {
            $this->assertNull($evenement->getDateTraitement());
        }
        
    }
    

  
}
