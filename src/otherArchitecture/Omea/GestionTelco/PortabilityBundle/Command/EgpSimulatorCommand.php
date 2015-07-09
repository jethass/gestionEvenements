<?php
namespace Omea\GestionTelco\PortabilityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EgpSimulatorCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $operationDescription = <<<TEXT
What incoming message from the EGP do you want to generate ?

Possible messages :
- ELI_IN : ELI request for outgoing portability
- ELI_OUT : ELI confirmation for incoming portability
- IND : IND cancellation confirmation for both incoming/outgoing portability
- ANR : ANR cancellation confirmation for both incoming/outgoing portability
- GOP : GOP portage confirmation for both incoming/outgoing portability
TEXT;

        $this
        ->setName('gestiontelco:egp_simulator')
        ->setDescription('Generates fake messages emulating the EGP')
        ->addArgument('operation', InputArgument::REQUIRED, $operationDescription)
        ->addOption('idportage', 'i', InputOption::VALUE_REQUIRED, 'Choose the id for the impacted portability')
        ->addOption('returncode', 'c', InputOption::VALUE_OPTIONAL, 'Choose the return code for the message [ELI_IN, ANR, IND]')
        ->addOption('msisdn', 'm', InputOption::VALUE_OPTIONAL, 'Choose the ported MSISDN [ELI_OUT]')
        ->addOption('rio', 'r', InputOption::VALUE_OPTIONAL, 'Choose the ported RIO code [ELI_OUT]')
        ->addOption('dateportage', 'p', InputOption::VALUE_OPTIONAL, 'Choose the planified date for the portability [ELI_OUT]')
        ->addOption('tranche', 't', InputOption::VALUE_OPTIONAL, 'Choose the planified schedule for the portability [ELI_OUT]')
        ->addOption('datedemande', 'd', InputOption::VALUE_OPTIONAL, 'Choose the date of the portability\'s creation [ELI_OUT]')
        ->addOption('opr', null, InputOption::VALUE_OPTIONAL, 'Choose the identifier for the receiving operator [ELI_OUT]')
        ->addOption('oprt', null, InputOption::VALUE_OPTIONAL, 'Choose the identifier for the technical receiving operator [ELI_OUT]')
        ->addOption('opd', null, InputOption::VALUE_OPTIONAL, 'Choose the identifier for the giving operator [ELI_OUT]')
        ->addOption('opdt', null, InputOption::VALUE_OPTIONAL, 'Choose identifier for the technical giving operator [ELI_IN]')
        ->addOption('opa', null, InputOption::VALUE_OPTIONAL, 'Choose the identifier for the owner operator [ELI_IN]')
        ->addOption('opat', null, InputOption::VALUE_OPTIONAL, 'Choose the identifier for the technical owner operator [ELI_IN]')
        ;
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $operation = $input->getArgument('operation');
        $idPortage = $input->getOption('idportage');
        $returnCode = $input->getOption('returncode');
        $msisdn = $input->getOption('msisdn');
        $rio = $input->getOption('rio');
        $datePortage = $input->getOption('dateportage');
        $tranche = $input->getOption('tranche');
        $dateDemande = $input->getOption('datedemande');
        $opr = $input->getOption('opr');
        $oprt = $input->getOption('oprt');
        $opd = $input->getOption('opd');
        $opdt = $input->getOption('opdt');
        $opa = $input->getOption('opa');
        $opat = $input->getOption('opat');

        $simulator = $this->getContainer()->get('omea_gestion_telco_portability.services.egp_simulator');

        $simulator->generate($operation, $idPortage, $returnCode, $msisdn, $rio, $datePortage, $tranche, $dateDemande, $opr, $oprt, $opd, $opdt, $opa, $opat);
    }
}
