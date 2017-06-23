<?php

namespace ESERV\MAIN\QualificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\DataTables;

class EstablishmentController extends Controller {

    public $establishment_columns;
    public $establishment_table_id = 'eserv_establishment_table';
    public $establishment_filters;

    public function __construct() {
        $this->establishment_columns = array(
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
            'qualTypeName' => array(
                'qualTypeName',
                'options' => array(
                    'col_name' => 'qualTypeName',
                    'header' => 'Establishment Type',
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
                    'css_class' => 'hide_for_mobile',
                    'col_name' => 'postcode',
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
            'dateOpened' => array(
                'dateOpened',
                'col_type' => 'date',
                'options' => array(
                    'col_name' => 'dateOpened',
                    'header' => 'Date Created',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'dateClosed' => array(
                'dateClosed',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Date Closed',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                    'col_name' => 'dateClosed',
                    'visible' => false
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/organisation/establishment/render/[[id]]',
                'url_params' => array(
                    'id' => 'organisation_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'organisation.establishment.establishment_render({id:5})',
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
        
        $this->establishment_filters = array(
            'type' => 'tabs',
            'tabs' => array(
                array(
                    'id' => 'establishment_details',
                    'header' => 'Establishment Details',
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
                        'qualTypeName' => 'Establishment Type',
                    )
                ),
                array(
                    'id' => 'establishment_contact_details',
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
                    'id' => 'establishment_date_open_close',
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
    }

    public function establishmentsListAction() 
    {
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->establishment_table_id, array(
            'columns' => $this->establishment_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_establishment_ajax_list'),
            'filtering' => $this->establishment_filters
        ));

        return $this->render('ESERVTestBundle:Establishment:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->establishment_table_id,
        ));
    }

    public function dataAction(Request $request) 
    {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleEstablishmentServices',
                    'function_name' => 'ListEstablishments',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'organisation_id',
            'columns' => $this->establishment_columns,
            'filtering' => $this->establishment_filters,
            'exact_match_redirection' => true,
            'table_id' => $this->establishment_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function renderEstablishmentAction($id, Request $request) {
        $myArray = array();
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_ESTABLISHMENT);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        $em = $this->getDoctrine()->getManager();
        $organisation = $em->getRepository('ESERVMAINContactBundle:Organisation')->find($id);        
        
        $establishment = $em->getRepository('ESERVMAINQualificationBundle:Establishment')->findOneBy(array('organisation' =>$organisation ));       

        $entitySerializer = new \ESERV\MAIN\Services\EntitySerializer($em);
        
        $establishment_rec = $entitySerializer->toArray($establishment);
        $organisation_rec = $entitySerializer->toArray($organisation);

        foreach ($client_table_array as $key => $value) {
            if (count($client_table_array[$key]) != 0) {
                $myArray[$key] = array(
                    'title' => $value['title'],
                    'entity_id' => $organisation->getContact()->getId(),
                    'table_id' => $key
                );
            }
        }

        return $this->render('ESERVTestBundle:Establishment:render.html.twig', array(
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'id' => $id,
                    'establishment' => $establishment_rec,
                    'organisation' => $organisation_rec,
        ));
    }

    public function newEstablishmentAction(Request $request) 
    {
        $action_url = $this->generateUrl('eserv_main_establishment_create');
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_ESTABLISHMENT);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);        
        
        //Contains only client table id's
        $client_table_id_array = array_keys($client_table_array);                

        //Gets field, type, option information for the client tables
        $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes($client_table_id_array);
        
        //Alt language
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME);

        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal  eserv_form_editable'),
            'client_table_array' => $client_table_array,            
            'alt_languages' =>  $this->atl_languages
        );

        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\Establishment\EstablishmentType(), null, $form_options_array);        

        $myArray = array();

        foreach ($client_table_array as $key => $value) {
            if (count($field_name_and_type_array[$key]) != 0) {
                $myArray[$key] = array(
                    'view' => $form->get($value['name'])->createView(),
                    'title' => $value['title']
                );
            }
        }

        return $this->render('ESERVTestBundle:Establishment:add.html.twig', array(
                    'form' => $form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'alt_languages' =>  $this->atl_languages
        ));
    }

    public function createEstablishmentAction(Request $request) {
        
        $status = false;
        $result = array();
        $errors_array = array();
        
        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME);
        
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_ESTABLISHMENT);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);    
        
