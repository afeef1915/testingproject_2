<?php

namespace ESERV\MAIN\MembershipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;
use ESERV\MAIN\Services\ErrorCodeConstants;

class EmployerController extends Controller {

    public $employer_columns;
    public $employer_table_id = 'eserv_employer_table';
    public $employer_filters;
    public $emp_employee_columns;
    public $emp_employee_table_id = 'eserv_employer_employee_table';

    public function __construct() {
        $this->employer_columns = array(
            'referenceNo' => array(
                'referenceNo',
                'options' => array(
                    'col_name' => 'referenceNo',
                    'header' => 'Reference No',
                    'visible' => false,
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'code' => array(
                'code',
                'options' => array(
                    'col_name' => 'code',
                    'header' => 'Code',
                    'width' => '110px',
                    'css_class' => 'center',
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'col_name' => 'name',
                    'header' => 'Name',
                )
            ),
            'previousName' => array(
                'previousName',
                'options' => array(
                    'col_name' => 'previousName',
                    'header' => 'Previous Name',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'welshName' => array(
                'welshName',
                'options' => array(
                    'col_name' => 'welshName',
                    'header' => 'Welsh Name',
                )
            ),
            'employerTypeName' => array(
                'employerTypeName',
                'options' => array(
                    'col_name' => 'employerTypeName',
                    'header' => 'Employer Type',
                )
            ),
            'addressLine1' => array(
                'addressLine1',
                'options' => array(
                    'col_name' => 'addressLine1',
                    'header' => 'Address Line 1',
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'addressLine2' => array(
                'addressLine2',
                'options' => array(
                    'col_name' => 'addressLine2',
                    'header' => 'Address Line 2',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'addressLine3' => array(
                'address_line3',
                'options' => array(
                    'col_name' => 'addressLine3',
                    'header' => 'Address Line 3',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'postcode' => array(
                'postcode',
                'options' => array(
                    'header' => 'Postcode',
                    'css_class' => 'center',
                    'col_name' => 'postcode'
                )
            ),
            'town' => array(
                'town',
                'options' => array(
                    'col_name' => 'town',
                    'header' => 'Town',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'county' => array(
                'county',
                'options' => array(
                    'col_name' => 'county',
                    'header' => 'County',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),          
            'potentialMembers' => array(
                'potentialMembers',
                'options' => array(
                    'col_name' => 'potentialMembers',
                    'header' => 'Potential Members',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'noMembers' => array(
                'noMembers',
                'options' => array(
                    'col_name' => 'noMembers',
                    'header' => 'No. of Members',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'noEmployees' => array(
                'noEmployees',
                'options' => array(
                    'col_name' => 'noEmployees',
                    'header' => 'No. of Employees',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'isClosed' => array(
                'isClosed',
                'options' => array(
                    'col_name' => 'is_closed',
                    'header' => 'Is Closed',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'dateOpened' => array(
                'dateOpened',
                'col_type' => 'date',
                'options' => array(
                    'col_name' => 'dateOpened',
                    'header' => 'Date Opened',
                    'width' => '130px',
                    'css_class' => 'center',
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'dateClosed' => array(
                'dateClosed',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Date Closed',
                    'width' => '130px',
                    'css_class' => 'center',
                    'css_class' => 'hide_for_mobile',
                    'col_name' => 'dateClosed',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/organisation/employer/render/[[id]]',
                'url_params' => array(
                    'id' => 'organisation_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'organisation.employer.employer_render({id:5})',
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'View',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
        );
        
        $this->employer_filters = array(
            'type' => 'tabs',
            'tabs' => array(
                array(
                    'id' => 'employer_details',
                    'header' => 'Employer Details',
                    'fields' => array(
                        'code' => array(
                            'label' => 'Code',
                            'eserv_extra_validation' => array(
                                'lettercase' => 'upper',
                            )
                        ),
                        'referenceNo' => 'Reference No',
                        'name' => 'Name',
                        'previousName' => 'Previous Name',
                        'welshName' => 'Welsh Name',
                        'employerTypeName' => 'Employer Type',
                    )
                ),
                array(
                    'id' => 'employer_contact_details',
                    'header' => 'Contact Details',
                    'fields' => array(
                        'addressLine1' => 'Address Line 1',
                        'addressLine2' => 'Address Line 2',
                        'addressLine3' => 'Address Line 3',
                        'postcode' => array(
                            'label' => 'Postcode',
                            'eserv_extra_validation' => array(
                            )
                        ),
                        'town' => 'Town',
                        'county' => 'County',
                    )
                ),
                array(
                    'id' => 'employer_statistic_details',
                    'header' => 'Statistic Details',
                    'fields' => array(                        
                        'potentialMembers' => 'Potential Members',
                        'noMembers' => 'No. of Members',
                        'noEmployees' => 'No. of Employees',
                    )
                ),
                array(
                    'id' => 'employer_date_open_close',
                    'header' => 'Date Opened/Closed',
                    'fields' => array(
                        'dateOpened' => array(
                            'label' => 'Date Opened',
                            'widget' => array(
                                'type' => 'date_from_to',
                                'date_fields' => array(
                                    'from_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '-100:+100',
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    ),
                                    'to_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '-100:+100',
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    )
                                ),
                            )
                        ),
                        'dateClosed' => array(
                            'label' => 'Date Closed',
                            'widget' => array(
                                'type' => 'date_from_to',
                                'date_fields' => array(
                                    'from_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '-100:+100',
                                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                                            )
                                        )
                                    ),
                                    'to_field' => array(
                                        'eserv_extra_validation' => array(
                                            'date' => array(
                                                'yearrange' => '-100:+100',
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
        
        $this->emp_employee_columns = array(            
            'referenceNo' => array(
                'referenceNo',
                //uncomment this lines below and see what's happening - Anjana :) 
//                'col_type' => 'url',
//                'eserv_title_text' => array(
//                    'url' => '#/registrant/list/render/[[contactId]]/[[niNumber]]',
//                    'params' => array(
//                        'contactId',
//                        'niNumber'
//                    )
//                ),
                'options' => array(
                    'header' => 'Reference No.',                    
                    'sortable' => true,                    
                )
            ),            
            'contactId' => array(
                'contactId',
                'options' => array(
                    'header' => 'Contact ID',
                    'sortable' => true,
                    'visible' => false
                )
            ),
            'niNumber' => array(
                'niNumber',
                'options' => array(
                    'header' => 'NI Number',
                    'sortable' => true,
                )
            ),
//            'title' => array(
//                'title',
//                'options' => array(
//                    'header' => 'Title',
//                    'sortable' => true,
//                )
//            ),
            'firstName' => array(
                'firstName',
                'options' => array(
                    'header' => 'First Name',
                    'sortable' => true,
                )
            ),
            'lastName' => array(
                'lastName',
                'options' => array(
                    'header' => 'Last Name',
                    'sortable' => true,
                )
            ),
            'register' => array(
                'register',
                'options' => array(
                    'header' => 'Type',
                    'css_class' => 'hide_for_mobile',
                    'sortable' => true,
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/registrant/list/render/[[contactId]]',
                'url_params' => array(
                    'contactId' => 'contactId'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'organisation.employer.employer_render({id:5})',
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'View',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
            
        );
        
    }

    public function employersListAction() 
    {
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->employer_table_id, array(
            'columns' => $this->employer_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_employer_ajax_list'),
            'filtering' => $this->employer_filters
        ));

        return $this->render('ESERVTestBundle:Employer:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->employer_table_id,
                    'table_id' => 'contents_wrapper_' . $this->employer_table_id,
        ));
    }

    public function dataAction(Request $request) {
        $is_closed = $this->container->get('datatables_services')->getDataTableRequestParameter($request, 'is_closed');
        
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleEmployerServices',
                    'function_name' => 'ListEmployers',
                    'function_params' => array(
                        'is_closed' => $is_closed
                    )
                )
            ),
            'index_col' => 'organisation_id',
            'columns' => $this->employer_columns,
            'filtering' => $this->employer_filters,
            'exact_match_redirection' => true,
            'table_id' => $this->employer_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function renderEmployerAction($id, Request $request) {
        $myArray = array();
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_EMPLOYER);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        $em = $this->getDoctrine()->getManager();
        $organisation = $em->getRepository('ESERVMAINContactBundle:Organisation')->findOneBy(array('id' => $id));
        $employer = $em->getRepository('ESERVMAINMembershipBundle:Employer')->findOneBy(array('organisation' => $organisation));
        
        $entitySerializer = new \ESERV\MAIN\Services\EntitySerializer($em);

        $employer_rec = $entitySerializer->toArray($employer);
        $organisation_rec = $entitySerializer->toArray($organisation);        
        $employer_type = $employer->getEmployerType()->getCode();

        foreach ($client_table_array as $key => $value) {
            if (count($client_table_array[$key]) != 0) {
                $myArray[$key] = array(
                    'title' => $value['title'],
                    'entity_id' => $organisation->getContact()->getId(),
                    'table_id' => $key
                );
            }
        }

        return $this->render('ESERVTestBundle:Employer:render.html.twig', array(
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'id' => $id,
                    'employer' => $employer_rec,
                    'organisation' => $organisation_rec,
                    'employer_type' => $employer_type,
        ));
    }

    public function newEmployerAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $action_url = $this->generateUrl('eserv_main_employer_create');

        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_EMPLOYER);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);

        //Contains only client table id's
        $client_table_id_array = array_keys($client_table_array);

        //Gets field, type, option information for the client tables
        $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes($client_table_id_array);

        //Alt language
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME);

        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal  eserv_form_editable'),
            'client_table_array' => $client_table_array,
            'alt_languages' => $this->atl_languages,
            'ac_urls' => array(                
                'employer' => $this->generateUrl('eserv_main_employer_contractor_auto_complete', array('emp_type' => array(\ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_WORK_BASED_CONTRACTOR))),
            )
        );
        
        $yo_app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->getOneByCodeAndApplicationTypeCode(\ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_YOUTH_ORGANISATION, \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE);
        $yo_app_code_id = $yo_app_code->getId();
        $sub_contractor_app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->getOneByCodeAndApplicationTypeCode(\ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_WORK_BASED_SUB_CONTRACTOR, \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE);
        $sub_contractor_app_code_id = $sub_contractor_app_code->getId();
        
        $form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Employer\AddEmployerType(), null, $form_options_array);

        $myArray = array();

        foreach ($client_table_array as $key => $value) {
            if (count($field_name_and_type_array[$key]) != 0) {
                $myArray[$key] = array(
                    'view' => $form->get($value['name'])->createView(),
                    'title' => $value['title']
                );
            }
        }

        return $this->render('ESERVTestBundle:Employer:add.html.twig', array(
                    'form' => $form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'alt_languages' => $this->atl_languages,
                    'yo_app_code_id' => $yo_app_code_id,
                    'sub_contractor_app_code_id' => $sub_contractor_app_code_id,
        ));
    }

    public function createEmployerAction(Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME);

        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_EMPLOYER);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);

        $form_options_array = array(
            'client_table_array' => $client_table_array,
            'alt_languages' => $this->atl_languages,
            'ac_urls' => array(                
                'employer' => $this->generateUrl('eserv_main_employer_contractor_auto_complete', array('emp_type' => array(\ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_WORK_BASED_CONTRACTOR))),
            )
        );
        
        $form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Employer\AddEmployerType(), null, $form_options_array);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->getConnection()->beginTransaction();
                $employer_data = $form->getData();   
                $postData = $request->request->get('eserv_main_membershipbundle_employer');                

                $services = new \ESERV\MAIN\MembershipBundle\Services\ESERVMAINMembershipBundleEmployerServices($em, $this->container);
                $code_exists = $services->getEmployerCodes($employer_data['code']);

                if ($code_exists) {
                    throw new \Exception(ErrorCodeConstants::EMP_ADD_CODE_EXISTS, 500);
                }

                $contact_status = $em->getRepository('ESERVMAINContactBundle:ContactStatus')
                        ->getOneByCodeAndContactStatus(
                        \ESERV\MAIN\Services\AppConstants::CS_LIVE
                        , \ESERV\MAIN\Services\AppConstants::CT_ORGANISATION
                );
                $contact_type = $contact_status->getContactType();

                if (!is_null($contact_status)) {
                    $contact = new \ESERV\MAIN\ContactBundle\Entity\Contact();
                    $contact->setContactStatus($contact_status);
                    $contact->setDisplayName($employer_data['name']);
                    $contact->setStatusDate($employer_data['dateOpened']);
                    $contact->setContactType($contact_type);
                    $em->persist($contact);
                    $em->flush();
                } else {
                    $tmp = ErrorCodeConstants::CONTACT_STATUS_EMPTY;
                    throw new \Exception($tmp, 500);
                }

                $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                        ->findOneBy(
                        array('code' => \ESERV\MAIN\Services\AppConstants::CSL_EMPLOYER,
                            'contactType' => $contact_type)
                );
                if (!is_null($contact_subtype_list)) {
                    $contact_subtype = new \ESERV\MAIN\ContactBundle\Entity\ContactSubtype();
                    $contact_subtype->setContactSubtypeList($contact_subtype_list);
                    $contact_subtype->setContact($contact);
                    $em->persist($contact_subtype);
                    $em->flush();

                    $organisation = new \ESERV\MAIN\ContactBundle\Entity\Organisation();
                    $organisation->setContact($contact);
                    $organisation->setName($employer_data['name']);
                    $organisation->setDateOpened($employer_data['dateOpened']);                    
                    if( isset($employer_data['volunteerOrg']) ){                                           
                       $organisation->setVolunteerOrg('Y');
                    }
                    $em->persist($organisation);
                    $em->flush();
                } else {
                    $tmp = ErrorCodeConstants::CONTACT_SUBTYPE_EMPTY;
                    throw new \Exception($tmp, 500);
                }

                $valid_add_arr = $this->container
                        ->get('core_function_services')
                        ->validateAddress(
                        array(
                    'address_line1' => array(
                        'key' => 'address1',
                        'value' => $employer_data['address1']
                    ),
                    'address_line2' => array(
                        'key' => 'address2',
                        'value' => $employer_data['address2']
                    ),
                    'address_line3' => array(
                        'key' => 'address3',
                        'value' => $employer_data['address3']
                    ),
                    'postcode' => array(
                        'key' => 'postcode',
                        'value' => $employer_data['postcode']
                    ),
                    'town' => array(
                        'key' => 'town',
                        'value' => $employer_data['town']
                    ),
                    'county' => array(
                        'key' => 'county',
                        'value' => $employer_data['county']
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
                } else {
                    if (
                            (empty($employer_data['address1'])) ||
                            ($employer_data['address1'] == NULL) ||
                            ($employer_data['address1'] == '')) {
                        #Do not insert the address as an address is not required and the address data has not been entered
                    } else {
                        $address_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                                ->findOneBy(
                                array('code' => \ESERV\MAIN\Services\AppConstants::AT_MAIN_ADDRESS,
                                    'contactType' => $contact_type));
                        $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                        $address->setContact($contact);
                        $address->setAddressType($address_type);
                        $address->setAddressLine1($employer_data['address1']);
                        $address->setAddressLine2($employer_data['address2']);
                        $address->setAddressLine3($employer_data['address3']);
                        $address->setTown($employer_data['town']);
                        $address->setCounty($employer_data['county']);
                        $address->setPostcode($employer_data['postcode']);
                        $address->setStartDate($employer_data['dateOpened']);
                        $address->setPrimaryRecord('Y');

                        $em->persist($address);
                        $em->flush();
                    }
                }

                if (!empty($employer_data['phoneNumber'])) {

                    $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->getOneByCodeAndApplicationTypeCode(
                            \ESERV\MAIN\Services\AppConstants::AC_ORGANISATION_PHONE_NUMBER
                            , \ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE
                    );
                    if (!is_null($phone_type)) {
                        $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                        $phone->setContact($contact);
                        $phone->setPhoneType($phone_type);
                        $phone->setPhoneNumber($employer_data['phoneNumber']);
                        $phone->setPrimaryRecord('Y');
                        $em->persist($phone);
                        $em->flush();
                    }
                }

                if (!empty($employer_data['webAddress'])) {
                    $website_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->getOneByCodeAndApplicationTypeCode(
                            \ESERV\MAIN\Services\AppConstants::AC_MAIN_WEBSITE
                            , \ESERV\MAIN\Services\AppConstants::ACT_WEBSITE
                    );
                    if (!is_null($website_type)) {
                        $website = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Website();
                        $website->setContact($contact);
                        $website->setWebAddType($website_type);
                        $website->setWebAddress($employer_data['webAddress']);
                        $website->setPrimaryRecord('Y');
                        $em->persist($website);
                        $em->flush();
                    }
                }

                // persisting employer
                $app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                        ->findOneBy(array('id' => $employer_data['type']));
                $employer = new \ESERV\MAIN\MembershipBundle\Entity\Employer();
                $employer->setOrganisation($organisation);
                $employer->setEmployerType($app_code);
                $employer->setCode($employer_data['code']);
                $em->persist($employer);
                $em->flush();
                
                // persisting contractor(s) for sub-contractor
                $sub_contractor_app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                        ->getOneByCodeAndApplicationTypeCode(\ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_WORK_BASED_SUB_CONTRACTOR, \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE);
                $sub_contractor_app_code_id = $sub_contractor_app_code ? $sub_contractor_app_code->getId() : null;
                $sub_contractor_id = $employer->getId();                
                
                if ( $app_code->getId() == $sub_contractor_app_code_id && $sub_contractor_id ) {                                       
                    $sub_contractor_contact = $employer->getOrganisation()->getContact();                    
                    $contractor_ids = $postData['contractor'];
                    $rel_services = new \ESERV\MAIN\ContactBundle\Services\ContactBundleRelationshipService($em, $this->container);                    
                    $relationship_type = $em->getRepository('ESERVMAINContactBundle:RelationshipType')->findOneBy( 
                            array('description' => \ESERV\MAIN\Services\AppConstants::RELATIONSHIP_TYPE_SUB_CONTRACTOR_OF));
                    $relationship_type_id = $relationship_type->getId();   
                    foreach ($contractor_ids as $key => $contractor_id) {
                        $contractor_employer_rec = $em->getRepository('ESERVMAINMembershipBundle:Employer')->findOneBy(array('id' => $contractor_id));                        
                        $contractor_contact = $contractor_employer_rec->getOrganisation()->getContact();                        
                        $rel = new \ESERV\MAIN\ContactBundle\Entity\Relationship();                        
                        $rel->setContactA($sub_contractor_contact);
                        $rel->setContactB($contractor_contact);
                        $rel->setRelationshipType($relationship_type);
                        $rel->setStartDate(new \DateTime());
                        $em->persist($rel);
                        $em->flush();
                    }
                }                                                    
                
                // persisting 'alt_language_equivlant' record(s) for each give value
                $employer_id = $employer->getId();
                if ($employer_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName) && $altName != '') {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME, $employer->getOrganisation()->getId(), $altName);
                        }
                    }
                }

                //persisting client tables                
                foreach ($client_table_array as $key => $value) {
                    $em->persist($employer_data[$value['name']]);
                    $em->persist($employer_data[$value['name']]->setEntityId($contact->getId()));
                    $em->flush();
                }

                $em->getConnection()->commit();
                $status = true;
                $message = ErrorCodeConstants::EMP_ADD_SUCCESSFUL;
            } catch (\Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                $message = ErrorCodeConstants::FORM_ERROR_PREFIX . $e->getMessage();
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

    public function editEmployerAction($id, Request $request) {
        $status = false;
        $result = array();

        $em = $this->getDoctrine()->getManager();

        $organisation_rep = $em->getRepository('ESERVMAINContactBundle:Organisation')->findOneBy(array('id' => $id));
        $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($organisation_rep->getContact()->getId());
        $employer_rep = $em->getRepository('ESERVMAINMembershipBundle:Employer')->findOneBy(array('organisation' => $organisation_rep));
        $action_url = $this->generateUrl('eserv_main_employer_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME, $employer_rep->getOrganisation()->getId());

        $yo_app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->getOneByCodeAndApplicationTypeCode(\ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_YOUTH_ORGANISATION, \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE);
        $yo_app_code_id = $yo_app_code->getId();
        
        if (!$employer_rep && !$request->isMethod('POST')) {
            $message = ErrorCodeConstants::EMP_NOT_FOUND . ' ' . $id;

            if (!$request->isXmlHttpRequest()) {
                $result = array(
                    'success' => $status,
                    'msg' => $message,
                    'goto' => 'employer'
                );
                return new \Symfony\Component\HttpFoundation\JsonResponse($result);
            } else {
                throw $this->createNotFoundException(
                        ErrorCodeConstants::EMP_NOT_FOUND . ' ' . $id
                );
            }
        }

        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName('Employer');
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        $organisation = $organisation_rep;

        $employer = $em->getRepository('ESERVMAINMembershipBundle:Employer')
                ->findOneBy(array('organisation' => $organisation->getId()));
        $emp_type_id = $employer->getEmployerType();

        $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

        $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

        $app_code_phone = '';
        if (is_object($phone)) {
            $app_code_phone = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                    ->findOneBy(array('id' => $phone->getPhoneType()->getId()));
        }

        $website = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Website')
                ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

        $emp = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_EMPLOYER));

        //Dropping existing relationship (EMP to EMP/Consortium) if there's any
        $relationshipType = $em->getRepository('ESERVMAINContactBundle:RelationshipType')
                ->findOneBy(array('contactSubtypeListB' => $emp, 'contactSubtypeListA' => $emp));

        $relationship = $em->getRepository('ESERVMAINContactBundle:Relationship')
                ->findOneBy(array('contactA' => $contact, 'relationshipType' => $relationshipType));

        $employer_b = '';
        if ($relationship) {
            $organisation_b = $em->getRepository('ESERVMAINContactBundle:Organisation')->findOneBy(array(
                'contact' => $relationship->getContactB())
            );

            $employer_b = $em->getRepository('ESERVMAINMembershipBundle:Employer')->findOneBy(array(
                'organisation' => $organisation_b)
            );
        }

        $ac_values = array(
            'consortium_ac' => array(
                'name' => ($relationship ? $organisation_b->getName() : ''),
                'value' => ($relationship ? $employer_b->getId() : '')
        ));



        $date = $organisation->getDateOpened();

        //Arranging the data array to be showed in the edit screen
        $data_array = array(
            'code' => $employer->getCode(),
            'name' => $organisation->getName(),
            'type' => $emp_type_id,
            //'consortium' => $employer_b,
            'address1' => (is_object($address) ? $address->getAddressLine1() : ''),
            'address2' => (is_object($address) ? $address->getAddressLine2() : ''),
            'address3' => (is_object($address) ? $address->getAddressLine3() : ''),
            'town' => (is_object($address) ? $address->getTown() : ''),
            'county' => (is_object($address) ? $address->getCounty() : ''),
            'postcode' => (is_object($address) ? $address->getPostcode() : ''),
            'phoneType' => $app_code_phone,
            'phoneNumber' => (is_object($phone) ? $phone->getPhoneNumber() : '' ),
            'webAddress' => (is_object($website) ? $website->getWebAddress() : '' ),
            'dateOpened' => $date,
            'dateClosed' => (($organisation->getDateClosed() != NULL) ? $organisation->getDateClosed() : NULL),
            'volunteerOrg' => (($organisation->getVolunteerOrg() == 'Y') ? true : false),
        );

        $form_options_array = array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal'),
            'client_table_array' => $client_table_array,
            'alt_languages' => $this->atl_languages,
            'ac_urls' => array(
                'consortium_ac' => $this->generateUrl('eserv_main_employer_consortium_auto_complete')
            )
        );

        $employer_form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Employer\EditEmployerType(), $data_array, $form_options_array);
        $em->close();

        return $this->render('ESERVTestBundle:Employer:edit.html.twig', array(
                    'form' => $employer_form->createView(),
                    'id' => $id,
                    'alt_languages' => $this->atl_languages,
                    'existing_alt_languages_equivs' => $this->existing_alt_languages_equivs,
                    'ac_values' => json_encode($ac_values),
                    'ac_values_arr' => $ac_values,
                    'yo_app_code_id' => $yo_app_code_id,
        ));
    }

    public function updateEmployerAction($id, Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';

        try {
            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();
            $action_url = $this->generateUrl('eserv_main_employer_update');

            $organisation = $em->getRepository('ESERVMAINContactBundle:Organisation')->find($id);
            $org_date_opened_formatted = (!is_null($organisation->getDateOpened()) ? $organisation->getDateOpened()->format('Y-m-d H:i:s') : '');

            $contact = $organisation->getContact();
            $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName('Employer');
            $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

            $employer = $em->getRepository('ESERVMAINMembershipBundle:Employer')
                    ->findOneBy(array('organisation' => $organisation->getId()));
            $current_emp_code = $employer->getCode();
            $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                    ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

            $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                    ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));
            $website = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Website')
                    ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

            $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME);
            $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME, $employer->getId());

            $form_options_array = array(
                'action' => $action_url . '/' . $id,
                'client_table_array' => $client_table_array,
                'alt_languages' => $this->atl_languages,
                'ac_urls' => array(
                    'consortium_ac' => $this->generateUrl('eserv_main_employer_consortium_auto_complete')
                )
            );

            $employer_form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Employer\EditEmployerType(), null, $form_options_array);

            if ($request->isMethod('POST')) {

                //Updating core entities
                $employer_form->bind($request);
                if ($employer_form->isValid()) {
                    $postData = $request->request->get('eserv_main_membershipbundle_employer');

                    $services = new \ESERV\MAIN\MembershipBundle\Services\ESERVMAINMembershipBundleEmployerServices($em, $this->container);
                    $code_exists = $services->getEmployerCodes($postData['code'], $current_emp_code);

                    if (!$code_exists) {
                        $organisation->setName($postData['name']);
                        
                        //changing the display name
                        $contact->setDisplayName($postData['name']);
                        $em->flush();
                    
                        $arr = $request->request->all();
                        $formatted_date = $this->container->get('core_function_services')->changeDateFormat($postData['dateOpened']);
                        if ($formatted_date <> $org_date_opened_formatted) {
                            #$log = $this->get('logger'); $log->info(sprintf('ESERV\MAIN\MembershipBundle\Controller\EmployerController::updateEmployerAction $formatted_date: %s, $org_date_opened_formatted: %s', $formatted_date, $org_date_opened_formatted));
                            $organisation->setDateOpened(new \DateTime($formatted_date));
                        }

                        if (!empty($postData['dateClosed'])) {
                            $formatted_date_closed = $this->container->get('core_function_services')->changeDateFormat($postData['dateClosed']);
                            $organisation->setDateClosed(new \DateTime($formatted_date_closed));
                        } else {
                            $organisation->setDateClosed(NULL);
                        }
                        
                        if( isset($postData['volunteerOrg']) ){                                           
                            $organisation->setVolunteerOrg('Y');
                        }else{
                            $organisation->setVolunteerOrg(null);
                        }

                        $em->persist($organisation);
                        $em->flush();

                        $app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                ->findOneBy(array('id' => $postData['type']));
                        $employer->setEmployerType($app_code);
                        $employer->setCode($postData['code']);

                        $em->persist($employer);
                        $em->flush();
                        $rec_header_id = $employer->getCode();
                        $rec_header_name = $organisation->getName();

                        // update alt_languages_equivs (drop existing records and create new entries for each added value)
                        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME, $employer->getOrganisation()->getId());
                        if ($employer->getId()) {
                            foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                                $altName = $postData[$alt_language_name];
                                if (!is_null($altName) && $altName != '') {
                                    $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::EMPLOYER_ENTITY_NAME, $employer->getOrganisation()->getId(), $altName);
                                }
                            }
                        }

//                        $address_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
//                                ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::AT_MAIN_ADDRESS,
//                            'contactType' => $contact->getContactType()));
//                        // address
//                        if (!is_object($address) && !empty($postData['address1'])) {
//                            $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
//                            $address->setContact($contact);
//                            $address->setAddressType($address_type);
//                            $address->setAddressLine1($postData['address1']);
//                            $address->setAddressLine2($postData['address2']);
//                            $address->setAddressLine3($postData['address3']);
//                            $address->setTown($postData['town']);
//                            $address->setCounty($postData['county']);
//                            $address->setPostCode($postData['postcode']);
//                            $address->setStartDate(new \DateTime());
//                            $em->persist($address);
//                            $em->flush();
//                        }
//                        if (is_object($address)) {
//                            $address->setAddressType($address_type);
//                            $address->setAddressLine1($postData['address1']);
//                            $address->setAddressLine2($postData['address2']);
//                            $address->setAddressLine3($postData['address3']);
//                            $address->setTown($postData['town']);
//                            $address->setCounty($postData['county']);
//                            $address->setPostCode($postData['postcode']);
//                            $em->flush();
//                        }
                        #guy

                        $valid_add_arr = $this->container
                                ->get('core_function_services')
                                ->validateAddress(
                                array(
                            'address_line1' => array(
                                'key' => 'address1',
                                'value' => $postData['address1']
                            ),
                            'address_line2' => array(
                                'key' => 'address2',
                                'value' => $postData['address2']
                            ),
                            'address_line3' => array(
                                'key' => 'address3',
                                'value' => $postData['address3']
                            ),
                            'postcode' => array(
                                'key' => 'postcode',
                                'value' => $postData['postcode']
                            ),
                            'town' => array(
                                'key' => 'town',
                                'value' => $postData['town']
                            ),
                            'county' => array(
                                'key' => 'county',
                                'value' => $postData['county']
                            ),
                            'country' => null,
                                )
                                , FALSE
                        );


//                        if (count($valid_add_arr) > 0) {
//                            if (array_key_exists('exception', $valid_add_arr)) {
//                                $msg = $valid_add_arr['exception'];
//                            } else {
//                                $msg = sprintf(implode(', ', $valid_add_arr));
//                            }
//                            throw new \Exception($msg);
//                        } 
                        if ($valid_add_arr['success'] === false && count($valid_add_arr['errors']) > 0) {
                            if ($request->isXmlHttpRequest()) {
                                return new \Symfony\Component\HttpFoundation\JsonResponse($valid_add_arr);
                            } else {
                                return $valid_add_arr;
                            }
                        } else {
                            if ((empty($postData['address1'])) ||
                                    ($postData['address1'] == NULL) ||
                                    ($postData['address1'] == '')
                            ) {
                                if (is_object($address)) {
                                    $em->remove($address);
                                    $em->flush();
                                }
                            } else {
                                if (!is_object($address)) {
                                    $address_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                                            ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::AT_MAIN_ADDRESS,
                                        'contactType' => $contact->getContactType()));
                                    $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                                    $address->setContact($contact);
                                    $address->setAddressType($address_type);
                                    $address->setStartDate(new \DateTime());
                                    $address->setPrimaryRecord('Y');
                                }
                                $address->setAddressLine1($postData['address1']);
                                $address->setAddressLine2($postData['address2']);
                                $address->setAddressLine3($postData['address3']);
                                $address->setTown($postData['town']);
                                $address->setCounty($postData['county']);
                                $address->setPostCode($postData['postcode']);
                                $em->persist($address);
                                $em->flush();
                            }
                        }

                        if (
                                (empty($postData['phoneNumber'])) ||
                                ($postData['phoneNumber'] == NULL) ||
                                ($postData['phoneNumber'] == '')
                        ) {
                            if (is_object($phone)) {
                                $em->remove($phone);
                                $em->flush();
                            }
                        } else {
                            if (is_object($phone)) {
                                
                            } else {
//                                $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
//                                                 ->findOneBy(array('id' => $postData['phoneType']));
                                $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                        ->getOneByCodeAndApplicationTypeCode(
                                        \ESERV\MAIN\Services\AppConstants::AC_ORGANISATION_PHONE_NUMBER
                                        , \ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE
                                );
                                $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                                $phone->setContact($contact);
                                $phone->setPhoneType($phone_type);
                            }
                            $phone->setPhoneNumber($postData['phoneNumber']);
                            $phone->setPrimaryRecord('Y');
                            $em->persist($phone);
                            $em->flush();
                        }

                        if (!is_object($website)) {
//                            $app_code_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')
//                                    ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::ACT_WEBSITE));
//                            $website_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
//                                    ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::AC_MAIN_WEBSITE,
//                                'applicationCodeType' => $app_code_type));
                            if (
                                    (empty($postData['webAddress'])) ||
                                    ($postData['webAddress'] == NULL) ||
                                    ($postData['webAddress'] == '')
                            ) {
                                
                            } else {
                                $website_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                        ->getOneByCodeAndApplicationTypeCode(
                                        \ESERV\MAIN\Services\AppConstants::AC_MAIN_WEBSITE
                                        , \ESERV\MAIN\Services\AppConstants::ACT_WEBSITE);
                                $website = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Website();
                                $website->setContact($contact);
                                $website->setWebAddType($website_type);
                                $website->setPrimaryRecord('Y');
                                $website->setWebAddress($postData['webAddress']);
                                $em->persist($website);
                                $em->flush();
                            }
                        } else {
                            if (
                                    (empty($postData['webAddress'])) ||
                                    ($postData['webAddress'] == NULL) ||
                                    ($postData['webAddress'] == '')
                            ) {
                                $em->remove($website);
                                $em->flush();
                            } else {
                                $website->setPrimaryRecord('Y');
                                $website->setWebAddress($postData['webAddress']);
                                $em->persist($website);
                                $em->flush();
                            }
                        }

                        $emp = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                                ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_EMPLOYER));

                        $relationsip_type = $em->getRepository('ESERVMAINContactBundle:RelationshipType')
                                ->findOneBy(array('contactSubtypeListB' => $emp, 'contactSubtypeListA' => $emp));

                        $consortium = '';
                        if (!empty($arr['eserv_main_membershipbundle_employer']['consortium'])) {
                            $consortium = $arr['eserv_main_membershipbundle_employer']['consortium'];
                        }

                        //if($postData['consortium']){
                        if ($consortium != '') {
                            $relationship = $em->getRepository('ESERVMAINContactBundle:Relationship')
                                    ->findOneBy(array('relationshipType' => $relationsip_type, 'contactA' => $contact));
                            $empB = $em->getRepository('ESERVMAINMembershipBundle:Employer')
                                    //->find($postData['consortium']);
                                    ->find($consortium);

                            if ($relationship) {
                                $relationship->setContactB($empB->getOrganisation()->getContact());
                            } else {
                                if (!is_null($relationsip_type)) {
                                    $rel = new \ESERV\MAIN\ContactBundle\Entity\Relationship();
                                    $rel->setContactA($contact);
                                    $rel->setContactB($empB->getOrganisation()->getContact());
                                    $rel->setRelationshipType($relationsip_type);
                                    if (!empty($postData['dateOpened'])) {
                                        $formatted_dateOpened = $this->container->get('core_function_services')->changeDateFormat($postData['dateOpened']);
                                        $rel->setStartDate(new \DateTime($formatted_dateOpened));
                                    } else {
                                        $rel->setStartDate(NULL);
                                    }

                                    $em->persist($rel);
                                } else {
                                    $tmp = ' Relationship type cannot be blank';
                                    throw new \Exception($tmp, 500);
                                }
                            }

                            $em->flush();
                        } else {
                            //Dropping existing relationship (EMP to EMP/Consortium) if there's any
                            $relationship = $em->getRepository('ESERVMAINContactBundle:Relationship')
                                    ->findOneBy(array('relationshipType' => $relationsip_type, 'contactA' => $contact));
                            if ($relationship) {
                                $em->remove($relationship);
                                $em->flush();
                            }
                        }


                        $em->flush();
                        $em->close();

                        $status = true;
                        $message = ErrorCodeConstants::EMP_UPDATE_SUCCESSFUL;
                    } else {
                        $status = false;
                        $message = \ESERV\MAIN\Services\ErrorCodeConstants::EMP_EDIT_CODE_EXISTS;
                    }
                } else {
                    $message = ErrorCodeConstants::FORM_INVALID;
                    $errors_array = $this->container->get('core_function_services')->getEservFormErrors($employer_form->getErrors(true));
                }
            }
            $em->getConnection()->commit();
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();
        }

        $result = array(
            'success' => $status,
            'errors' => $errors_array,
            'msg' => $message
        );
        if (isset($rec_header_name)) {
            $result['rec_header_name'] = $rec_header_name;
        }
        if (isset($rec_header_id)) {
            $result['rec_header_id'] = $rec_header_id;
        }

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function EmployerConsortiumAutoCompAction(Request $request) {
        $param = $request->get('param');
        return $this->container->get('auto_complete_function_services')->EmployerAutoComplete($param, 'CONSORTIUM');
    }

    public function checkReferenceNoAction($refNo) {
        $message = '';
        $success = false;
        $exists = false;
        try {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('ESERVMAINContactBundle:Person')->findOneBy(
                    array('referenceNo' => $refNo));
            if ($result) {
                $exists = true;
            }
            $success = true;
        } catch (\Exception $e) {
            $message = 'Error occurred :- ' . $e->getMessage();
            $success = false;
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'success' => $success,
            'msg' => $message,
            'exists' => $exists
        ));
    }
    
    public function employerEmployeesListAction(Request $request) 
    {   
        $org_id = $request->get('org_id');
        $emp_details_cols = DataTables::formatDataTablesColumnsArray($this->emp_employee_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->emp_employee_table_id, array(
            'columns' => $emp_details_cols,
            'source_url' => $this->container->get('router')->generate('eserv_main_employer_employee_list_data', array('org_id' => $org_id)),
            'initial_sorting_column' => array(
                'column' => 4,
                'direction' => 'asc'
            ),
        ));
        ;
        return $this->render('ESERVTestBundle:Employer:employer_employee_list.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->emp_employee_table_id,
                    'id' => $org_id
        ));
    }

    //Populate data to the Employment Details Data Tables in Employment Details Portlet
    public function employerEmployeesDataAction(Request $request) 
    {
        $org_id = $request->get('org_id'); 
        $em = $this->getDoctrine()->getManager();
        $employer = $em->getRepository('ESERVMAINMembershipBundle:Employer')->findOneBy(array('organisation' => $org_id));
        
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\MembershipBundle\Services\ESERVMAINMembershipBundleEmployerServices',
                    'function_name' => 'ListEmployeesOfEmployer',
                    'function_params' => array(
                        'emp_id' => $employer->getId(),
                        'emp_type' => $employer->getEmployerType()->getCode(),
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->emp_employee_columns,
            'table_id' => $this->emp_employee_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->emp_employee_table_id
        ));

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function EmployerContractorAutoCompAction(Request $request)
    {
        $param = $request->get('q');
        $emp_type = $request->get('emp_type');

        #return $this->container->get('auto_complete_function_services')->ContractorAutoComplete($param, $emp_type);
        return $this->container->get('auto_complete_function_services')->EmployerAutoCompleteForMultiSelect($param, $emp_type);
    }
    
}
