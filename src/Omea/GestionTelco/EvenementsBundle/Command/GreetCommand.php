<?php
namespace Omea\GestionTelco\EvenementsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('demo:hello')
            ->setDescription('Saluer une personne avec option')
            ->addArgument('name', InputArgument::OPTIONAL, 'Qui voulez vous saluer??')
            ->addOption('maj', null, InputOption::VALUE_NONE, 'Si définie, le nom sera en majuscules')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Bonjour '.$name;
        } else {
            $text = 'Bonjour';
        }

        if ($input->getOption('maj')) {
            $text = strtoupper($text);
        }

        $output->writeln($text);
    }
}