        $form_options_array = array(                   
            'alt_languages' =>  $this->atl_languages,
            'client_table_array' => $client_table_array,                
        );
        
        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\Establishment\EstablishmentType(),null,$form_options_array);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->getConnection()->beginTransaction();
                $establishment_data = $form->getData();
                $contact_type = $em->getRepository('ESERVMAINContactBundle:ContactType')
                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CT_ORGANISATION));
                $contact_status = $em->getRepository('ESERVMAINContactBundle:ContactStatus')
                        ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CS_LIVE,
                    'contactType' => $contact_type));
                
                if (!is_null($contact_status)) {
                    $contact = new \ESERV\MAIN\ContactBundle\Entity\Contact();
                    $contact->setContactStatus($contact_status);
                    $contact->setDisplayName($establishment_data['name']);
                    $contact->setStatusDate($establishment_data['dateOpened']);
                    $contact->setContactType($contact_type);
                    $em->persist($contact);
                    $em->flush();

                    $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                            ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_ESTABLISHMENT_CODE, 'contactType' => $contact_type));
                    
                } else {
                    $tmp = ' Contact status cannot be blank';
                    throw new \Exception($tmp, 500);
                }

                if (!is_null($contact_subtype_list)) {
                    $contact_subtype = new \ESERV\MAIN\ContactBundle\Entity\ContactSubtype();
                    $contact_subtype->setContactSubtypeList($contact_subtype_list);
                    $contact_subtype->setContact($contact);
                    $em->persist($contact_subtype);
                    $em->flush();

                    $organisation = new \ESERV\MAIN\ContactBundle\Entity\Organisation();
                    $organisation->setContact($contact);
                    $organisation->setName($establishment_data['name']);
                    $organisation->setDateOpened($establishment_data['dateOpened']);
                    $em->persist($organisation);
                    $em->flush();

                    $address_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                            ->findOneBy(array('code' => 'M', 'contactType' => $contact_type));
                } else {
                    $tmp = ' Contact subtype cannot be blank';
                    throw new \Exception($tmp, 500);
                }
                if (!is_null($address_type)) {
                    $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                    $address->setContact($contact);
                    $address->setAddressType($address_type);
                    $address->setAddressLine1($establishment_data['address1']);
                    $address->setAddressLine2($establishment_data['address2']);
                    $address->setAddressLine3($establishment_data['address3']);
                    $address->setTown($establishment_data['town']);
                    $address->setCounty($establishment_data['county']);
                    $address->setPostcode($establishment_data['postcode']);
                    $address->setStartDate($establishment_data['dateOpened']);
                    $address->setPrimaryRecord('Y');
                    $em->persist($address);
                    $em->flush();

                } else {
                    $tmp = ' Address type cannot be blank';
                    throw new \Exception($tmp, 500);
                }

                if (!is_null($establishment_data['phoneNumber']) && $establishment_data['phoneNumber'] != '') {
                    $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                     ->getOneByCodeAndApplicationTypeCode(
                                           \ESERV\MAIN\Services\AppConstants::AC_ORGANISATION_PHONE_NUMBER
                                          ,\ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE
                                       );
                    if (is_object($phone_type)) {                
                        $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                        $phone->setContact($contact);
                        $phone->setPhoneType($phone_type);
                        $phone->setPhoneNumber($establishment_data['phoneNumber']);
                        $phone->setPrimaryRecord('Y');
                        $em->persist($phone);
                        $em->flush();
                    }else {
                        $tmp = ' Phone Type cannot be blank';
                        throw new \Exception($tmp, 500);
                    }
                } 
                

                if (
                    (!is_null($establishment_data['webAddress'])) && 
                    ($establishment_data['webAddress'] != '')
                   ) {
                    $website_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                     ->getOneByCodeAndApplicationTypeCode(
                                           \ESERV\MAIN\Services\AppConstants::AC_MAIN_WEBSITE
                                          ,\ESERV\MAIN\Services\AppConstants::ACT_WEBSITE
                                       );
                    if (is_object($website_type)) {
                        $website = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Website();
                        $website->setContact($contact);
                        $website->setWebAddType($website_type);
                        $website->setWebAddress($establishment_data['webAddress']);
                        $website->setPrimaryRecord('Y');
                        $em->persist($website);
                        $em->flush();
                    } else {
                        $tmp = ' Website Type cannot be blank';
                        throw new \Exception($tmp, 500);
                    }
                }
                
                $app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                        ->findOneBy(array('id' => $establishment_data['type']));

                $establishment = new \ESERV\MAIN\QualificationBundle\Entity\Establishment();
                $establishment->setOrganisation($organisation);
                $establishment->setQualType($app_code);
                $establishment->setCode($establishment_data['code']);
                $em->persist($establishment);
                $em->flush();

                // persisting 'alt_language_equivlant' record(s) for each give value
                $establishment_id = $establishment->getId();
                if ($establishment_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName) && $altName != '') {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME, $establishment->getOrganisation()->getId(), $altName);
                        }
                    }
                }
                
                //persisting client tables
                foreach ($client_table_array as $key => $value) {
                    $em->persist($establishment_data[$value['name']]);
                    $em->persist($establishment_data[$value['name']]->setEntityId($contact->getId()));
                    $em->flush();
                }

                $em->getConnection()->commit();
                $status = true;
                $message = ' New Establishment has been successfully added!';
            } catch (\Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                $message = 'An error occurred while executing :- ' . $e->getMessage();
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
            # return $message;
            return new Response('<html><body> message = ' . $message . '</body></html>');
        }
    }

    public function editEstablishmentAction($id, Request $request) {
        $status = false;
        $result = array();

        $em = $this->getDoctrine()->getManager();
        
        $organisation_rep = $em->getRepository('ESERVMAINContactBundle:Organisation')->find($id);
        $contact = $organisation_rep->getContact();
        $establishment_rep = $em->getRepository('ESERVMAINQualificationBundle:Establishment')->findOneBy(array('organisation' => $organisation_rep));
        $action_url = $this->generateUrl('eserv_main_establishment_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME);
        $this->existing_alt_languages_equivs =  $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME, $establishment_rep->getOrganisation()->getId());

        if (!$establishment_rep && !$request->isMethod('POST')) {
            $message = 'No Establishment found for id ' . $id;

            if (!$request->isXmlHttpRequest()) {
                $result = array(
                    'success' => $status,
                    'msg' => $message,
                    'goto' => 'establishment'
                );
                return new \Symfony\Component\HttpFoundation\JsonResponse($result);
            } else {
                throw $this->createNotFoundException(
                        'No Establishment found for id ' . $id
                );
            }
        }

        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName('Establishment');
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

        $organisation = $organisation_rep;

        $establishment = $em->getRepository('ESERVMAINQualificationBundle:Establishment')
                ->findOneBy(array('organisation' => $organisation->getId()));
        $qual_type_id = $establishment->getQualType();

        $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                      ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

        $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                    ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));
        
        $app_code_phone = '';
        if(is_object($phone)){
            $app_code_phone = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                 ->findOneBy(array('id' => $phone->getPhoneType()->getId()));       
        }

        $website = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Website')
                ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));
        $date = $organisation->getDateOpened();

        //Arranging the data array to be showed in the edit screen
        $data_array = array(
            'code' => $establishment->getCode(),
            'name' => $organisation->getName(),           
            'type' => $qual_type_id,
            'address1' => $address ? $address->getAddressLine1() : '',
            'address2' => $address ? $address->getAddressLine2() : '',
            'address3' => $address ? $address->getAddressLine3() : '',
            'town' => $address ? $address->getTown() : '',
            'county' => $address ? $address->getCounty() : '',
            'postcode' => $address ? $address->getPostcode() : '',
            'phoneType' => $app_code_phone,
            'phoneNumber' => (is_object($phone) ? $phone->getPhoneNumber() : '' ),
            'webAddress' => (is_object($website) ? $website->getWebAddress() : '' ),
            'dateOpened' => $date
        );

        $form_options_array = array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal'),
            'client_table_array' => $client_table_array,
            'alt_languages' =>  $this->atl_languages
        );

        $establishment_form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\Establishment\EstablishmentType(), $data_array, $form_options_array);
        $em->close();

        return $this->render('ESERVTestBundle:Establishment:edit.html.twig', array(
                    'form' => $establishment_form->createView(),
                    'id' => $id,
                    'alt_languages' =>  $this->atl_languages,
                    'existing_alt_languages_equivs' =>  $this->existing_alt_languages_equivs
        ));
    }

    public function updateEstablishmentAction($id, Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';

        try {
            $sub_forms_array = null;
            $em = $this->getDoctrine()->getManager();
            $action_url = $this->generateUrl('eserv_main_establishment_update');
            
            $organisation = $em->getRepository('ESERVMAINContactBundle:Organisation')->find($id);
            $contact = $organisation->getContact();
            $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName('Establishment');
            $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);

            $establishment = $em->getRepository('ESERVMAINQualificationBundle:Establishment')
                    ->findOneBy(array('organisation' => $organisation->getId()));
            $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                    ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

            $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                    ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));
            $website = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Website')
                    ->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));
            
            $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME);
            $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME, $establishment->getId());

            $establishment_form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\Establishment\EstablishmentType($em, $client_table_array), null, array('action' => $action_url . '/' . $id, 'alt_languages' => $this->atl_languages));
          
            if ($request->isMethod('POST')) {
                //Updating core entities
                $establishment_form->bind($request);
                if ($establishment_form->isValid()) {                    
                    try {
                        $em->getConnection()->beginTransaction();
                        $postData = $request->request->get('eserv_main_contactbundle_establishment');
                        
                        //changing the display name
                        $contact->setDisplayName($postData['name']);
                        $em->flush();
                    
                        if ($organisation->getName() <> $postData['name']) {
                            $organisation->setName($postData['name']);
                            $formatted_date = $this->container->get('core_function_services')->changeDateFormat($postData['dateOpened']);
                            $organisation->setDateOpened(new \DateTime($formatted_date));
                            $em->persist($organisation);
                            $em->flush();
                        }

                        $app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                       ->findOneBy(array('id' => $postData['type']));
                        $establishment->setQualType($app_code);
                        $establishment->setCode($postData['code']);
                        $em->persist($establishment);
                        $em->flush();
                    
                        $rec_header_id = $establishment->getCode();
                        $rec_header_name = $organisation->getName();
                    
                        // update alt_languages_equivs (drop existing records and create new entries for each added value)
                        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME, $establishment->getOrganisation()->getId());                           
                        if($establishment->getId()){                                        
                            foreach ( $this->atl_languages as $alt_language_id => $alt_language_name) {                                              
                                $altName =  $postData[$alt_language_name];                                                
                                if(!is_null($altName) && $altName != ''){
                                    $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id , \ESERV\MAIN\Services\AppConstants::ESTABLISHMENT_ENTITY_NAME, $establishment->getOrganisation()->getId(), $altName);                             
                                }
                            }                                      
                        }
                        
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
                            ($postData['phoneNumber'] == '') ||
                            (is_null($postData['phoneNumber']))
                           ) {
                            if (is_object($phone)) {
                                $em->remove($phone);
                                $em->flush();
                            }
                        } else {
                            if (is_object($phone)) {
                            } else {
                                $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                                ->getOneByCodeAndApplicationTypeCode(
                                                      \ESERV\MAIN\Services\AppConstants::AC_ORGANISATION_PHONE_NUMBER
                                                     ,\ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE
                                                 );
                                $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                                $phone->setContact($contact);
                                $phone->setPhoneType($phone_type);
                                $phone->setPrimaryRecord('Y');                            
                            }
                            $phone->setPhoneNumber($postData['phoneNumber']);
                            $em->persist($phone);
                            $em->flush();                        
                        }
                    
                        if (
                            (empty($postData['webAddress'])) ||
                            ($postData['webAddress'] == '') ||
                            (is_null($postData['webAddress']))
                           ) {
                            if (is_object($website)) {
                                $em->remove($website);
                                $em->flush();
                            }
                        } else {
                            if (is_object($website)) {
                            } else {
                                $website_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                                   ->getOneByCodeAndApplicationTypeCode(
                                                         \ESERV\MAIN\Services\AppConstants::AC_MAIN_WEBSITE
                                                        ,\ESERV\MAIN\Services\AppConstants::ACT_WEBSITE
                                                    );
                                $website = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Website();
                                $website->setContact($contact);
                                $website->setWebAddType($website_type);
                                $website->setPrimaryRecord('Y');
                            }
                            $website->setWebAddress($postData['webAddress']);
                            $em->persist($website);
                            $em->flush();
                        }
                        
                        $status = true;
                        $message = 'Establishment successfully updated!';
                 
                        $em->getConnection()->commit();
                    } catch (\Exception $e) {
                        $em->getConnection()->rollback();
                        $message = 'An error occurred: ' . $e->getMessage();
                    }                        
                } else {
                    $message = 'Form is invalid';
                    $errors_array = $this->container->get('core_function_services')->getEservFormErrors($establishment_form->getErrors(true));
                }
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'errors' => $errors_array,
            'msg' => $message
        );
        
        if(isset($rec_header_id)){
           $result['rec_header_id'] = $rec_header_id;
        }
        if(isset($rec_header_name)){
           $result['rec_header_name'] = $rec_header_name;
        }

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            // return $message;
            return new Response('<html><body> message = ' . $message . '</body></html>');
        }
    }

}
