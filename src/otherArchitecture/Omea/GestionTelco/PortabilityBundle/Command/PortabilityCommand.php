<?php
namespace Omea\GestionTelco\PortabilityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PortabilityCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $queueDescription = <<<TEXT
Which queue do you want to process ?

Possible queues :
- receive : Get incoming messages from EGP
- send : Send outgoing messages to EGP
- setDatePE : find acceptable dates for incoming portabilities
- eligPE : notify EGP of incoming portabilities
- activPE : activate incoming portabilities
- abandonPE : activate lines for which incoming portabilities have been canceled
- eligPS : check eligibility of outgoing portabilities
- resilPS : unsubscribe outgoing portabilities
TEXT;

        $this
        ->setName('gestiontelco:portability')
        ->setDescription('Handle the portability message queues')
        ->addArgument('queue', InputArgument::REQUIRED, $queueDescription)
        ->addOption('pop', 'p', InputOption::VALUE_OPTIONAL, 'Choose the set of users to process (default 0)')
        ->addOption('modulo', 'm', InputOption::VALUE_OPTIONAL, 'Choose the number of user sets (default 1)')
        ;
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $queue = $input->getArgument('queue');
        $pop = $input->getOption('pop');
        $modulo = $input->getOption('modulo');

        $messageQueue = $this->getContainer()->get('omea_gestion_telco_portability.services.messagequeue');

        $messageQueue->process($queue, $pop, $modulo);
    }
}
