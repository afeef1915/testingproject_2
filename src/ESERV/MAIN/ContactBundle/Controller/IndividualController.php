<?php

namespace ESERV\MAIN\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;

class IndividualController extends Controller
{
    public $individual_columns;
    public $individual_table_id = 'eserv_individual_table';
    public $individual_filters;

    public function __construct() 
    {
        $this->individual_columns = array(
            'initials' => array(
                'initials',
                'options' => array(
                    'col_name' => 'initials',
                    'header' => 'Initials',
                    'visible' => false
                )
            ),
            'firstName' => array(
                'firstName',
                'options' => array(
                    'col_name' => 'firstName',
                    'header' => 'Forename(s)',
                )
            ),
//            'middleName' => array( //see Log : 9041655
//                'middleName',
//                'options' => array(
//                    'col_name' => 'middleName',
//                    'header' => 'Middle Name',
//                    'visible' => false
//                )
//            ),
            'lastName' => array(
                'lastName',
                'options' => array(
                    'col_name' => 'lastName',
                    'header' => 'Surname',
                )
            ),            
            'dateOfBirth' => array(
                'dateOfBirth',
                'col_type' => 'date',
                'options' => array(
                    'col_name' => 'dateOfBirth',
                    'header' => 'Date of Birth',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/people/individuals/render/[[id]]',
                'url_params' => array(
                    'id' => 'dtindex'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'people.manage_individuals.render_individual({id: 5})',
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
        
        $this->individual_filters = array(
            'type' => 'tabs',
            'tabs' => array(
                array(
                    'id' => 'personal_details',
                    'header' => 'Personal Details',
                    'fields' => array(                        
                        'initials' => 'Initials',
                        'firstName' => 'Forename(s)',
//                        'middleName' => 'Middle Name',  //see Log : 9041655
                        'lastName' => 'Surname',
                        'dateOfBirth' => array(
                            'label' => 'Date of Birth',
                            'widget' => array(
                                'type' => 'date_from_to',
                                'date_fields' => array(
                                    'from_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '-100:-16',
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    ),
                                    'to_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '-100:-16',
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    )
                                ),
                            )
                        ),
                    )
                ),                               
            )
        );
    }
    
    public function individualListAction() 
    {
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->individual_table_id, array(
            'columns' => $this->individual_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_individual_ajax_list'),
            'filtering' => $this->individual_filters
        ));

        return $this->render('ESERVTestBundle:Individual:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->individual_table_id,
        ));
    }
    
    public function dataAction(Request $request) 
    {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleIndividualServices',
                    'function_name' => 'ListIndividuals',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'dtindex',
            'columns' => $this->individual_columns,
            'filtering' => $this->individual_filters,
            'exact_match_redirection' => true,
            'table_id' => $this->individual_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function renderIndividualAction($id, Request $request) {
        $myArray = array();
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_PERSON, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_PER_INDIVIDUAL);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        $em = $this->getDoctrine()->getManager();
        
        $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($id);
        $contactSubtypeList = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')->findOneBy(
                array('code' => \ESERV\MAIN\Services\AppConstants::CSL_INDIVIDUAL_CODE));
        $individual = $em->getRepository('ESERVMAINContactBundle:ContactSubtype')->findOneBy(
                array('contact' => $contact, 'contactSubtypeList' => $contactSubtypeList));
        
        $entitySerializer = new \ESERV\MAIN\Services\EntitySerializer($em);
        
        $individual_rec = $entitySerializer->toArray($individual);        

        foreach ($client_table_array as $key => $value) {
            if (count($client_table_array[$key]) != 0) {
                $myArray[$key] = array(
                    'title' => $value['title'],
                    'entity_id' => $id,
                    'table_id' => $key
                );
            }
        }

