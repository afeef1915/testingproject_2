<?php

namespace ESERV\MAIN\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;

class MentorController extends Controller
{
    public $mentor_columns;
    public $mentor_table_id = 'eserv_mentor_table';

    public function __construct() 
    {
        $this->mentor_columns = array(
            'lastName' => array(
                'lastName',
                'options' => array(
                    'header' => 'Last Name',
                )
            ),
            'firstName' => array(
                'firstName',
                'options' => array(
                    'header' => 'First Name',
                )
            ),
            'dateOfBirth' => array(
                'dateOfBirth',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Date of Birth',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/people/mentors/edit/[[id]]',
                'url_params' => array(
                    'id' => 'dtindex'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'people.manage_mentors.edit_mentor({id: 5})',
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'Edit',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),           
        );
    }
    
    public function mentorListAction() 
    {
        $mentor_columns = DataTables::formatDataTablesColumnsArray($this->mentor_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->mentor_table_id, array(
            'columns' => $mentor_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_mentor_ajax_list'),
        ));

        return $this->render('ESERVTestBundle:Mentor:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->mentor_table_id,
        ));
    }
    
    public function dataAction(Request $request) 
    {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleMentorServices',
                    'function_name' => 'ListMentors',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'dtindex',
            'columns' => $this->mentor_columns,
            'table_id' => $this->mentor_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function renderMentorAction($id, Request $request) {
        $myArray = array();
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_PERSON, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_PER_MENTOR);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        $em = $this->getDoctrine()->getManager();
        
        $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($id);
        $contactSubtypeList = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')->findOneBy(
                array('code' => \ESERV\MAIN\Services\AppConstants::CSL_MENTOR_CODE));
        $mentor = $em->getRepository('ESERVMAINContactBundle:ContactSubtype')->findOneBy(
                array('contact' => $contact, 'contactSubtypeList' => $contactSubtypeList));
        
        $entitySerializer = new \ESERV\MAIN\Services\EntitySerializer($em);
        
        $mentor_rec = $entitySerializer->toArray($mentor);        

        foreach ($client_table_array as $key => $value) {
            if (count($client_table_array[$key]) != 0) {
                $myArray[$key] = array(
                    'title' => $value['title'],
                    'entity_id' => $id,
                    'table_id' => $key
                );
            }
        }

