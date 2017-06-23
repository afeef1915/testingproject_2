<?php

namespace ESERV\MAIN\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function __construct()
    {
        
    }

    public function indexAction()
    {
        return $this->render('ESERVMAINContactBundle:Default:index.html.twig', array('name' => 'test'));
    }

    public function newPersonAction()
    {
        $action_url = $this->generateUrl('eserv_main_person_create');
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\PersonType($this->getDoctrine()->getManager()), null, array(
            'action' => $action_url,
        ));

        $arr = $this->container->get('db_core_function_services')->getTableIdsByEntityName('Person');
        $table_names_array = $this->container->get('db_core_function_services')->getClientTableNamesById($arr);
        $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes(array_keys($table_names_array));

        $myArray = array();

        foreach ($table_names_array as $key => $value) {
            if (count($field_name_and_type_array[$key]) != 0) {
                $myArray[$key] = array(
                    'view' => $form->get($value['name'])->createView(),
                    'title' => $value['title']
                );
            }
        }

        return $this->render('ESERVTestBundle:Default:contact.html.twig', array(
                    'form' => $form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $table_names_array,
                    'myArray' => $myArray
        ));
    }

    public function savePersonAction(Request $request)
    {
        $person = new \ESERV\MAIN\ContactBundle\Entity\Person();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\PersonType($this->getDoctrine()->getManager()), $person);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();

            $person_data = $form->getData();
            
            try {
                $em1->persist($person_data->getContact());
                
                
                $person_client_table_array = $this->container->get('core_function_services')->getClientTableArrayAction(1);
                $client_t = array();
                //persisting client tables
                foreach ($person_client_table_array as $key => $value) {
                    $tmp = 'eservClient' . ucfirst($value['name']);
                    $tmp1 = 'EservClient' . ucfirst($value['name']);
                    $em1->persist($person_data->$tmp);
                    $em1->flush();
                    $client_t[$tmp1] = $person_data->$tmp->getId();                    
                }

                $em1->persist($person_data);
                $em1->flush();
                
                //updating the entity_id's with current person id
                foreach($client_t as $k => $c){                             
                    $client_table = $em1->getRepository('ESERVClientBundle:'.$k)->find($c);                    
                    $client_table->setEntityId($person->getId());
                    $em1->persist($client_table);
                    $em1->flush();
                }
                
                $em1->getConnection()->commit();
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : ' . $e->getMessage()));
            }
            $em1->close();
        } else {
            return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => $form->getErrorsAsString()));
        }
    }

    public function editPersonAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $person = $em->getRepository('ESERVMAINContactBundle:Person')->find($id);

        if (!$person && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No Person found for id ' . $id
            );
        }
        
        $result1 = $em->createQueryBuilder();
        $client_table_map = $result1->select('p')
                ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTableMap', 'p')
                ->where('p.clientEntity = :clientEntityId')
                ->setParameter('clientEntityId', 1)
                ->getQuery()
                ->getResult();

        $client_table_id_array = null;

        foreach ($client_table_map as $c) {
            $client_table_id_array[] = $c->getClientTable()->getId();
        }
        $sub_forms_array = null;
        if (!is_null($client_table_id_array)) {
            $result2 = $em->createQueryBuilder();
            $client_table_name_array = $result2->select('p.name')
                    ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable', 'p')
                    ->where('p.id IN (:id)')
                    ->setParameter('id', $client_table_id_array)
                    ->getQuery()
                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            
            foreach ($client_table_name_array as $n) {
                $name = '\ESERV\ClientBundle\Form\EservClient' . $n['name'] . 'Type';
                $test = $em->getRepository('ESERVClientBundle:EservClient' . $n['name'])->findOneBy(array('entityId' => $id));
                $sub_forms_array['eserv_clientbundle_eservclient'.strtolower($n['name'])] = $this->createForm(new $name(), $test);
            }
        }

        $person_form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\PersonType(
                $this->getDoctrine()->getManager()), $person);


        if ($request->isMethod('POST')) {

            if (!is_null($sub_forms_array)) {
                foreach ($sub_forms_array as $key => $value) {
                    if ($request->request->has($key)) {
                        $value->bind($request);
                        if ($value->isValid()) {
                            $em->flush();
                            echo 'yes!';
                            die;
                        }
                    }
                }
            }
        }
        
        $arr1 = $this->container->get('db_core_function_services')->getTableIdsByEntityName('Person');
        $table_names_array = $this->container->get('db_core_function_services')->getClientTableNamesById($arr1);
        $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes(array_keys($table_names_array));
        
        $myArray = array();

        foreach ($table_names_array as $key => $value) {
            if (count($field_name_and_type_array[$key]) != 0) {
                $split = split('eserv_client_', $value['name']);
                $ucfirst = ucfirst($split[1]);
                   
                $name = '\ESERV\ClientBundle\Form\EservClient' . $ucfirst . 'Type';
                $test = $em->getRepository('ESERVClientBundle:EservClient' . $ucfirst)->findOneBy(array('entityId' => $id));
                #$sub_forms_array['eserv_clientbundle_eservclient'.strtolower($ucfirst)] = $this->createForm(new $name(), $test);
                
                $myArray[$key] = array(
                    'view' => $this->createForm(new $name(), $test)->createView(),
                    'title' => $value['title']
                );
            }
        }
        $arr = array('form' => $person_form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $table_names_array,
                    'myArray' => $myArray);
        
        return $this->render('ESERVTestBundle:Default:contact2.html.twig', $arr);
    }
    
    public function newOrganisationAction()
    {
        $action_url = $this->generateUrl('eserv_main_organisation_create');
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\OrganisationType($this->getDoctrine()->getManager()), null, array(
            'action' => $action_url,
        ));

        return $this->render(
                        'ESERVTestBundle:Default:contact.html.twig', array('form' => $form->createView())
        );
    }

    public function saveOrganisationAction(Request $request)
    {
        $organisation = new \ESERV\MAIN\ContactBundle\Entity\Organisation();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\OrganisationType($this->getDoctrine()->getManager()), $organisation);
        $form->handleRequest($request);
        $em1 = $this->getDoctrine()->getManager();

        $em1->getConnection()->beginTransaction();
        if ($form->isValid()) {

            $organisation_data = $form->getData();

            try {
                $em1->persist($organisation_data->getContact());

                $person_client_table_array = $this->container->get('core_function_services')->getClientTableArrayAction(2);

                foreach ($person_client_table_array as $key => $value) {
                    $tmp = 'eservClient' . ucfirst($value['name']);
                    $em1->persist($organisation_data->$tmp);
                }


                $em1->persist($organisation_data);
                $em1->flush();
                $em1->getConnection()->commit();
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                return $this->render('ESERVTestBundle:Default:success.html.twig', array('message' => 'Error occurred : ' . $e->getMessage()));
            }
        }
        $em1->close();
    }

    public function getFormTypes()
    {
        
    }

}
