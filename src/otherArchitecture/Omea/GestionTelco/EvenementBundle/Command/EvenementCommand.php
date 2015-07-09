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
            ->setName('gestiontelco:handle_evenement')
            ->setDescription('lance le traitement des evenements')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
         $actesManagerService = $this->getContainer()->get('omea_gestion_telco_evenement.actesmanagerservice');
         $actesManagerService->handleEvenements();
    }
}
