<?php

namespace ESERV\ConsoleCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use ESERV\ConsoleCommandBundle\Services\FileNameDefinition;
use Symfony\Component\Console\Input\InputArgument;

class TestCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
                ->setName('eserv:generate')
                ->addArgument('all', InputArgument::OPTIONAL, 'Bundle you need to generate.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $all = $input->getArgument('all');

        if ($all === 'all') {
            $fo = new \ESERV\ConsoleCommandBundle\Services\FileOption($this->getApplication()->getKernel()->getContainer());
            $fo->logActivity("Beginning to generate entities. Please wait a moment\n");
            $fo->logActivity("-------------------------------------------------------------\n");
            $output->writeln('Beginning to generate entities. Please wait a moment');
            $output->writeln('-------------------------------------------------------------');
            
            $fnd = new FileNameDefinition();
            $bundle_array = array();

            foreach ($fnd->getFileNamesArray() as $f) {
                $bundle_array[] = str_replace('/', '', $f['location']);
            }
            $bundle_array = array_unique($bundle_array);

            foreach ($bundle_array as $bundle) {
                $arguments2 = array(
                    'command' => 'doctrine:generate:entities',
                    'name' => $bundle,
                    '--no-backup' => 'true',
                );
                $input = new ArrayInput($arguments2);
                $command2 = $this->getApplication()->find('doctrine:generate:entities');
                $command2->run($input, $output);
            }

            $fo->logActivity("-------------------------------------------------------------\n");
            $fo->logActivity('Generating entities completed..............');
            $output->writeln('Generating entities completed..............');
            $output->writeln('-------------------------------------------------------------');
        } else {
            $output->writeln('Functionality hasn\'t been completed yet.');
        }
    }

}
