<?php

namespace ESERV\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\TestBundle\Form\ClientTableForm;
use ESERV\TestBundle\Form\ClientFieldForm;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CustomFieldsController extends Controller {

    public function testSamAction(Request $request) {
        $_user = $this->getDoctrine()->getManager()
                ->createQueryBuilder()
                ->select('u')
                ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
                ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                ->leftJoin('ESERVMAINSecurityBundle:Group', 'g', 'WITH', 'g.id = ug.group')
                ->where('g.name = :fos_group')
                ->setParameter('fos_group', \ESERV\MAIN\Services\AppConstants::FOS_GROUP_REGISTERED_TEACHER)
                ->andWhere('p.referenceNo = :ref')
                ->setParameter('ref', '00370941')
                ->getQuery()
                ->getArrayResult()
        ;
        print_r($_user);
        die;
    }

    public function newCustomFieldGroupAction() {
        $action_url = $this->generateUrl('gtcw_custom_group_create_test');
        $form = $this->createForm(new ClientTableForm(), null, array(
            'action' => $action_url,
        ));

        return $this->render(
                        'ESERVTestBundle:Default:contact.html.twig', array('form' => $form->createView())
        );
    }

    public function saveCustomFieldGroupAction(Request $request) {
        $form = $this->createForm(new ClientTableForm(), null);
        $form->handleRequest($request);
        $em1 = $this->getDoctrine()->getManager();

        $em1->getConnection()->beginTransaction();
        if ($form->isValid()) {
            $form_data = $request->request->get('client_table');
            try {

                $cg_entity = $em1->getRepository('ESERVClientBundle:ClientTable')->findOneBy(array(
                    'name' => $form_data['group']));

                if ($cg_entity) {
                    return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : Group name'
                                . ' already exisits. Please choose a different group name.'));
                }


                $import_filter_name = 'EservClient' . ucfirst($form_data['group']);
                $table_name = 'eserv_client_' . strtolower(trim($form_data['group']));

                $eserv_custom_table = new \ESERV\ClientBundle\Entity\ClientTable();
                $eserv_custom_table->setName($form_data['group']);
                $eserv_custom_table->setTitle($form_data['title']);

                $connection = $em1->getConnection();
                $statement = $connection->prepare("CREATE TABLE IF NOT EXISTS " . $table_name . " (
                                                    id INT(11) NOT NULL AUTO_INCREMENT,
                                                    PRIMARY KEY (id))
                                                  ");
                $statement->execute();
                $em1->persist($eserv_custom_table);
                $em1->flush();

                $this->executeImportCommandAction($import_filter_name);
                $this->executeGenerateEntitiesCommandAction($import_filter_name);
                $this->executeBuildFormCommandActions($import_filter_name);
                $this->appendToFileAction(ucfirst($form_data['group']));

                $ct_entity = $em1->getRepository('ESERVClientBundle:ClientTable')->findOneBy(array(
                    'id' => $eserv_custom_table->getId()));

                $entity = $em1->getRepository('ESERVClientBundle:ClientEntity')->findOneBy(array(
                    'id' => $form_data['entity_id']));

                $eserv_custom_table_map = new \ESERV\ClientBundle\Entity\ClientTableMap();
                $eserv_custom_table_map->setClientTable($ct_entity);
                $eserv_custom_table_map->setClientEntity($entity);
                $em1->persist($eserv_custom_table_map);
                $em1->flush();


                $em1->getConnection()->commit();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Custom group successfully saved!'));
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : ' . $e->getMessage()));
            }
        }
    }

    public function newCustomFieldAction() {
        $action_url = $this->generateUrl('gtcw_custom_field_create_test');
        $form = $this->createForm(new ClientFieldForm(), null, array(
            'action' => $action_url,
        ));

        return $this->render(
                        'ESERVTestBundle:Default:contact.html.twig', array('form' => $form->createView())
        );
    }

    public function saveCustomFieldAction(Request $request) {
        $form = $this->createForm(new ClientFieldForm(), null);
        $form->handleRequest($request);
        $em1 = $this->getDoctrine()->getManager();

        $em1->getConnection()->beginTransaction();
        if ($form->isValid()) {
            $form_data = $request->request->get('client_field');
            try {

                $cf_entity = $em1->getRepository('ESERVClientBundle:ClientField')->findOneBy(array(
                    'fieldName' => $form_data['field_name'], 'clientTable' => $form_data['client_table_id']));

                if ($cf_entity) {
                    return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : Field name \''
                                . $form_data['field_name'] . '\' already exisits. Please choose a different field name.'));
                }

                $eserv_custom_field = new \ESERV\ClientBundle\Entity\ClientField();
                $ct_entity = $em1->getRepository('ESERVClientBundle:ClientTable')->findOneBy(array(
                    'id' => $form_data['client_table_id']));

                $exp_field_name = explode(' ', strtolower(trim($form_data['field_name'])));
                $imp_field_name = implode('_', $exp_field_name);



                $import_filter_name = 'EservClient' . ucfirst($ct_entity->getName());


                $eserv_custom_field->setClientTable($ct_entity);
                $eserv_custom_field->setTitle($form_data['title']);
                $eserv_custom_field->setFieldName($imp_field_name);
                $eserv_custom_field->setFieldSize($form_data['field_size']);
                $eserv_custom_field->setFieldType($form_data['field_type']);
                $eserv_custom_field->setNotNull($form_data['not_null']);

                $connection = $em1->getConnection();

                $custom_table_name = 'eserv_client_' . strtolower($ct_entity->getName());


                $null = ($form_data['not_null'] == 'Y') ? 'NOT NULL' : 'NULL';


                $statement = $connection->prepare("ALTER TABLE " . $custom_table_name . " ADD " .
                        $imp_field_name . " " . $form_data['field_type'] . ""
                        . "(" . $form_data['field_size'] . ") "
                        . $null . "");
                $statement->execute();

                $em1->persist($eserv_custom_field);
                $em1->flush();


                $this->executeImportCommandAction($import_filter_name);
                $this->executeGenerateEntitiesCommandAction($import_filter_name);
                $this->executeBuildFormCommandActions($import_filter_name);
                $this->appendToFileAction(ucfirst($ct_entity->getName()));

                $em1->getConnection()->commit();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Custom field  successfully saved!'));
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : ' . $e->getMessage()));
            }
        } else {
            return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : Something '
                        . 'went wrong. Please retry.'));
        }
    }

    public function executeImportCommandAction($filter) {
        $move_to_project = 'C:/xampp5.5.11/htdocs/gtcw_test/';
        $commandline = "php app/console doctrine:mapping:import ESERVClientBundle --filter=$filter yml";

        $process = new \Symfony\Component\Process\Process($commandline);
        $process->setWorkingDirectory($move_to_project);
        $process->run();
        try {
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }
            echo $process->getOutput() . '<hr/>';
        } catch (\RuntimeException $r) {
            echo $r->getMessage();
        }


