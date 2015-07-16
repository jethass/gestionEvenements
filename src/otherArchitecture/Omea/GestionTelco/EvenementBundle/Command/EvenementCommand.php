<?php
namespace Omea\GestionTelco\EvenementBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EvenementCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        
        $this
            ->setName('evenement:handle_evenement')
            ->setDescription('lance le traitement des evenements')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
         try {
             $output->writeln("Debut du traitement des evenements : ");
             $actesManagerService = $this->getContainer()->get('omea_gestion_telco_evenement.actesmanagerservice');
             $retourEvenement = $actesManagerService->handleEvenements();
         
             $output->writeln(
                 "Nombre d'evenement OK : ".(int)$retourEvenement['ok']);
             $output->writeln(
                 "Nombre d'evenement KO : ".(int)$retourEvenement['ko']);
         
         } catch(\Exception $e) {
             $output->writeln("Erreur : ".$e->getMessage());
         }
    }
}
