<?php

namespace ESERV\MAIN\MembershipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;

class WorkplaceController extends Controller {

    public $workplace_columns;
    public $workplace_filters;
    public $workplace_table_id = 'eserv_workplace_table';
    public $view_label;

    public function __construct() {
        $this->workplace_columns = array(
            'reference_no' => array(
                'reference_no',
                'options' => array(
                    'col_name' => 'reference_no',
                    'header' => 'Reference No',
                    'visible' => false,
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'code' => array(
                'code',
                'options' => array(
                    'header' => 'Code',
                    'width' => '110px',
                    'css_class' => 'center',
                    'col_name' => 'code'
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Name',
                    'col_name' => 'name'
                )
            ),
            'welshName' => array(
                'welshName',
                'options' => array(
                    'col_name' => 'welshName',
                    'header' => 'Welsh Name',
                )
            ),
            'workplaceTypeName' => array(
                'workplaceTypeName',
                'options' => array(
                    'col_name' => 'workplaceTypeName',
                    'header' => 'Workplace Type',
                )
            ),
            'denomName' => array(
                'denomName',
                'options' => array(
                    'col_name' => 'denomName',
                    'header' => 'Denomination',
                    'css_class' => 'hide_for_mobile',
                )
            ),            
            'address_line1' => array(
                'address_line1',
                'options' => array(
                    'col_name' => 'address_line1',
                    'header' => 'Address Line 1',
                    'css_class' => 'hide_for_mobile',                    
                )
            ),
            'address_line2' => array(
                'address_line2',
                'options' => array(
                    'col_name' => 'address_line2',
                    'header' => 'Address Line 2',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'address_line3' => array(
                'address_line3',
                'options' => array(
                    'col_name' => 'address_line3',
                    'header' => 'Address Line 3',
                    'visible' => false,
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'postcode' => array(
                'postcode',
                'options' => array(
                    'col_name' => 'postcode',
                    'header' => 'Postcode',
                    'css_class' => 'hide_for_mobile',                    
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
            'wp_date_opened' => array(
                'wp_date_opened',
                'col_type' => 'date',
                'options' => array(
                    'col_name' => 'wp_date_opened',
                    'header' => 'Date Opened',
                    'width' => '130px',
                    'css_class' => 'center',
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'wp_date_closed' => array(
                'wp_date_closed',
                'col_type' => 'date',
                'options' => array(
                    'col_name' => 'wp_date_closed',
                    'header' => 'Date Closed',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                    'visible' => true
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/organisation/school/render/[[id]]',
                'url_params' => array(
                    'id' => 'organisation_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'target' => '_self',
                'additional_attr' => array(
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
        
        $this->workplace_filters = array(
            'type' => 'tabs',
            'tabs' => array(
                array(
                    'id' => 'school_details',
                    'header' => 'School Details',
                    'fields' => array(
                        'code' => array(
                            'label' => 'Code',
                            'eserv_extra_validation' => array(
                                'lettercase' => 'upper',
                            )
                        ),
                        'reference_no' => 'Reference No',
                        'name' => 'Name',
                        'welshName' => 'Welsh Name',
                        'workplaceTypeName' => 'Workplace Type',
                        'denomName' => 'Denomination',
                    )
                ),
                array(
                    'id' => 'contact_details',
                    'header' => 'Contact Details',
                    'fields' => array(
                        'address_line1' => 'Address Line 1',
                        'address_line2' => 'Address Line 2',
                        'address_line3' => 'Address Line 3',
                        'postcode' => 'Postcode',
                        'town' => 'Town',
                        'county' => 'County',
                    )
                ),
                array(
                    'id' => 'workplace_date_open_close',
                    'header' => 'Date Opened/Closed',
                    'fields' => array(
                        'wp_date_opened' => array(
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
                        'wp_date_closed' => array(
                            'label' => 'Include Closed Schools?',
                            'widget' => array(
                                'type' => 'dropdown_for_null',
                                'selected_data' => array(     
                                    'N'
                                ),
                                'choices' => array(
                                    'Y' => 'Yes',
                                    'N' => 'No',
                                )
                            )
                        ),
                    )
                ),
            )
        );
        
        $this->employer_workplace_columns = array(
            'wor_code' => array(
                'wor_code',
                'options' => array(
                    'header' => 'Code',
                    'width' => '110px',
                    'css_class' => 'center',
                )
            ),
            'wor_name' => array(
                'wor_name',
                'options' => array(
                    'header' => 'Name',
                )
            ),
            'address_line1' => array(
                'address_line1',
                'options' => array(
                    'header' => 'Address Line 1',
                    'css_class' => 'hide_for_mobile',
                )
            ),
            'wor_date_closed' => array(
                'wor_date_closed',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Date Closed',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                    'col_name' => 'wor_date_closed',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/organisation/school/render/[[id]]',
                'url_params' => array(
                    'id' => 'wor_org_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'target' => '_self',
                'additional_attr' => array(
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

    public function workplacesListAction()      
    {
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->workplace_table_id, array(
            'columns' => $this->workplace_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_workplace_ajax_list'),
            'filtering' => $this->workplace_filters
        ));

        return $this->render('ESERVTestBundle:Workplace:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->workplace_table_id,
        ));
    }

    public function dataAction(Request $request) {

        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleWorkplaceServices',
                    'function_name' => 'ListWorkplaces',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'organisation_id',
            'columns' => $this->workplace_columns,
            'index_col' => 'organisation_id',
            'filtering' => $this->workplace_filters,
            'exact_match_redirection' => true,
            'table_id' => $this->workplace_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function workplacesListByEmployerOrgIdAction(Request $request) {
        $organisation_id = $request->get('id');
        $workplace_columns = DataTables::formatDataTablesColumnsArray($this->employer_workplace_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->workplace_table_id, array(
            'columns' => $workplace_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_workplace_by_employer_ajax_list'),
            'extra_params' => array('organisation_id' => $organisation_id)
        ));

        return $this->render('ESERVTestBundle:Workplace:list_by_employer.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->workplace_table_id,
                    'table_id' => 'contents_wrapper_' . $this->workplace_table_id,
        ));
    }

    public function dataByEmployerOrgIdAction(Request $request) 
    {        
        $organisation_id = $request->get('organisation_id');
        $wor_date_closed = $this->getDataTableRequestParameter($request, 'wor_date_closed');
       
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleWorkplaceServices',
                    'function_name' => 'ListWorkplacesByEmpOragId',
                    'function_params' => array(
                        'organisation_id' => $organisation_id,
                        'wor_date_closed' => $wor_date_closed
                    )
                )
            ),
            'index_col' => 'emp_org_id',
            'columns' => $this->employer_workplace_columns,
            'index_col' => 'emp_org_id',
            'table_id' => $this->workplace_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    protected function getDataTableRequestParameter(Request $request, $param) {
        $sColumns = $request->get('sColumns');
        $col_arr = explode(',', $sColumns);
        
        return $request->get('sSearch_' . array_search($param, $col_arr));
    }

    public function newWorkplaceAction(Request $request) {
        $action_url = $this->generateUrl('eserv_main_workplace_create');
        
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_WORKPLACE);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);        
        
        //Contains only client table id's
        $client_table_id_array = array_keys($client_table_array);                

        //Gets field, type, option information for the client tables
        $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes($client_table_id_array);
        
        //Alt language
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME);
        
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' =>  $this->atl_languages,
            'ac_urls' => array(
                    'employer_ac' => $this->generateUrl('eserv_main_workplace_employer_auto_complete')
                    )
        );

        $form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Workplace\WorkplaceType($this->getDoctrine()->getManager()
                , $client_table_array), null, $form_options_array);

        $myArray = array();

        $em = $this->getDoctrine()->getManager();
        $contact_type = $em->getRepository('ESERVMAINContactBundle:ContactType')->findOneBy(array('code' => 'O'));
        $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')->findOneBy(array('code' => 'WP'));
        $relationship_type = $em->getRepository('ESERVMAINContactBundle:RelationshipType')->findOneBy(
                array('contactTypeB' => $contact_type, 'contactSubtypeListB' => $contact_subtype_list));


        return $this->render('ESERVTestBundle:Workplace:add.html.twig', array(
                    'form' => $form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'label_array' => array('relationship' => $relationship_type->getNameAB()),
                    'alt_languages' =>  $this->atl_languages
        ));
    }

    public function createWorkplaceAction(Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME);
        
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_WORKPLACE);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id, true);              
   
        $form_options_array = array(                   
            'alt_languages' =>  $this->atl_languages,
            'ac_urls' => array(
                    'employer_ac' => $this->generateUrl('eserv_main_workplace_employer_auto_complete')
                    )
        );
        $form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Workplace\WorkplaceType(
                $this->getDoctrine()->getManager(), $client_table_array),null,$form_options_array);
        $form->handleRequest($request);
        
        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->getConnection()->beginTransaction();
                $workplace_data = $form->getData();   
                $arr=$request->request->all();

                $contact_status = $em->getRepository('ESERVMAINContactBundle:ContactStatus')
                                     ->getOneByCodeAndContactStatus(
                                           \ESERV\MAIN\Services\AppConstants::CS_LIVE
                                          ,\ESERV\MAIN\Services\AppConstants::CT_ORGANISATION
                                       );
                $contact_type = $contact_status->getContactType();
                if (!is_null($contact_status)) {
                    $contact = new \ESERV\MAIN\ContactBundle\Entity\Contact();
                    $contact->setContactStatus($contact_status);
                    $contact->setContactType($contact_type);
                    $contact->setDisplayName($workplace_data['name']);                    
                    $contact->setStatusDate($workplace_data['dateOpened'] ? $workplace_data['dateOpened'] : new \DateTime());
                    $em->persist($contact);
                    $em->flush();

                    $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                            ->findOneBy(array('code' => 'WP', 'contactType' => $contact_type));
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
                    $organisation->setName($workplace_data['name']);
                    $organisation->setDateOpened($workplace_data['dateOpened']);
                    $em->persist($organisation);
                    $em->flush();

                    $address_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                            ->findOneBy(array('code' => 'M', 'contactType' => $contact_type));
                } else {
                    $tmp = ' Contact sub type cannot be blank';
                    throw new \Exception($tmp, 500);
                }
                       
                if (!is_null($address_type)) {
                    $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                    $address->setContact($contact);
                    $address->setAddressType($address_type);
                    $address->setAddressLine1($workplace_data['address1']);
                    $address->setAddressLine2($workplace_data['address2']);
                    $address->setAddressLine3($workplace_data['address3']);
                    $address->setTown($workplace_data['town']);
                    $address->setCounty($workplace_data['county']);
                    $address->setPostcode($workplace_data['postcode']);
                    $address->setStartDate($workplace_data['dateOpened'] ? $workplace_data['dateOpened'] : new \DateTime());
                    $address->setPrimaryRecord('Y');
                    $em->persist($address);
                    $em->flush();
                } else {
                    $tmp = ' Address type cannot be blank';
                    throw new \Exception($tmp, 500);
                }               
                if (!is_null($workplace_data['phoneNumber']) && $workplace_data['phoneNumber'] != '') {
                    $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                     ->getOneByCodeAndApplicationTypeCode(
                                           \ESERV\MAIN\Services\AppConstants::AC_ORGANISATION_PHONE_NUMBER
                                          ,\ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE
                                       );
                    if (is_object($phone_type)) {
                        $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                        $phone->setContact($contact);
                        $phone->setPhoneType($phone_type);
                        $phone->setPhoneNumber($workplace_data['phoneNumber']);
                        $phone->setPrimaryRecord('Y');
                        $em->persist($phone);
                        $em->flush();
                    } else {
                        $tmp = ' Phone Type cannot be blank';
                        throw new \Exception($tmp, 500);
                    }
                }
                if (!is_null($workplace_data['webAddress']) && $workplace_data['webAddress'] != '') {
                    $website_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                                     ->getOneByCodeAndApplicationTypeCode(
                                           \ESERV\MAIN\Services\AppConstants::AC_MAIN_WEBSITE
                                          ,\ESERV\MAIN\Services\AppConstants::ACT_WEBSITE
                                       );
                    if (is_object($website_type)) {
                        $website = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Website();
                        $website->setContact($contact);
                        $website->setWebAddType($website_type);
                        $website->setWebAddress($workplace_data['webAddress']);
                        $website->setPrimaryRecord('Y');
                        $em->persist($website);
                        $em->flush();
                    } else {
                        $tmp = ' Website Type cannot be blank';
                        throw new \Exception($tmp, 500);
                    }
                }                
                $app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                        ->findOneBy(array('id' => $workplace_data['type']));
                $workplace = new \ESERV\MAIN\MembershipBundle\Entity\Workplace();
                $workplace->setOrganisation($organisation);
                $workplace->setCode($workplace_data['code']);
                $workplace->setWorkplaceType($app_code);
                $workplace->setDenom($workplace_data['denom']);
                $em->persist($workplace);
                $em->flush();

                // persisting 'alt_language_equivlant' record(s) for each give value
                $workplace_id = $workplace->getId();
                if ($workplace_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName) && $altName != '') {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME, $workplace->getOrganisation()->getId(), $altName);
                        }
                    }
                }

                //$contact_id_a = $workplace_data['relationship'];
                if (!empty($arr['eserv_main_membershipbundle_workplace']['relationship'])) {
                    $contact_id_a = $arr['eserv_main_membershipbundle_workplace']['relationship'];                    
                }else {
                    $tmp = ' Employer cannot be blank';
                    throw new \Exception($tmp, 500);
                }
                $co_a = $em->getRepository('ESERVMAINContactBundle:Contact')
                        ->findOneBy(array('id' => $contact_id_a));

                $emp = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                        ->findOneBy(array('code' => 'EM'));

                $wp = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                        ->findOneBy(array('code' => 'WP'));

                $relationsip_type = $em->getRepository('ESERVMAINContactBundle:RelationshipType')
                        ->findOneBy(array('contactSubtypeListB' => $wp, 'contactSubtypeListA' => $emp));


                if (!is_null($relationsip_type)) {

                    $rel = new \ESERV\MAIN\ContactBundle\Entity\Relationship();
                    $rel->setContactA($co_a);
                    $rel->setContactB($contact);
                    $rel->setRelationshipType($relationsip_type);
                    $rel->setStartDate($workplace_data['dateOpened'] ? $workplace_data['dateOpened'] : new \DateTime());
                    $em->persist($rel);
                    $em->flush();
                } else {
                    $tmp = ' Relationship type cannot be blank';
                    throw new \Exception($tmp, 500);
                }

                
                //persisting client tables
                foreach ($client_table_array as $key => $value) {
                    $em->persist($workplace_data[$value['name']]);
                    $em->persist($workplace_data[$value['name']]->setEntityId($contact->getId()));
                    $em->flush();
                }


                $em->getConnection()->commit();
                $status = true;
                $message = ' New ' . $this->get('translator')->trans('Workplace') . ' has been successfully added!';
            } catch (\Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                $message = 'An error occurred while executing :- ' . $e->getMessage();
            }
        } else {
            $message = 'Form is invalid.';
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

    public function renderWorkplaceAction($id, Request $request) {
        $myArray = array();
        
        //Id's from client entity table
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName(\ESERV\MAIN\Services\AppConstants::CLEN_ORGANISATION, 
                                                                                                     \ESERV\MAIN\Services\AppConstants::CLSUEN_ORG_WORKPLACE);
        //Id's from the client table
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);        
        
        
        $em = $this->getDoctrine()->getManager();        
        $organisation = $em->getRepository('ESERVMAINContactBundle:Organisation')->findOneBy(array('id' => $id));
        $workplace = $em->getRepository('ESERVMAINMembershipBundle:Workplace')->findOneBy(array('organisation' =>$organisation ));             

        $entitySerializer = new \ESERV\MAIN\Services\EntitySerializer($em);
        
        $workplace_rec = $entitySerializer->toArray($workplace);
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

        return $this->render('ESERVTestBundle:Workplace:render.html.twig', array(
                    'table_names_array' => $client_table_array,
                    'myArray' => $myArray,
                    'id' => $id,
                    'workplace' => $workplace_rec,
                    'organisation' => $organisation_rec,
        ));
    }

    public function editWorkplaceAction($id, Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';

        $em = $this->getDoctrine()->getManager();                
        $organisation_rep = $em->getRepository('ESERVMAINContactBundle:Organisation')->findOneBy(array('id' => $id));
        $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($organisation_rep->getContact()->getId());
        $workplace_rep = $em->getRepository('ESERVMAINMembershipBundle:Workplace')->findOneBy(array('organisation' => $organisation_rep));
        $action_url = $this->generateUrl('eserv_main_workplace_edit');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME);
        $this->existing_alt_languages_equivs =  $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME, $workplace_rep->getOrganisation()->getId());

        if (!$workplace_rep && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No ' . $this->get('translator')->trans('Workplace') . ' found for id ' . $id
            );
        }
        
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName('Workplace');
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);
        
        $organisation = $organisation_rep;

        $wrp_rep = $em->getRepository('ESERVMAINMembershipBundle:Workplace')
                ->findOneBy(array('organisation' => $organisation->getId()));        

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
        
        $dateOpened = $organisation->getDateOpened();
        $dateClosed = $organisation->getDateClosed();

        //Arranging the data array to be showed in the edit screen
        $data_array = array(
            'code' => $wrp_rep->getCode(),
            'name' => $organisation->getName(),            
            'type' => $wrp_rep->getWorkplaceType(),
            'denom' => $wrp_rep->getDenom(),
            'address1' => $address ? $address->getAddressLine1() : '',
            'address2' => $address ? $address->getAddressLine2() : '',
            'address3' => $address ? $address->getAddressLine3() : '',
            'town' => $address ? $address->getTown() : '',
            'county' => $address ? $address->getCounty() : '',
            'postcode' => $address ? $address->getPostcode() : '',
            'phoneType' => $app_code_phone,
            'phoneNumber' => (is_object($phone) ? $phone->getPhoneNumber() : '' ),
            'webAddress' => (is_object($website) ? $website->getWebAddress() : '' ),
            'dateOpened' => $dateOpened,
            'dateClosed' => $dateClosed
        );
        
        $employersubtype=$em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_EMPLOYER ));
        $workplacesubtype=$em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')
                ->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::CSL_WORKPLACE));
        $relationshipType=$em->getRepository('ESERVMAINContactBundle:RelationshipType')
                ->findOneBy(array('contactSubtypeListA' => $employersubtype, 
                                  'contactSubtypeListB'  => $workplacesubtype));  
        $relationship = $em->getRepository('ESERVMAINContactBundle:Relationship')
                ->findOneBy(array('contactB' => $contact, 'relationshipType'  => $relationshipType ));
        
        $Organisation = NULL;
        if ($relationship){            
            $Organisation = $em->getRepository('ESERVMAINContactBundle:Organisation')->findOneBy(array('contact' => $relationship->getContactA()));           
        }

        $ac_values = array(
                'employer_ac' => array(
                    'name' => ($Organisation !== NULL ? $Organisation->getName() : ''),
                    'value' => ($Organisation !== NULL ? $Organisation->getContact()->getId() : '')
                ));
        
        $form_options_array = array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal'),
            'alt_languages' =>  $this->atl_languages,
            'ac_urls' => array(
                    'employer_ac' => $this->generateUrl('eserv_main_workplace_employer_auto_complete')
                    )
        );

        $workplace_form = $this->createForm(new \ESERV\MAIN\MembershipBundle\Form\Workplace\WorkplaceType($em, $client_table_array, false), $data_array, $form_options_array);

        //Place where real update happens
        if ($request->isMethod('POST')) {

            //Updating core entities
            $workplace_form->bind($request);
            if ($workplace_form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                
                    $postData = $request->request->get('eserv_main_membershipbundle_workplace');
                    $arr = $request->request->all();
                    $organisation->setName($postData['name']);
                    
                    if(!empty($postData['dateOpened'])){ 
                        $formatted_date = $this->container->get('core_function_services')->changeDateFormat($postData['dateOpened']);
                        $organisation->setDateOpened(new \DateTime($formatted_date));
                    }else{
                        $organisation->setDateOpened(null);
                    }
                    if(array_key_exists('dateClosed', $postData)){                        
                        if($postData['dateClosed'] != ''){
                            $formatted_date = $this->container->get('core_function_services')->changeDateFormat($postData['dateClosed']);
                            $organisation->setDateClosed(new \DateTime($formatted_date));
                        }else{                            
                            $organisation->setDateClosed(null);
                        }
                    }
                    
                    $em->persist($organisation);
                    $em->flush();

                    $app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('id' => $postData['type']));
                    $wrp_rep->setWorkplaceType($app_code);
                    $wrp_rep->setCode($postData['code']);
                    $denom_app_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->findOneBy(array('id' => $postData['denom']));
                    $wrp_rep->setDenom($denom_app_code);
                    $em->persist($wrp_rep);
                    $em->flush();

                    $rec_header_id = $wrp_rep->getCode();
                    $rec_header_name = $organisation->getName();                    

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
                    
                    //changing the display name
                    $contact->setDisplayName($postData['name']);
                    $em->flush();

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
                    
                    if (!empty($arr['eserv_main_membershipbundle_workplace']['relationship'])) {
                        $contact_id_a = $arr['eserv_main_membershipbundle_workplace']['relationship'];                    
                    }else {
                        $tmp = ' Employer cannot be blank';
                        throw new \Exception($tmp, 500);
                    }
                    $contactA = $em->getRepository('ESERVMAINContactBundle:Contact')
                            ->findOneBy(array('id' => $contact_id_a));
                    
                    if (!is_object($relationship)) {
                        $relationship = new \ESERV\MAIN\ContactBundle\Entity\Relationship();                        
                        $relationship->setContactB($contact);
                        $relationship->setRelationshipType($relationshipType);    
                        $relationship->setStartDate(new \DateTime('now'));                        
                    }
                    
                    $relationship->setContactA($contactA);                    
                    $em->persist($relationship);
                    $em->flush(); 
                    
                    // update alt_languages_equivs (drop existing records and create new entries for each added value)
                    $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME, $wrp_rep->getOrganisation()->getId());
                    if ($wrp_rep->getId()) {
                        foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                            $altName = $postData[$alt_language_name];
                            if (!is_null($altName) && $altName != '') {
                                $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::WORKPLACE_ENTITY_NAME, $wrp_rep->getOrganisation()->getId(), $altName);
                            }
                        }
                    }

                    $status = true;
                    $message = $this->get('translator')->trans('Workplace') . ' successfully updated!';

                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $em->close();
                    $message = 'An error occurred :' . $e->getMessage();
                }                
                
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($workplace_form->getErrors(true));
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
                return new \Symfony\Component\HttpFoundation\JsonResponse(array(
                        'success' => $status,
                        'msg' => $message,
                        'errors' => $errors_array,
                ));
            } else {
                return $message;
            }
        }

        $contact_type = $em->getRepository('ESERVMAINContactBundle:ContactType')->findOneBy(array('code' => 'O'));
        $contact_subtype_list = $em->getRepository('ESERVMAINContactBundle:ContactSubtypeList')->findOneBy(array('code' => 'WP'));
        $relationship_type = $em->getRepository('ESERVMAINContactBundle:RelationshipType')->findOneBy(
                array('contactTypeB' => $contact_type, 'contactSubtypeListB' => $contact_subtype_list));

        $em->close();
        return $this->render('ESERVTestBundle:Workplace:edit.html.twig', array(                    
                    'form' => $workplace_form->createView(),                    
                    'label_array' => array('relationship' => $relationship_type->getNameAB()),
                    'id' => $id,
                    'alt_languages' =>  $this->atl_languages,
                    'existing_alt_languages_equivs' =>  $this->existing_alt_languages_equivs,
                    'ac_values' => json_encode($ac_values),
                    'ac_values_arr' => $ac_values,
        ));
    }
    
    public function workplaceEmployerAutoCompAction(Request $request) {
        $param = $request->get('param');
        return $this->container->get('auto_complete_function_services')->EmployerAutoComplete($param, 'School_Employer');
    }

}