//        $kernel = $this->container->get('kernel');
//        $kernel = new \AppKernel('dev', true);
//        $app = new Application($kernel);
//        $app->setAutoExit(false);
//        $input = new \Symfony\Component\Console\Input\ArrayInput(
//                array('command' => 'doctrine:mapping:import', 'bundle' => 'ESERVClientBundle', '--filter'
//            => $filter, 'mapping-type' => 'yml'));
//        $app->doRun($input, new \Symfony\Component\Console\Output\ConsoleOutput());
    }

    public function executeGenerateEntitiesCommandAction($entity) {
        $move_to_project = 'C:/xampp5.5.11/htdocs/gtcw_test/';
        $commandline = "php app/console doctrine:generate:entities ESERVClientBundle:$entity --path=src --no-backup";

        $process = new \Symfony\Component\Process\Process($commandline);
        $process->setWorkingDirectory($move_to_project);
        $process->run();
        try {
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }
            echo $process->getOutput() . '<hr/>';
        } catch (\RuntimeException $r) {
            echo $r->getMessage();
        }

//        $kernel = $this->container->get('kernel');
//        $kernel = new \AppKernel('dev', true);
//        $kernel->shutdown();
//        $kernel->boot();
//        $app = new Application($kernel);
//        $app->setAutoExit(false);
//
//        $input = new \Symfony\Component\Console\Input\ArrayInput(
//                array('command' => 'doctrine:generate:entities', 'name' => 'ESERVClientBundle',
//            '--no-backup' => 'true'));
//
//        $app->doRun($input, new \Symfony\Component\Console\Output\ConsoleOutput());
    }

    public function executeBuildFormCommandActions($form_file) {
        $move_to_project = 'C:/xampp5.5.11/htdocs/gtcw_test/';
        $commandline = "php app/console doctrine:generate:form ESERVClientBundle:$form_file";
        $form_type_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR .
                'Form' . DIRECTORY_SEPARATOR . $form_file . 'Type.php';
        if (is_file($form_type_file)) {
            unlink($form_type_file);
        }

        $process = new \Symfony\Component\Process\Process($commandline);
        $process->setWorkingDirectory($move_to_project);
        $process->run();
        try {
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }
            echo $process->getOutput() . '<hr/>';
        } catch (\RuntimeException $r) {
            echo $r->getMessage();
        }

//        $kernel = $this->container->get('kernel');
//        $kernel = new \AppKernel('dev', true);
//        $kernel->shutdown();
//        $kernel->boot();
//        $app = new Application($kernel);
//        $app->find('doctrine:generate:form');
//        $app->setAutoExit(false);
//
//        $input = new \Symfony\Component\Console\Input\ArrayInput(
//                array('command' => 'doctrine:generate:form', 'entity' => 'ESERVClientBundle:' . $entity . ''));
//
//        $app->doRun($input, new \Symfony\Component\Console\Output\ConsoleOutput());
    }

    public function appendToFileAction($tableName) {
        $rootDir = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                . DIRECTORY_SEPARATOR . 'MAIN' . DIRECTORY_SEPARATOR . 'ContactBundle' . DIRECTORY_SEPARATOR .
                'Entity' . DIRECTORY_SEPARATOR . 'MTLEntities' . DIRECTORY_SEPARATOR . 'MyPerson.php';

        $var_name = 'eservClient' . $tableName;
//        $random = substr(number_format(time() * rand(),0,'',''),0,10);
        $myFile = $rootDir;
        $stringData = ''
                . '//start_' . $var_name . "\n"
                . 'public $' . $var_name . ';' . ""
                . "\n\n"
                . 'public function setEservClient' . $tableName . '(\ESERV\ClientBundle\Entity\EservClient' . $tableName . ' $' . $var_name . ' = null)' . "\n"
                . "{" . "\n"
                . '$this->' . $var_name . ' = $' . $var_name . ';' . "\n"
                . 'return $this;' . "\n"
                . "}"
                . "\n\n"
                . 'public function getEservClient' . $tableName . '()' . "\n"
                . "{" . "\n"
                . 'return $this->' . $var_name . ';' . "\n"
                . "}" . "\n"
                . '//end_' . $var_name . "\n"
                . "\n\n/***/";

        $file_get_contents = file_get_contents($rootDir);
        $pattern = '/(public )\$(' . $var_name . ';+)/';
        if (!preg_match($pattern, $file_get_contents)) {
            $str = str_replace("/***/", $stringData, $file_get_contents);
            $file_new_contents = $str;
            file_put_contents($myFile, $file_new_contents);
        }
    }

}