        return $this->render('ESERVTestBundle:Individual:render.html.twig', array(
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'id' => $id,
                    'individual' => $individual_rec,                    
        ));
    }
    
    
    public function newIndividualAction()
    {
        $action_url = $this->generateUrl('eserv_main_individual_create');

        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_PERSON, \ESERV\MAIN\Services\AppConstants::CLSUEN_PER_INDIVIDUAL);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);

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

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Individual\PersonType(), null, $form_options_array);


        $myArray = array();


        foreach ($client_table_array as $key => $value) {
            if (count($field_name_and_type_array[$key]) != 0) {
                $myArray[$key] = array(
                    'view' => $form->get($value['name'])->createView(),
                    'title' => $value['title']
                );
            }
        }



        return $this->render('ESERVTestBundle:Individual:add.html.twig', array(
                    'form' => $form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
        ));
    }

    public function createIndividualAction(Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        
        $message = '';
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_PERSON, \ESERV\MAIN\Services\AppConstants::CLSUEN_PER_INDIVIDUAL);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);

        $form_options_array = array(
            'client_table_name_array' => $client_table_array
        );
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Individual\PersonType(), null, $form_options_array);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $set_primary_phone = TRUE;
            try {
                $em->getConnection()->beginTransaction();
                $individual_data = $form->getData();

                $em->persist($individual_data->getContact());
                $em->persist($individual_data);
                $valid_add_arr = $this->container
                        ->get('core_function_services')
                        ->validateAddress(
                        array(
                    'address_line1' => array(
                        'key' => 'addressLine1',
                        'value' => $individual_data->getAddress()->getAddressLine1()
                    ),
                    'address_line2' => array(
                        'key' => 'addressLine2',
                        'value' => $individual_data->getAddress()->getAddressLine2()
                    ),
                    'address_line3' => array(
                        'key' => 'addressLine3',
                        'value' => $individual_data->getAddress()->getAddressLine2()
                    ),
                    'postcode' => array(
                        'key' => 'postcode',
                        'value' => $individual_data->getAddress()->getPostcode()
                    ),
                    'town' => array(
                        'key' => 'town',
                        'value' => $individual_data->getAddress()->getTown()
                    ),
                    'county' => array(
                        'key' => 'county',
                        'value' => $individual_data->getAddress()->getCounty()
                    ),
                    'country' => null,
                        )
                        , FALSE
                );
                if ($valid_add_arr['success'] === false && count($valid_add_arr['errors']) > 0) {
                    if ($request->isXmlHttpRequest()) {
                        return new \Symfony\Component\HttpFoundation\JsonResponse($valid_add_arr);
                    } else {
                        return $valid_add_arr;
                    }
                }
                if(!empty($individual_data->getAddress()->getAddressLine1())){ 
                    $individual_data->getAddress()->setContact($individual_data->getContact());
                    $individual_data->getAddress()->setPrimaryRecord('Y');
                    $em->persist($individual_data->getAddress());
                }
                if(!empty($individual_data->getPhone()->getPhoneNumber())){ 
                    $individual_data->getPhone()->setContact($individual_data->getContact());
                    $individual_data->getPhone()->setPrimaryRecord('Y');
                    $em->persist($individual_data->getPhone());
                    $set_primary_phone = FALSE;
                }
                if(!empty($individual_data->getMobile()->getPhoneNumber())){ 
                    $individual_data->getMobile()->setContact($individual_data->getContact());
                    if ($set_primary_phone) {
                        $individual_data->getMobile()->setPrimaryRecord('Y');
                    }
                    $em->persist($individual_data->getMobile());
                }
                if(!empty($individual_data->getEmail()->getEmailAddress())){ 
                    $individual_data->getEmail()->setContact($individual_data->getContact());
                    $individual_data->getEmail()->setPrimaryRecord('Y');
                    $em->persist($individual_data->getEmail());
                }
      
                $em->flush();
                
                $contact_subtype = new \ESERV\MAIN\ContactBundle\Entity\ContactSubtype();
                $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_INDIVIDUAL_CODE,
                    'contactType' => $individual_data->getContact()->getContactType()));
                $contact_subtype->setContact($individual_data->getContact());
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
                    $client_table->setEntityId($individual_data->getContact()->getId());
                    $em->persist($client_table);
                    $em->flush();
                }

                $em->getConnection()->commit();
                $status = true;
                $message = ' New Individual has been successfully added!';
                
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
    
    public function editIndividualAction($id, Request $request)
    {
        $status = false;
        $result = array();
        $message = ''; 
        
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($id);
        $contactSubtypeList = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')->findOneBy(
                array('code' => \ESERV\MAIN\Services\AppConstants::CSL_INDIVIDUAL_CODE));
        $individual = $em->getRepository('ESERVMAINContactBundle:ContactSubtype')->findOneBy(
                array('contact' => $contact, 'contactSubtypeList' => $contactSubtypeList));

        $action_url = $this->generateUrl('eserv_main_individual_update');

        if (!$individual) {
            $message = 'No Individual found for id ' . $id;

            if (!$request->isXmlHttpRequest()) {
                $result = array(
                    'success' => $status,
                    'msg' => $message,
                    'goto' => 'individual'
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
        
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Individual\PersonType(), $person, $form_options_array);
        
        return $this->render('ESERVTestBundle:Individual:edit.html.twig', array(
                    'form' => $form->createView(),  
        ));
    }
    
    public function updateIndividualAction($id, Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->getConnection()->beginTransaction();
            $action_url = $this->generateUrl('eserv_main_individual_update');
            $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($id);
            $person = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                    array('contact' => $contact));
            $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->findOneBy(
                    array('contact' => $contact, 'primaryRecord' => 'Y'));
            $email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')->findOneBy(
                    array('contact' => $contact, 'primaryRecord' => 'Y'));
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
            
            $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Individual\PersonType(), $person, array(
                'action' => $action_url . '/' . $id));
            $form->handleRequest($request);
            if ($request->isMethod('POST') && $form->isValid()) {
                
                if($mobile && empty($person->getMobile()->getPhoneNumber())){
                    $em->remove($mobile);
                }
                else if(!$mobile && !empty($person->getMobile()->getPhoneNumber())){
                    $mobile = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                    $mobile->setContact($person->getContact());                    
                    $mobile->setPhoneNumber($person->getMobile()->getPhoneNumber());
                    $mobile->setPhoneType($mobileAppCode);
                    $mobile->setPrimaryRecord('N');
                    $em->persist($mobile);
                }
                
                if($phone && empty($person->getPhone()->getPhoneNumber())){
                    $em->remove($phone);
                }
                else if(!$phone && !empty($person->getPhone()->getPhoneNumber())){
                    $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                    $phone->setContact($person->getContact());
                    $phone->setPhoneNumber($person->getPhone()->getPhoneNumber());
                    $phone->setPhoneType($phoneAppCode);
                    $phone->setPrimaryRecord('Y');
                    $em->persist($phone);
                }
                
                $valid_add_arr = $this->container
                        ->get('core_function_services')
                        ->validateAddress(
                        array(
                    'address_line1' => array(
                        'key' => 'addressLine1',
                        'value' => $person->getAddress()->getAddressLine1()
                    ),
                    'address_line2' => array(
                        'key' => 'addressLine2',
                        'value' => $person->getAddress()->getAddressLine2()
                    ),
                    'address_line3' => array(
                        'key' => 'addressLine3',
                        'value' => $person->getAddress()->getAddressLine3()
                    ),
                    'postcode' => array(
                        'key' => 'postcode',
                        'value' => $person->getAddress()->getPostcode()
                    ),
                    'town' => array(
                        'key' => 'town',
                        'value' => $person->getAddress()->getTown()
                    ),
                    'county' => array(
                        'key' => 'county',
                        'value' => $person->getAddress()->getCounty()
                    ),
                    'country' => null,
                        )
                        , FALSE
                );
                if ($valid_add_arr['success'] === false && count($valid_add_arr['errors']) > 0) {                    
                    if ($request->isXmlHttpRequest()) {
                        return new \Symfony\Component\HttpFoundation\JsonResponse($valid_add_arr);
                    } else {
                        return $valid_add_arr;
                    }
                }                
                if($address && empty($person->getAddress()->getAddressLine1())){
                    $em->remove($address);
                }
                else if(!$address && !empty($person->getAddress()->getAddressLine1())){                    
                    $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                    $address->setContact($person->getContact());
                    $address->setPrimaryRecord('Y');
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
                
                if($email && empty($person->getEmail()->getEmailAddress())){
                    $em->remove($email);
                }
                else if(!$email && !empty($person->getEmail()->getEmailAddress())){
                    $email = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email();
                    $email_type_act = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')
                                ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::ACT_EMAIL_ADDRESS_TYPE));
                    $email_type_ac = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('applicationCodeType' => $email_type_act,
                        'code' => \ESERV\MAIN\Services\AppConstants::AC_PERSONAL_EMAIL));

                    $email->setEmailAddress($person->getEmail()->getEmailAddress());                    
                    $email->setEmailType($email_type_ac);
                    $email->setContact($contact);
                    $email->setPrimaryRecord('Y');
                    $em->persist($email);                    
                }
                  
                $em->flush();
                        
                $em->getConnection()->commit();
                $status = true;
                $message = 'Individual has been successfully updated!';
            }else{
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