        return $this->render('ESERVTestBundle:Mentor:render.html.twig', array(
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'id' => $id,
                    'mentor' => $mentor_rec,                    
        ));
    }
    
    
    public function newMentorAction()
    {
        $action_url = $this->generateUrl('eserv_main_mentor_create');

        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(
                \ESERV\MAIN\Services\AppConstants::CLEN_PERSON, \ESERV\MAIN\Services\AppConstants::CLSUEN_PER_MENTOR);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        //Contains only client table id's
        $client_table_id_array = array_keys($client_table_array);

        //Gets field, type, option information for the client tables
        $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes($client_table_id_array);


        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'client_table_name_array' => $client_table_array
        );

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Mentor\PersonType(), null, $form_options_array);


        $myArray = array();


        foreach ($client_table_array as $key => $value) {
            if (count($field_name_and_type_array[$key]) != 0) {
                $myArray[$key] = array(
                    'view' => $form->get($value['name'])->createView(),
                    'title' => $value['title']
                );
            }
        }



        return $this->render('ESERVTestBundle:Mentor:add.html.twig', array(
                    'form' => $form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
        ));
    }

    public function createMentorAction(Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(
                \ESERV\MAIN\Services\AppConstants::CLEN_PERSON, \ESERV\MAIN\Services\AppConstants::CLSUEN_PER_MENTOR);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        $form_options_array = array(
            'client_table_name_array' => $client_table_array
        );

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Mentor\PersonType(), null, $form_options_array);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $set_primary_phone = TRUE;
            try {
                $em->getConnection()->beginTransaction();
                $mentor_data = $form->getData();
                $em->persist($mentor_data->getContact());
                $em->persist($mentor_data);
                
                if(!empty($mentor_data->getAddress()->getAddressLine1())){ 
                    $mentor_data->getAddress()->setContact($mentor_data->getContact());
                    $em->persist($mentor_data->getAddress());
                }
                if(!empty($mentor_data->getPhone()->getPhoneNumber())){ 
                    $mentor_data->getPhone()->setContact($mentor_data->getContact());
                    $mentor_data->getPhone()->setPrimaryRecord('Y');
                    $em->persist($mentor_data->getPhone());
                    $set_primary_phone = FALSE;
                }
                if(!empty($mentor_data->getMobile()->getPhoneNumber())){ 
                    $mentor_data->getMobile()->setContact($mentor_data->getContact());
                    if ($set_primary_phone) {
                        $mentor_data->getMobile()->setPrimaryRecord('Y');
                    }                    
                    $em->persist($mentor_data->getMobile());
                }
                
                $mentor_data->getEmail()->setContact($mentor_data->getContact());
                $em->persist($mentor_data->getEmail());
                $em->flush();
                
                
                $contact_subtype = new \ESERV\MAIN\ContactBundle\Entity\ContactSubtype();
                $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_MENTOR_CODE,
                    'contactType' => $mentor_data->getContact()->getContactType()));
                $contact_subtype->setContact($mentor_data->getContact());
                $contact_subtype->setContactSubtypeList($contact_subtype_list);
                $em->persist($contact_subtype);
                $em->flush();
                
                //persisting client tables
                $client_t = array();
                foreach ($client_table_array as $key => $value) {
                    $tmp1 = 'EservClient' . ucfirst($value['name']);
                    $em->persist($form->get($value['name'])->getData());
                    $em->flush();
                    $client_t[$tmp1] = $form->get($value['name'])->getData()->getId();
                }


                //updating the entity_id's with current mentor id                            
                foreach ($client_t as $k => $c) {
                    $client_table = $em->getRepository('ESERVClientBundle:' . $k)->find($c);
                    $client_table->setEntityId($mentor_data->getContact()->getId());
                    $em->persist($client_table);
                    $em->flush();
                }

                $em->getConnection()->commit();
                $status = true;
                $message = ' New Mentor has been successfully added!';
                
            } catch (\Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                return $message = 'An error occurred while executing :- ' . $e->getMessage();
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
            return $message;
        }
    }
    
    public function editMentorAction($id, Request $request)
    {
        $status = false;
        $result = array();
        $message = ''; 
        
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($id);
        $contactSubtypeList = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')->findOneBy(
                array('code' => \ESERV\MAIN\Services\AppConstants::CSL_MENTOR_CODE));
        $mentor = $em->getRepository('ESERVMAINContactBundle:ContactSubtype')->findOneBy(
                array('contact' => $contact, 'contactSubtypeList' => $contactSubtypeList));

        $action_url = $this->generateUrl('eserv_main_mentor_update');

        if (!$mentor) {
            $message = 'No Mentor found for id ' . $id;

            if (!$request->isXmlHttpRequest()) {
                $result = array(
                    'success' => $status,
                    'msg' => $message,
                    'goto' => 'mentor'
                );
                return new \Symfony\Component\HttpFoundation\JsonResponse($result);
            } else {
                throw $this->createNotFoundException($message);
            }
        }
       
        $form_options_array = array(
            'action' => $action_url . '/'. $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
        ); 
        
        $person = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                array('contact' => $contact));
        $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->findOneBy(
                array('contact' => $contact));
        $email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')->findOneBy(
                array('contact' => $contact));
        $phoneType = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(
                array('code' => \ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE));
        $phoneAppCode = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(
                array('code' => \ESERV\MAIN\Services\AppConstants::AC_PHONE_NUMBER,
                    'applicationCodeType' => $phoneType));
        $mobileAppCode = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(
                array('code' => \ESERV\MAIN\Services\AppConstants::AC_MOBILE_NUMBER,
                    'applicationCodeType' => $phoneType));
        $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')->findOneBy(
                array('contact' => $contact,
                      'phoneType' => $phoneAppCode));
        $mobile = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')->findOneBy(
                array('contact' => $contact,
                      'phoneType' => $mobileAppCode));
        
        $person->setDisabled(false);
        if($person->getDisabled() === 'Y'){
           $person->setDisabled(true);
        }        
        $person->setAddress($address);
        $person->setPhone($phone);
        $person->setMobile($mobile);
        $person->setEmail($email);
        
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Mentor\PersonType(), $person, $form_options_array);
        
        return $this->render('ESERVTestBundle:Mentor:edit.html.twig', array(
                    'form' => $form->createView(),  
        ));
    }
    
    public function updateMentorAction($id, Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->getConnection()->beginTransaction();
            $action_url = $this->generateUrl('eserv_main_mentor_update');
            $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($id);
            $person = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                    array('contact' => $contact));
            $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->findOneBy(
                    array('contact' => $contact));
            $email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')->findOneBy(
                    array('contact' => $contact));
            $phoneType = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(
                    array('code' => \ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE));
            $phoneAppCode = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(
                    array('code' => \ESERV\MAIN\Services\AppConstants::AC_PHONE_NUMBER,
                        'applicationCodeType' => $phoneType));
            $mobileAppCode = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(
                    array('code' => \ESERV\MAIN\Services\AppConstants::AC_MOBILE_NUMBER,
                        'applicationCodeType' => $phoneType));
            $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')->findOneBy(
                    array('contact' => $contact,
                          'phoneType' => $phoneAppCode));
            $mobile = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')->findOneBy(
                    array('contact' => $contact,
                         'phoneType' => $mobileAppCode));
            $person->setDisabled(true);
