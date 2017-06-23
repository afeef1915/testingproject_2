<?php

namespace ESERV\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ESERVClientBundle:Default:index.html.twig', array('name' => $name));
    }

    public function newClientFormAction($table_id, $entity_id) {
        $group_name = $this->container->get('db_core_function_services')->getOnlyClientTableNameById($table_id);
        if ($group_name != '') {
            $form_name = 'EservClient' . $group_name . 'Type';
            $entity_path = '\ESERV\ClientBundle\Form\\' . $form_name;
            $action_url = $this->generateUrl('eserv_client_update_form');
            $data_rep = $this->getDoctrine()->getManager()->getRepository('ESERVClientBundle:EservClient' . $group_name)
                    ->findOneBy(array('entityId' => $entity_id));

            $form = $this->createForm(new $entity_path(), $data_rep, array(
                'action' => $action_url . '/' . $table_id . '/' . $entity_id,
                'attr' => array(
                    'id' => 'eserv_form_' . $table_id . '_' . $entity_id,
                    'class' => 'eserv_form form-horizontal',
                )
            ));

            $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes(array($table_id));

            // Array ( [1] => Array ( [name] => eserv_client_denominational [title] => Denominational ) )
            $table_name_array = $this->container->get('db_core_function_services')->getClientTableNameById($table_id);
            $client_form_array = array();


            foreach ($table_name_array as $key => $value) {

                $client_form_array[$key] = array(
                    'view' => $form->createView(),
                    'title' => $value['title']
                );
            }



            return $this->render('ESERVClientBundle:Default:newform.html.twig', array(
                        'form' => $form->createView(),
                        'field_name_and_types' => $field_name_and_type_array,
                        'table_names_array' => $table_name_array,
                        'client_form_array' => $client_form_array
            ));
        } else {
            return 'Client table not found';
        }
    }

    public function updateClientFormAction($table_id, $entity_id, Request $request) {
        $status = false;
        $message = '';
        $em = $this->getDoctrine()->getManager();

        $group_name = $this->container->get('db_core_function_services')->getOnlyClientTableNameById($table_id);
        $client_table_title = $em->getRepository('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable')
                    ->findOneBy(array('id' => $table_id));
        
        $ct_title = (is_object($client_table_title) ? $client_table_title->getTitle() : '' );
       
        try {
            
            $client_group = $em->getRepository('ESERVClientBundle:EservClient' . $group_name)
                    ->findOneBy(array('entityId' => $entity_id));

            $form_name = 'EservClient' . $group_name . 'Type';
            $entity_path = '\ESERV\ClientBundle\Form\\' . $form_name;

            if (is_null($client_group)) {
                $entityName = '\ESERV\ClientBundle\Entity\EservClient' . $group_name;
                $client_group = new $entityName();
            }

            $client_group_form = $this->createForm(new $entity_path(), $client_group, array());
            
            $client_group_form->bind($request);

            $formEntityId = $client_group_form->getData()->getEntityId();

            if (is_null($formEntityId)) {
                $client_group->setEntityId($entity_id);
            }

            if ($client_group_form->isValid()) {
                $em->persist($client_group);
                $em->flush();

                $message =  $ct_title. ' successfully updated!';
                $status = true;
            } else {
                $message = 'Update failed! - ' . $client_group_form->getErrors();
                $status = false;
            }
            $result = array(
                'success' => $status,
                'msg' => $message
            );
        } catch (\Exception $e) {
            $message = ucfirst($group_name) . ' updating failed - ' . $e->getMessage();
            $result = array(
                'success' => $status,
                'msg' => $message
            );
        }

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

}
