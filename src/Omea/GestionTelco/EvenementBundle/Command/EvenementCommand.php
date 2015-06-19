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
            ->setName('gestiontelco:handle_Evenement')
            ->setDescription('lance le traitement des evenements')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $EvenementService \Omea\GestionTelco\EvenementBundle\Services\EvenementService  */
        $EvenementService = $this->getContainer()->get('omea_gestion_telco_Evenement.services.Evenements');
        $EvenementService->handleEvenements();
    }
}

