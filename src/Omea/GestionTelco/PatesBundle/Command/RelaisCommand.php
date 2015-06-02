<?php
namespace Omea\GestionTelco\PatesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RelaisCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('gestiontelco:relais')
            ->setDescription('Handle an item from the database queue (FemtoProvisioningMonitoring)')
            ->addArgument('provisioning', InputArgument::REQUIRED, 'Which ws do you want to call?')
            ->addOption('limit', 'l', InputOption::VALUE_OPTIONAL, 'Choose the number ot item to proceed (default 1)')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $provisioning = $input->getArgument('provisioning');
        $limit = $input->getOption('limit');

        $relaisService = $this->getContainer()->get('omea_gestion_telco_pates.services.relais');

        $relaisService->provisioning($provisioning, $limit);
    }
}
