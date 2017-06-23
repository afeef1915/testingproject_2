<?php

namespace ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ClientAdministrationController extends Controller
{

    public function newClientGroupAction()
    {
        $action_url = $this->generateUrl('eserv_client_group_create');
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Form\ClientTableType(), null, array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal'
            )
        ));

        return $this->render(
                'ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientGroup:add.html.twig', 
                    array('form' => $form->createView(),
                          'entity_list' => $this->container->get('client_admin_bundle_services')->ListClientEntityAndSubEntity('array')
                )
        );
    }

    public function saveClientGroupAction(Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        
        $message = '';
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Form\ClientTableType(), null);
        $form->handleRequest($request);
        $em1 = $this->getDoctrine()->getManager();

        $em1->getConnection()->beginTransaction();
        if ($form->isValid()) {
            $form_data = $request->request->get('client_table'); 
            try {
                $formatted_title = trim($form_data['title']);
                $cg_entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable')
                        ->findOneBy(array('title' => $formatted_title));

                $formatted_name = ucfirst(strtolower(trim(str_replace(' ', '', trim($form_data['name'])))));
                $cg_entity2 = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable')
                        ->findOneBy(array('name' => $formatted_name));
                if ($cg_entity) {
                    $message = 'Title already exisits. Please choose a different title.';
                    throw new \Exception($message, 500);
                }
                
                if ($cg_entity2) {
                    $message = 'Table name already exisits. Please choose a different table name.';
                    throw new \Exception($message, 500);
                }
                
                if(!$this->validChr($formatted_name)){
                    $message = 'Table Name cannot have special characters.';
                    throw new \Exception($message, 500);
                }

                $import_filter_name = 'EservClient' . $formatted_name;
                $table_name = 'eserv_client_' . strtolower($formatted_name);
                $entity_id = $form_data['entity_id'];

                $eserv_custom_table = new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientTable();
                $eserv_custom_table->setName($formatted_name);
                $eserv_custom_table->setTitle($formatted_title);
                $eserv_custom_table->setGroupOrder(1);
                $eserv_custom_table->setUserRestrict('N');
                $eserv_custom_table->setDescription($form_data['description']);

                $connection = $em1->getConnection();

                $driver = $connection->getDriver()->getName();
                $qry = $this->container->get('db_core_function_services')->createNewTable($table_name, $driver);

                $statement = $connection->prepare($qry);

                if ($statement->execute()) {
                    $em1->persist($eserv_custom_table);
                    $em1->flush();
                    $this->container->get('core_function_services')->executeImportCommand($import_filter_name);
                    $this->container->get('core_function_services')->executeGenerateEntitiesCommand($import_filter_name);
                    $this->container->get('core_function_services')->executeBuildFormCommand($import_filter_name);
                    

                    $sub_entity_id = $form_data['sub_entity_id'];
                    $ct_entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable')
                                    ->findOneBy(array('id' => $eserv_custom_table->getId()));
                    
                    if(is_array($sub_entity_id)){
                        if(in_array('all', $sub_entity_id)){
                            $entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientEntity')
                                    ->findOneBy(array('id' => $form_data['entity_id']));
                            $eserv_custom_table_map = new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientTableMap();
                            $eserv_custom_table_map->setClientTable($ct_entity);
                            $eserv_custom_table_map->setClientEntity($entity);
                            $em1->persist($eserv_custom_table_map);
                            $em1->flush();
                        }else{                           
                            foreach($sub_entity_id as $k => $v){
                                $sub_entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientEntity')
                                    ->findOneBy(array('id' => $v));
                                $eserv_custom_table_map = new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientTableMap();
                                $eserv_custom_table_map->setClientTable($ct_entity);
                                $eserv_custom_table_map->setClientEntity($sub_entity);
                                $em1->persist($eserv_custom_table_map);
                                $em1->flush();
                            }
                        }                    
                    }

                    $em1->getConnection()->commit();
                    $status = true;
                    $message = 'Client group successfully saved!';
                } else {
                    $message = 'Client group saving failed!';
                }
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
        }else{
            $message = 'Form is invalid';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            // This echo and die to be removed - Anjana
            echo $message;
            die;
        }
    }

    public function newClientFieldAction()
    {
        $action_url = $this->generateUrl('eserv_client_field_create');
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Form\ClientFieldType(), null, array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal'
            )
        ));

        return $this->render(
                        'ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField:add.html.twig', array('form' => $form->createView())
        );
    }

    public function saveClientFieldAction(Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        
        $message = '';
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Form\ClientFieldType(), null);
        $form->handleRequest($request);
        $em1 = $this->getDoctrine()->getManager();

        if ($form->isValid()) {
            $form_data = $request->request->get('client_field');
            $em1->getConnection()->beginTransaction();
            try {
                $formatted_title = strtolower(str_replace(' ', '', substr(trim($form_data['title']),0,29)));

                $cf_entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField')
                        ->findOneBy(array('fieldName' => $formatted_title, 'clientTable' => $form_data['clientTable']));

                if ($cf_entity) {
                    $message = 'Field name ' . $form_data['title'] . ' already exisits. Please choose a different field name.';
                    throw new \Exception($message, 500);
                }
                
                if(!$this->validChr($formatted_title)){
                    $message = 'Title : '. $formatted_title . ' contain special characters. Title cannot have special characters.';
                    throw new \Exception($message, 500);
                }

                $eserv_custom_field = new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientField();
                $ct_entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable')->findOneBy(array(
                    'id' => $form_data['clientTable']));

                $ct_map = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap')->findOneBy(array(
                    'clientTable' => $form_data['clientTable']));

                $us_first_name = ucfirst($ct_entity->getName());                

                $import_filter_name = 'EservClient' . $us_first_name;
                $null = ($form_data['notNull'] == 'Y') ? 'NOT NULL' : 'NULL';

                $symfony_form_type = '';
                $new_field_type = '';
                switch ($form_data['fieldType']) {
                    case 'select' :
                        $symfony_form_type = 'select';
                        $new_field_type = 'VARCHAR';
                        break;
                    case 'DATETIME' :
                        $symfony_form_type = 'datetime';
                        $new_field_type = 'DATETIME';
                        break;
                    case 'DATE' :
                        $symfony_form_type = 'datetime';
                        $new_field_type = 'DATETIME';
                        break;
                    case 'VARCHAR' :
                        $symfony_form_type = 'text';
                        $new_field_type = 'VARCHAR';
                        break;
                    case 'radio' :
                        $symfony_form_type = 'radio';
                        $new_field_type = 'VARCHAR';
                        break;
                    case 'checkbox' :
                        $symfony_form_type = 'checkbox';
                        $new_field_type = 'VARCHAR';
                        $null = 'NULL';
                        break;
                    case 'number' :
                        $symfony_form_type = 'number';
                        $new_field_type = 'VARCHAR';
                        break;
                    default :
                        $symfony_form_type = 'text';
                        $new_field_type = 'VARCHAR';
                }


                $eserv_custom_field->setClientTable($ct_entity);
                $eserv_custom_field->setTitle(trim($form_data['title']));
                $eserv_custom_field->setFieldName($formatted_title);
                $eserv_custom_field->setFieldSize($form_data['fieldSize']);
                $eserv_custom_field->setFieldType($new_field_type);
                $eserv_custom_field->setSymfonyFormType($symfony_form_type);
                $eserv_custom_field->setNotNull($form_data['notNull']);
                $eserv_custom_field->setFieldOrder(1);

                $connection = $em1->getConnection();

                $driver = $connection->getDriver()->getName();

                $custom_table_name = 'eserv_client_' . strtolower($ct_entity->getName());


                $data_array = array(
                    'table_name' => $custom_table_name,
                    'col_name' => $formatted_title,
                    'col_type' => $new_field_type,
                    'col_size' => $form_data['fieldSize'],
                    'col_null' => $null
                );
                $qry = $this->container->get('db_core_function_services')->alterExistingTable($data_array, $driver);
                $statement = $connection->prepare($qry);

                if ($statement->execute()) {
                    $em1->persist($eserv_custom_field);
                    $em1->flush();

                    $select_name_option = $form_data['form_select_names'];
                    $select_name_values = $form_data['form_select_values'];

                    if (isset($select_name_option[0])) {
                        $last_inserted_id = $eserv_custom_field->getId();
                        $ct_field = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField')->findOneBy(array(
                            'id' => $last_inserted_id));

                        for ($a = 0; $a < count($select_name_option); $a++) {
                            $ct_sel_options = new \ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientFieldSelectOption();
                            $ct_sel_options->setClientField($ct_field);
                            $ct_sel_options->setLabel($select_name_option[$a]);
                            $ct_sel_options->setValue($select_name_values[$a]);
                            $em1->persist($ct_sel_options);
                            $em1->flush();
                        }
                    }

                    $this->container->get('core_function_services')->executeImportCommand($import_filter_name);
                    $this->container->get('core_function_services')->executeGenerateEntitiesCommand($import_filter_name);
                    $this->container->get('core_function_services')->executeBuildFormCommand($import_filter_name);

                    $em1->getConnection()->commit();
                    $status = true;
                    $message = 'Client field  successfully saved!';
                } else {
                    $message = 'Client field saving failed!';
                }
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else {
            $message = 'Form is invalid';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            // This echo and die to be removed - Anjana
            echo $message;
            die;
        }
    }

    public function deleteClientGroupAction($id)
    {
        $status = false;
        $result = array();
        
        $message = '';
        $em1 = $this->getDoctrine()->getManager();
        $ctm_entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap')->findOneBy(array(
            'clientTable' => $id));

        $ct_entity = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable')->findOneBy(array(
            'id' => $id));

        $ct_field = $em1->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField')->findBy(array(
            'clientTable' => $id));

        $entity_id = $ctm_entity->getClientEntity()->getId();

        if ($ctm_entity) {
            try {
                $file_name = 'EservClient' . ucfirst($ct_entity->getName());
                $table_name = 'eserv_client' . lcfirst($ct_entity->getName());
                $query1 = $em1->createQuery("DELETE ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap c WHERE c.clientTable = $id");
                $query1->execute();

                if ($ct_field) {
                    foreach ($ct_field as $c) {
                        $query2 = $em1->createQuery("DELETE ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientFieldSelectOption "
                                . "c WHERE c.clientField = (" . $c->getId() . ")");
                        $query2->execute();
                    }
                }

                $query3 = $em1->createQuery("DELETE ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientField c WHERE c.clientTable = $id");
                $query3->execute();

//            $query3 = $em1->createQuery("DROP TABLE $table_name");
//            $query3->execute();

                $em1->remove($ct_entity);
                $em1->flush();



                $entitiy_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                        . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR . 'Entity' . DIRECTORY_SEPARATOR . $file_name . '.php';
                $orm_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                        . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR
                        . 'config' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . $file_name . '.orm.yml';
                $form_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                        . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR . 'Form' . DIRECTORY_SEPARATOR . $file_name . 'Type.php';

                if (!unlink($entitiy_file)) {
                    $message = 'Problem deleting the entity file';
                }
                if (!unlink($orm_file)) {
                    $message = 'Problem deleting the orm file';
                }
                if (!unlink($form_file)) {
                    $message = 'Problem deleting the form file';
                }

                $this->deleteFromEntityFileAction(ucfirst($ct_entity->getName()), $entity_id);

                $status = true;
                $message = 'Client Table has been successfully sdeleted. ';
            } catch (\Exception $e) {
                $message = 'Error occurred - '. $e->getMessage();
            }
        } else {
            $message = 'Client table not found. ';
        }
        
        $result = array(
            'success' => $status,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            // This echo and die to be removed - Anjana
            echo $message;
            die;
        }
    }

    function deleteFromEntityFileAction($table, $entity_id)
    {
        $file_name = '';
        switch ($entity_id) {
            case '1': $file_name = 'MyPerson.php';
                break;
            case '2': $file_name = 'MyOrganisation.php';
                break;
        }
        $client_entity_file = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                . DIRECTORY_SEPARATOR . 'MAIN' . DIRECTORY_SEPARATOR . 'ContactBundle' . DIRECTORY_SEPARATOR .
                'Entity' . DIRECTORY_SEPARATOR . 'MTLEntities' . DIRECTORY_SEPARATOR . $file_name;

        $contents = file_get_contents($client_entity_file);

        $new_content = $this->replace_content_inside_delimiters('//start_eservClient' . $table, '//end_eservClient' . $table, '', $contents);

        file_put_contents($client_entity_file, $new_content);
        if (preg_match("/\\/\\/(start_eservClient$table)/", $contents)) {
            $c = str_replace("//start_eservClient$table//end_eservClient$table", '', $new_content);
            file_put_contents($client_entity_file, $c);
        }
    }

    function replace_content_inside_delimiters($start, $end, $new, $source)
    {
        return preg_replace('#(' . preg_quote($start) . ')(.*)(' . preg_quote($end) . ')#si', '$1' . $new . '$3', $source);
    }
    
    function validChr($str) 
    {
        return preg_match('/^[A-Za-z0-9]+$/',$str);
    }

}
