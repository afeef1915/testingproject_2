<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;
use ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services\ContactDetailsBundleService;
use ESERV\MAIN\Services\ErrorCodeConstants;

class AddressController extends Controller {

    public $address_columns;
    public $address_table_id = 'eserv_address_table';
    public $address_hist_columns;
    public $address_hist_table_id = 'eserv_address_hist_table';

    public function __construct() {
        $this->address_columns = array(
            'addressLine1' => array(
                'addressLine1',
                'options' => array(
                    'header' => 'Address',
                )
            ),
            'postcode' => array(
                'postcode',
                'options' => array(
                    'header' => 'Postcode',
                    'width' => '15px',
                )
            ),
            'addressTypeName' => array(
                'addressTypeName',
                'options' => array(
                    'header' => 'Address Type',
                )
            ),
            'primaryRecord' => array(
                'primaryRecord',
                'options' => array(
                    'header' => 'Primary',
                    'width' => '15px',
                )
            ),
            'startDate' => array(
                'startDate',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Start Date',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'endDate' => array(
                'endDate',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'End Date',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'historyRecord' => array(
                'historyRecord',
                'options' => array(
                    'header' => 'History Record',
                    'css_class' => 'hide_for_mobile',
                    'col_name' => 'history_record'
                )
            ),
            'details_btn' => array(
                'type' => 'details_modal',
                'url' => 'contact_detail/address/edit/[[history_record]]/[[id]]',
                'url_params' => array(
                    'id' => 'id',
                    'history_record' => 'historyRecord'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'modal_attr' => array(
                    'title' => 'Edit Address',
                ),
                'options' => array(
                    'header' => 'Edit',
                    'width' => '80px',
                    'css_class' => 'center history_on',
                    'sortable' => false,
                )
            ),
        );
    }

    public function addressListAction(Request $request) {
        $contact_id = $request->get('contact_id');
        $address_columns = DataTables::formatDataTablesColumnsArray($this->address_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->address_table_id, array(
            'columns' => $address_columns,
            'row_callback' => 'eservAddressTableRowCallbackFunc(row, data);',
//            'row_callback' => 'var cell_text = $("td", row).eq(7).html(); '
//            . 'if (data[6] == "Y") {'
//            . '     var new_text = cell_text.replace("Edit", "View"); '
//            . '     $("td", row).eq(7).html(new_text); '
//            . '     $("td", row).eq(7).find( "span" ).each(function() {'
//            . '         $(this).replaceWith("View");'
//            . '      });'
//            . '}',
            'source_url' => $this->container->get('router')->generate('eservcore_contact_bundle_components_contact_details_address_ajax_list', array('contact_id' => $contact_id)),
        ));

        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Address:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->address_table_id,
                    'table_id' => 'contents_wrapper_' . $this->address_table_id,
        ));
    }

