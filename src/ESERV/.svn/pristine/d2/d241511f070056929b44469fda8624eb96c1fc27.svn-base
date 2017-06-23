<?php

namespace ESERV\ConsoleCommandBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\ConsoleCommandBundle\Services\FileNameDefinition;
use Symfony\Component\Filesystem\Filesystem;

class FileOption extends Controller
{

    protected $container;
    protected $app_path;
    protected $src_path;
    protected $console_bundle_path;
    protected $doctrine_path;
    protected $FileSystem;

    public function __construct($container)
    {
        $this->container = $container;
        $this->app_path = $this->container->get('kernel')->getRootDir();
        $this->src_path = $this->app_path . '/../src/';
        $this->console_bundle_path = $this->src_path . Constants::CONSOLE_COMMAND_BUNDLE_PATH;
        $this->doctrine_path = Constants::DOCTRINE_PATH;
        $this->FileSystem = new Filesystem();
    }

    public function moveFiles()
    {
        $fnd = new FileNameDefinition();
        $fn = $fnd->getFileNamesArray();
        foreach ($fn as $f) {
            $orm_name = $f['name'] . '.orm.yml';
            $orm_path = $this->src_path . '' . $f['location'] . $this->doctrine_path;
            if (file_exists($this->console_bundle_path . '/' . $orm_name)) {
                if (file_exists($orm_path . '/' . $orm_name)) {
                    unlink($orm_path . '/' . $orm_name);
    }
                rename($this->console_bundle_path . '/' . $orm_name, $orm_path . '/' . $orm_name);
            }
            $msg = "Done moving $orm_path/$orm_name \n";
            $this->logActivity($msg);
//            echo $msg;
        }
    }

    public function renameFilePath()
    {
        $fnd = new FileNameDefinition();
        $fn = $fnd->getFileNamesArray();
        foreach ($fn as $f) {
            $orm_name = $f['name'] . '.orm.yml';
            $orm_path = $this->src_path . '' . $f['location'] . $this->doctrine_path;
            $orm_path_name = str_replace('/', '\\', $f['location']) . 'Entity\\' . $f['name'] . ':';
            if (file_exists($orm_path . '/' . $orm_name)) {
                $this->delLineFromFileAndInsertNewPath($orm_path . '/' . $orm_name, 1, $orm_path_name);
                
                $msg = "Done resetting path name in $orm_path/$orm_name \n";
                $this->logActivity($msg);
//                echo $msg;
            }
        }
    }

    ###########################################################################
    ###                                                                     ###
    ### This function takes two arguements, $fileName and $lineNum          ###
    ### The example here shows how to delete line number 14 from the file   ###
    ### myfile.txt                                                          ###
    ### Example:                                                            ###
    ###                                                                     ###
    ### $fileName = "myfile.txt";                                           ###
    ### $lineNum = 14                                                       ###
    ### delLineFromFile($fileName, $lineNum);                               ###
    ### Author Kevin Waterson kevin@phpro.org                               ###
    ###                                                                     ###
    ###########################################################################

    function delLineFromFileAndInsertNewPath($fileName, $lineNum, $ormPathName)
    {
        // check the file exists 
        if (!is_writable($fileName)) {
            // print an error
            print "The file $fileName is not writable";
            // exit the function
            exit;
        } else {
            // read the file into an array    
            $arr = file($fileName);
        }

        // the line to delete is the line number minus 1, because arrays begin at zero
        $lineToDelete = $lineNum - 1;

        // check if the line to delete is greater than the length of the file
        if ($lineToDelete > sizeof($arr)) {
            // print an error
            print "You have chosen a line number, <b>[$lineNum]</b>,  higher than the length of the file.";
            // exit the function
            exit;
        }

        //remove the line
//        unset($arr["$lineToDelete"]);
        $arr["$lineToDelete"] = "$ormPathName \n";

        // open the file for reading
        if (!$fp = fopen($fileName, 'w+')) {
            // print an error
            print "Cannot open file ($fileName)";
            // exit the function
            exit;
        }

        // if $fp is valid
        if ($fp) {
            // write the array to the file
            foreach ($arr as $line) {
                fwrite($fp, $line);
            }

            // close the file
            fclose($fp);
        }

//        echo "done\n ";
    }

