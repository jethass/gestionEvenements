<?php
namespace Omea\GestionTelco\EvenementsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EvenementsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('gestiontelco:handle_evenements')
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
        /* @var $serviceEvenement \Omea\GestionTelco\EvenementsBundle\Services\EvenementsService  */
        $serviceEvenement = $this->getContainer()->get('omea_gestion_telco_evenements.services.evenements');
        $serviceEvenement->handleEvenements();
    }
}