//            if($person->getDisabled() === 'Y'){
//               $person->setDisabled(true);
//            }
            $person->setAddress($address);
            $person->setPhone($phone);   
            $person->setMobile($mobile);            
            $person->setEmail($email);  
            
            $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Mentor\PersonType(), $person, array(
                'action' => $action_url . '/' . $id));
            $form->handleRequest($request);
            if ($request->isMethod('POST') && $form->isValid()) {
                $set_primary_phone = TRUE;

                if (!$phone && !empty($person->getPhone()->getPhoneNumber())) {
                    $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                    $phone->setContact($person->getContact());
                    $phone->setPhoneNumber($person->getPhone()->getPhoneNumber());
                    $phone->setPhoneType($phoneAppCode);
                    $phone->setPrimaryRecord('Y');
                    $em->persist($phone);
                    
                    $set_primary_phone = FALSE;
                }

                if(!$mobile && !empty($person->getMobile()->getPhoneNumber())){
                    $mobile = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                    $mobile->setContact($person->getContact());
                    $mobile->setPhoneNumber($person->getMobile()->getPhoneNumber());
                    $mobile->setPhoneType($mobileAppCode);
                    $mobile->setPrimaryRecord(($set_primary_phone ? 'Y' : 'N'));
                    $em->persist($mobile);
                }
                
                if(!$address && !empty($person->getAddress()->getAddressLine1())){
                    $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                    $address->setContact($person->getContact());
                    $address->setAddressType($person->getAddress()->getAddressType());
                    $address->setStartDate($person->getAddress()->getStartDate());
                    $address->setAddressLine1($person->getAddress()->getAddressLine1());
                    $address->setAddressLine2($person->getAddress()->getAddressLine2());
                    $address->setAddressLine3($person->getAddress()->getAddressLine3());
                    $address->setPostcode($person->getAddress()->getPostcode());
                    $address->setTown($person->getAddress()->getTown());
                    $address->setCounty($person->getAddress()->getCounty());                    
                    $em->persist($address);
                }
                  
                $em->flush();
                        
                $em->getConnection()->commit();
                $status = true;
                $message = 'Mentor has been successfully updated!';
            } else{
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }                
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $em->close();
            $message = 'An error occurred: ' . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'errors' => $errors_array,
            'msg' => $message
        );
        $em->close();
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            // return $message;
            return new Response('<html><body> message = ' . $message . '</body></html>');
        }
    }

}