    public function changeRelationships()
    {
        $fnd = new FileNameDefinition();

        $test = $fnd->getFileNamesArray();
        foreach ($test as $f) {
            $orm_name = $f['name'] . '.orm.yml';
            $orm_path = $this->src_path . '' . $f['location'] . $this->doctrine_path;
            if (file_exists($orm_path . '/' . $orm_name)) {
                $file_contents = file_get_contents($orm_path . '/' . $orm_name);
                $temp = $fnd->getFileNamesArray();

                foreach ($temp as $ff) {

                    $fff_name = $ff['name'];

                    if (preg_match("/\\b"."targetEntity: " . $fff_name."\\b/",$file_contents)) {
                        
                        $orm_path_name = str_replace('/', '\\', $ff['location']) . 'Entity\\' . $fff_name;
                        $file_contents = str_replace("targetEntity: " . $fff_name, "targetEntity: $orm_path_name", $file_contents);
                        file_put_contents($orm_path . '/' . $orm_name, $file_contents);

                        $msg = "Relationship " . $fff_name . " changed to $orm_path_name in $orm_path/$orm_name\n";

                        $this->logActivity($msg);                    
                    }
                                        
                    if (preg_match("/\\b"."targetEntity: FosUser"."\\b/",$file_contents)) {

                        $orm_path_name = Constants::FOS_ORM_PATH;
                        $file_contents = str_replace("targetEntity: FosUser", "targetEntity: $orm_path_name", $file_contents);
                        file_put_contents($orm_path . '/' . $orm_name, $file_contents);

                        $msg = "FOS Relationship changed to $orm_path_name in $orm_path/$orm_name\n";

                        $this->logActivity($msg);                    
                    }
                    
                    if (preg_match("/\\b"."targetEntity: FosGroup"."\\b/",$file_contents)) {

                        $orm_path_name = Constants::FOS_GROUP_ORM_PATH;
                        $file_contents = str_replace("targetEntity: FosUser", "targetEntity: $orm_path_name", $file_contents);
                        file_put_contents($orm_path . '/' . $orm_name, $file_contents);

                        $msg = "FOS GROUP Relationship changed to $orm_path_name in $orm_path/$orm_name\n";

                        $this->logActivity($msg);                    
                    }
                   
                }

            }
        }
    }

    public function logActivity($Message)
    {
        $ds = DIRECTORY_SEPARATOR;
        $Path = $this->console_bundle_path . $ds . '..' . $ds . '..' . $ds . '..' . $ds . 'log' . $ds;
        $ErrorMessage = $Message;
        $FileName = 'CommandConsole.log';

        try {
            if (!$this->FileSystem->exists($Path)) {
                $this->FileSystem->mkdir($Path);
            }

            //Append the log            
            file_put_contents($Path . $FileName, $ErrorMessage, FILE_APPEND | LOCK_EX);
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while creating your directory at " . $e->getPath();
        }
    }
    
    public function addRepositoryClassLine()
    {
        $fnd = new FileNameDefinition();

        $test = $fnd->getFileNamesArray();
        foreach ($test as $f) {
            $orm_name = $f['name'] . '.orm.yml';
            $orm_path = $this->src_path . '' . $f['location'] . $this->doctrine_path;
            if (file_exists($orm_path . '/' . $orm_name)) {
                $file_contents = file_get_contents($orm_path . '/' . $orm_name);

                if (preg_match("/\\b"."type: entity"."\\b/", $file_contents)) {
                    $orm_path_name = str_replace('/', '\\', $f['location']) . 'Entity\\' . $f['name'] . 'Repository';
                    $repository_class_line = '    repositoryClass: '.$orm_path_name;
                    $temp_lines = "type: entity". PHP_EOL. $repository_class_line;


                    $file_new_contents = str_replace("type: entity", $temp_lines, $file_contents);
                    file_put_contents($orm_path . '/' . $orm_name, $file_new_contents);

                    $msg = "New repositoryClass line added - $repository_class_line\n";

                    $this->createBlankEntityRepositoryFile($f['location'], $f['name']);

                    $this->logActivity($msg);                    
                }
            }          
        }
    }
    
    public function createBlankEntityRepositoryFile($location, $fileName)
    {   
        $file = $this->src_path.$location.'Entity/'.$fileName. 'Repository.php';
        
        if(!file_exists($file)){            
            $file_create = fopen($file, 'w');
            $location_tmp = str_replace('/', '\\', $location); 
            file_put_contents($file, $this->getContentsOfBlankEntityRepositoryFile($location_tmp.'Entity', $fileName.'Repository'));
            $this->logActivity("New repository file created :- $file\n"); 
            fclose($file_create);
        }
    }    
    
    public function getContentsOfBlankEntityRepositoryFile($namespace, $class)
    {
        $contents = '<?php
            
        /*
            This file has been generated using MTL ESERV:BUILD command. Contact Anjana on anjana@millertech.co.uk for more
            information. Thanks.
        */

        namespace '.$namespace.';

        use Doctrine\ORM\EntityRepository;

        /**
         * '.$class.'
         *
         * This class was generated by the Doctrine ORM. Add your own custom
         * repository methods below.
         */
        class '.$class.' extends EntityRepository
        {   

        }';
        
        return $contents;
    }
    
    public function emptyOrmFilesInConsoleDirectory()
    {
        $files = glob("$this->console_bundle_path/*"); // get all file names
        foreach($files as $file){ // iterate files
          if(is_file($file)){
            unlink($file); // delete file
          }
        }
    }
}
