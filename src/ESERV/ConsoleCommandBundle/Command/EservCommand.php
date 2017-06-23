<?php

namespace ESERV\ConsoleCommandBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use ESERV\ConsoleCommandBundle\Services\FileNameDefinition;

class EservCommand extends ContainerAwareCommand
{

    protected $time_start;

    protected function configure()
    {
        $this->time_start = microtime(true);
        $this
                ->setName('eserv:build')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $fo = new \ESERV\ConsoleCommandBundle\Services\FileOption($this->getApplication()->getKernel()->getContainer());
        $BeginDateAndTime = date("Y/m/d h:i:sa");
        $fo->logActivity("Beginning transaction..............\n");
        $fo->logActivity("Begin Date & Time.............." . $BeginDateAndTime . "\n");


        $fo->logActivity("Beginning to import ORM files. Please wait a moment\n");
        $fo->logActivity("-------------------------------------------------------------\n");

        $output->writeln('Beginning transaction..............');
        $output->writeln('Beginning to import ORM files. Please wait a moment');
        $output->writeln('-------------------------------------------------------------');

        $import_arguments = array(
            '--force' => true,
            'bundle' => 'ESERVConsoleCommandBundle',
            'mapping-type' => 'yml',
        );
        $input = new ArrayInput($import_arguments);
        $command = $this->getApplication()->find('doctrine:mapping:import');
        $command->run($input, $output);



        #$output->writeln($returnCode);
        $fo->logActivity("Importing ORM files completed..............\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Importing ORM files completed..............');
        $output->writeln('-------------------------------------------------------------');

        $fo->logActivity("Beginning to move files. Please wait a moment\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Beginning to move files. Please wait a moment');
        $output->writeln('-------------------------------------------------------------');

        $fo->moveFiles();
        $fo->logActivity("Files moving completed.............\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Files moving completed.............');
        $output->writeln('-------------------------------------------------------------');

        $fo->logActivity("Beginning to reset file path names. Please wait a moment\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Beginning to reset file path names. Please wait a moment');
        $output->writeln('-------------------------------------------------------------');

        $fo->renameFilePath();
        $fo->logActivity("File path names resetting completed.............\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('File path names resetting completed.............');
        $output->writeln('-------------------------------------------------------------');

        $fo->logActivity("Beginning to reset relationships. Please wait a moment\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Beginning to reset relationships. Please wait a moment');
        $output->writeln('-------------------------------------------------------------');
        $fo->changeRelationships();

        $fo->logActivity("Relationships resetting completed\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Relationships resetting completed.............');
        $output->writeln("-------------------------------------------------------------");
        
        $fo->logActivity("Beginning to insert repositoryClass lines. Please wait a moment\n");
        $fo->logActivity("-------------------------------------------------------------\n");        
        $output->writeln('Beginning to insert repositoryClass lines. Please wait a moment');
        $output->writeln('-------------------------------------------------------------');
        $fo->addRepositoryClassLine();

        $fo->logActivity("Inserting repositoryClass lines completed\n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Inserting repositoryClass lines completed.............');
        $output->writeln('-------------------------------------------------------------');        
        
        $fo->logActivity("Emptying ORM files under ConsoleCommandBundle\Resources\config\doctrine \n");
        $fo->logActivity("-------------------------------------------------------------\n");
        $output->writeln('Emptying ORM files under ConsoleCommandBundle\Resources\config\doctrine.............');
        $output->writeln('-------------------------------------------------------------');
        $fo->logActivity("-------------------------------------------------------------\n");
        $fo->emptyOrmFilesInConsoleDirectory();

//        $import_arguments = array(
//            'command' => 'eserv:generate',
//            'all' => 'all',
//        );
//        $input = new ArrayInput($import_arguments);
//        $command = $this->getApplication()->find('eserv:generate');
//        $command->run($input, $output);
        
        $EndDateAndTime = date("Y/m/d h:i:sa");
        $fo->logActivity("End Date & Time.............." . $EndDateAndTime . "\n");
        $output->writeln('-------------------------------------------------------------');
        $time_end = microtime(true);
        $execution_time = (($time_end - $this->time_start) / 60) * 60;
        $fo->logActivity("Total Execution Time : " . $execution_time . " Seconds \n");
        $output->writeln("Total Execution Time : " . $execution_time . " Seconds \n");
        $output->writeln(
                  "| ------------------------------------------------------------------------------------------------------------|\n"
                . "|         Please open the 'CommandConsole.log' file in 'ConsoleCommandBundle\log' for detailed report         |\n"
                . "|                       Any question ? Please email me on anjana@millertech.co.uk                             |\n"
                . "|                              THANK YOU FOR USING MTL ESERV BUILD COMMAND                                    |\n"                
                . "|-------------------------------------------------------------------------------------------------------------|\n");
    }

}
