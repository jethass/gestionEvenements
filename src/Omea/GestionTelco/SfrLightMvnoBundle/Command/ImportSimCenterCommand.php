<?php
namespace Omea\GestionTelco\SfrLightMvnoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSimCenterCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('gestiontelco:simcenter_import')
            ->addArgument("importPath", InputArgument::REQUIRED, "Chemin vers les dossiers d'import")
            ->setDescription('Importation des cartes SIM depuis un fichier SimCenter');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $simCenterImportService = $this->getContainer()->get('sfr_light_mvno.services.simcenter_import_service');
        $simCenterImportService->import($input->getArgument("importPath"));
    }
}
