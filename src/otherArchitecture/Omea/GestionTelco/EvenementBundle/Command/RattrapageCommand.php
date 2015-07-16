<?php
namespace Omea\GestionTelco\EvenementBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RattrapageCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        
        $this
            ->setName('evenement:rattrapage')
            ->setDescription('lance le rattrapage des evenements en erreur')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln("Debut du traitement des rattrapages : ");
            $actesManagerService = $this->getContainer()->get('omea_gestion_telco_evenement.actesmanagerservice');
            $retourRattrapage = $actesManagerService->rattrapageEvenements();
            
            $output->writeln(
                "Nombre de rattrapage OK : ".(int)$retourRattrapage['ok']);
            $output->writeln(
                "Nombre de rattrapage KO : ".(int)$retourRattrapage['ko']);
            
        } catch(\Exception $e) {
            $output->writeln("Erreur : ".$e->getMessage());
        }
    }
}