    public function dataAction(Request $request) {
        $contact_id = $request->get('contact_id');
        $history_record = $this->container->get('datatables_services')->getDataTableRequestParameter($request, 'history_record');
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services\ContactDetailsBundleService',
                    //'function_name' => 'ListAddressesByContactId',
                    'function_name' => 'ListAddressesWithHistByContactId',
                    'function_params' => array(
                        'contact_id' => $contact_id,
                        'history_record' => $history_record
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->address_columns,
            'index_col' => 'id',
            'table_id' => $this->address_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newAction(Request $request) {
        $contact_id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\AddressType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_address_create', array('id' => $contact_id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
            'enable_required_fields' => true,
        ));

        $primary_add_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                ->getPrimaryTypeIdByContact($contact_id);

        $records = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                ->findBy(array('contact' => $contact_id));
        $em->close();
        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Address:new.html.twig', array(
                    'form' => $form->createView(),
                    'primary_add_type' => $primary_add_type,
                    'has_records' => (count($records) > 0) ? 'Y' : 'N'
        ));
    }

    public function createAction(Request $request) {
        $contact_id = $request->get('id');
        $status = false;
        $message = '';
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\AddressType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_address_create', array('id' => $contact_id)),
        ));
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $postData = $request->request->get($form->getName());

                    $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($contact_id);

                    $add_type_id = $postData['addressType'];
                    $add_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                            ->find($add_type_id);

                    $primaryRecord = (isset($postData['primaryRecord']) ? 'Y' : 'N');

                    //if no primary record is present
                    if ($primaryRecord == 'N') {
                        $existPrimaryRecord = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                                ->existPrimaryRecordForContact($contact);
                        if (!$existPrimaryRecord) {
                            throw new \Exception(' Atleast one address should be primary', 500);
                        }

                        $existPrimaryRecordforAddType = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                                ->existPrimaryRecordForContactAndAddType($contact, $add_type_id);
                        if (!$existPrimaryRecordforAddType) {
                            throw new \Exception(' Primary address for the selected address Type already exists', 500);
                        }
                    }
                    //transfer the existing address of selected addresstype to history
                    $existing_address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                            ->findBy(array('contact' => $contact, 'addressType' => $add_type));
                    if ($existing_address) {
                        foreach ($existing_address as $a) {
                            $address_history = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\AddressHistory();
                            $address_history->setContact($contact);
                            $address_history->setAddressType($add_type);

                            $address_history->setAddressLine1($a->getAddressLine1());
                            $address_history->setAddressLine2($a->getAddressLine2());
                            $address_history->setAddressLine3($a->getAddressLine3());
                            $address_history->setTown($a->getTown());
                            $address_history->setCounty($a->getCounty());
                            $address_history->setPostcode($a->getPostcode());
                            $address_history->setStartDate($a->getStartDate());
                            $address_history->setPrimaryRecord($a->getPrimaryRecord());

                            $newStartDate = new \DateTime();
                            $address_history->setEndDate($newStartDate);

                            $em->persist($address_history);
                            $em->flush();

                            $old_add = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->find($a->getId());
                            $em->remove($old_add);
                            $em->flush();
                        }
                    }
                    //changing the existing primary address to not primary
                    if ($primaryRecord == 'Y') {
                        $primary_address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                                ->findBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

                        if ($primary_address) {
                            foreach ($primary_address as $a) {
                                $a->setPrimaryRecord('N');
                                $em->persist($a);
                                $em->flush();
                            }
                        }
                    }
                    //make a new address
                    $address = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address();
                    $address->setContact($contact);
                    $address->setAddressType($add_type);
                    $address->setAddressLine1($postData['addressLine1']);
                    $address->setAddressLine2($postData['addressLine2']);
                    $address->setAddressLine3($postData['addressLine3']);
                    $address->setTown($postData['town']);
                    $address->setCounty($postData['county']);
                    $address->setPostcode($postData['postcode']);
                    $newStartDate = new \DateTime();
                    $address->setStartDate($newStartDate);
                    $address->setPrimaryRecord($primaryRecord);
                    $em->persist($address);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Address Details successfully Added!';
                } catch (\Exception $e) {
                    $message = 'An error occurred: ' . $e->getMessage();
                    $em->getConnection()->rollback();
                }
            } else {
                $message = 'Form is invalid';
            }
        }
        $em->close();
        return $this->container->get('core_function_services')->showMessage($status, $message, $request, $form);
    }

    public function editAction(Request $request) {
        $id = $request->get('id');
        $history_record = $request->get('history_record');

        $em = $this->getDoctrine()->getManager();

        if ($history_record == 'Y') {
            $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressHistory')
                    ->find($id);
        } else {
            $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                    ->find($id);
        }
        if (!$address) {
            throw $this->createNotFoundException('No Address found for id ' . $id);
        }
        
        $contact_address_count = count($em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
            ->findBy(array('contact' => $address->getContact())));

        if ($address->getPrimaryRecord() == 'Y') {
            $address->setPrimaryRecord(true);
        } else {
            $address->setPrimaryRecord(false);
        }
        $form_options = array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_address_update', array('id' => $id, 'history_record' => $history_record,)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'enable_required_fields' => true,
            'data_class' => (($history_record == 'Y') ? 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\AddressHistory' : 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address' ),
        );

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\AddressType(), $address, $form_options);

        $primary_add_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                ->getPrimaryTypeIdByContact($address->getContact());
        $em->close();

        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Address:edit.html.twig', array(
                    'form' => $form->createView(),
                    'primary_add_type' => $primary_add_type,
                    'history_record' => $history_record,
                    'address_count'=>$contact_address_count,
        ));
    }

    public function updateAction(Request $request) {
        $id = $request->get('id');
        $history_record = $request->get('history_record');
        $status = false;
        $message = '';

        $cfs = $this->container->get('core_function_services');
        if ($history_record == 'Y') {
            return $cfs->showMessage($status, 'This is a history record. It cannot be edited.', $request);
        }

        $em = $this->getDoctrine()->getManager();
        $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                ->find($id);
        if (!$address) {
            return $cfs->showMessage($status, 'No Address found for id ' . $id, $request);
        }

        $contact_id = $address->getContact()->getId();

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\AddressType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_address_update', array('id' => $contact_id)),
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $postData = $request->request->get('eserv_main_contactbundle_components_contactdetailsbundle_address');

                    $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($contact_id);

                    $add_type_id = $postData['addressType'];
                    $add_type = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType')
                            ->find($add_type_id);

                    $primaryRecord = (isset($postData['primaryRecord']) ? 'Y' : 'N');

                    //update only if some changes are done 
                    $current_add = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->find($id);
                    if ($current_add->getAddressType() != $add_type_id ||
                            $current_add->getPrimaryRecord() != $primaryRecord ||
                            $current_add->getAddressLine1() != $postData['addressLine1'] ||
                            $current_add->getAddressLine2() != $postData['addressLine2'] ||
                            $current_add->getAddressLine3() != $postData['addressLine3'] ||
                            $current_add->getTown() != $postData['town'] ||
                            $current_add->getCounty() != $postData['county'] ||
                            $current_add->getPostcode() != $postData['postcode']) {
                        $em->getConnection()->beginTransaction();


                        //if no primary record is present
                        if ($primaryRecord == 'N') {
                            $existPrimaryRecord = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                                    ->existPrimaryRecordForContact($contact, $id);
                            if (!$existPrimaryRecord) {
                                throw new \Exception(' Atleast one address should be primary', 500);
                            }

                            $existPrimaryRecordforAddType = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                                    ->existPrimaryRecordForContactAndAddType($contact, $add_type_id);
                            if (!$existPrimaryRecordforAddType) {
                                throw new \Exception(' Primary address for the selected address Type already exists.', 500);
                            }
                        }
                        
                          //transfer the existing address of selected addresstype and the current address to the history
                        $qb = $em->createQueryBuilder();
                        $existing_address = $qb->select('a')
                                ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:Address', 'a')
                                ->Where('a.contact = :cont AND a.addressType = :at')
                                ->setParameter('cont', $contact)
                                ->setParameter('at', $add_type)
                                ->ORWhere('a.id = :id')
                                ->setParameter('id', $id)
                                ->getQuery()
                                ->getResult();

                        if ($existing_address) {
                            foreach ($existing_address as $a) {
                                $address_history = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\AddressHistory();
                                $address_history->setContact($contact);
                                $address_history->setAddressType($a->getAddressType());

                                $address_history->setAddressLine1($a->getAddressLine1());
                                $address_history->setAddressLine2($a->getAddressLine2());
                                $address_history->setAddressLine3($a->getAddressLine3());
                                $address_history->setTown($a->getTown());
                                $address_history->setCounty($a->getCounty());
                                $address_history->setPostcode($a->getPostcode());
                                $address_history->setStartDate($a->getStartDate());
                                $address_history->setPrimaryRecord($a->getPrimaryRecord());

                                $newStartDate = new \DateTime();
                                $address_history->setEndDate($newStartDate);

                                $em->persist($address_history);
                                $em->flush();

//                                $old_add = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->find($a['id']);
                                $em->remove($a);
                                $em->flush();
                            }
                          } 
                        //changing the existing primary address to not primary
                        if ($primaryRecord == 'Y') {
                            $qb1 = $em->createQueryBuilder();
                            $primary_address = $qb1->select('a')
                                    ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:Address', 'a')
                                    ->Where('a.contact = :cont')
                                    ->setParameter('cont', $contact)
                                    ->andWhere('a.primaryRecord = :pr')
                                    ->setParameter('pr', 'Y')
                                    ->andWhere('a.id != :id')
                                    ->setParameter('id', $id)
                                    ->getQuery()
                                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                            if ($primary_address) {
                                foreach ($primary_address as $a) {
                                    $old_primary_add = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')->find($a['id']);
                                    $old_primary_add->setPrimaryRecord('N');
                                    $em->persist($old_primary_add);
                                    $em->flush();
                                }
                            }
                        }
                        //update the address
                        $address->setContact($contact);
                        $address->setAddressType($add_type);
                        $address->setAddressLine1($postData['addressLine1']);
                        $address->setAddressLine2($postData['addressLine2']);
                        $address->setAddressLine3($postData['addressLine3']);
                        $address->setTown($postData['town']);
                        $address->setCounty($postData['county']);
                        $address->setPostcode($postData['postcode']);
                        $newStartDate = new \DateTime();
                        $address->setStartDate($newStartDate);
                        $address->setPrimaryRecord($primaryRecord);
                        $em->persist($address);
                        $em->flush();

                        $em->getConnection()->commit();
                    }
                    $status = true;
                    $message = 'Address updated successfully';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred : ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid';
            }
            $em->close();
            return $cfs->showMessage($status, $message, $request, $form);
        }
    }

    public function sendAddressToHistoryAction(Request $request) {
        $id = $request->get('id');
        $status = false;
        $message = '';
        $cfs = $this->container->get('core_function_services');
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\AddressType());
        $em = $this->getDoctrine()->getManager();
        $address = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                    ->find($id);
        if (!$address) {
            return $cfs->showMessage($status, 'No Address found for id ' . $id, $request);
        }
        
        if($address->getPrimaryRecord()=='Y'){
            $contact_address_count = count($em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Address')
                ->findBy(array('contact' => $address->getContact())));
            if($contact_address_count > 1){
                return $cfs->showMessage($status, 'Primary address cannot be deleted. ', $request, $form);        
            }
        }
        try {
            
            $em->getConnection()->beginTransaction();
            //transfer the existing address of selected addresstype and the current address to the history          

            $address_history = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\AddressHistory();
            $address_history->setContact($address->getContact());
            $address_history->setAddressType($address->getAddressType());
            $address_history->setAddressLine1($address->getAddressLine1());
            $address_history->setAddressLine2($address->getAddressLine2());
            $address_history->setAddressLine3($address->getAddressLine3());
            $address_history->setTown($address->getTown());
            $address_history->setCounty($address->getCounty());
            $address_history->setPostcode($address->getPostcode());
            $address_history->setStartDate($address->getStartDate());
            $address_history->setPrimaryRecord($address->getPrimaryRecord());
            $address_history->setEndDate(new \DateTime());
            $em->persist($address_history);
            $em->flush();             
             
            $em->remove($address);
            $em->flush();

            $em->getConnection()->commit();
            
            $status = true;
            $message = 'Address sent to history successfully';
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $message = 'An error occurred : ' . $e->getMessage();
        }
        $em->close();
        return $cfs->showMessage($status, $message, $request);
    }

}
