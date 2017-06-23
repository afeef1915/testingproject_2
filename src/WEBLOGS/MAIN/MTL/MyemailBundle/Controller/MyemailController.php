<?php

namespace WEBLOGS\MAIN\MTL\MyemailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use ESERV\MAIN\Services\DataTables; //inheriting the DataTable class
//use Symfony\Component\HttpFoundation\Request; //inheriting the Request class
use Symfony\Component\HttpFoundation\Request;
use Security\Services\SecurityConstants;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use ESERV\MAIN\Services\DataTables;

class MyemailController extends Controller {

    public $myemail_datatable_columns;
    public $myemail_datatable_id = 'myemail_my_table'; //this id needs to be unique
    public $myemail_datatable_filters; //variable to hold filters array

    public function __construct() {
        $this->myemail_datatable_columns = array(
            'user_id' => array(
                'user_id',
                'options' => array(
                    //'col_name' => 'exclude_task_code',
                    'header' => 'user_id',
                    'visible' => false
                )
            ),
            'customer_id' => array(
                'customer_id',
                'options' => array(
                    //'col_name' => 'exclude_task_code',
                    'header' => 'customer_id',
                    'visible' => false
                )
            ),
            'client' => array(
                'client',
                'options' => array(
                    'col_name' => 'client',
                    'header' => 'Client',
                )
            ),
            'task_code' => array(
                'task_code',
                'options' => array(
                    //'col_name' => 'task_code',
                    'header' => 'Task',
                )
            ),
            'exclude_task_code' => array(
                'exclude_task_code',
                'options' => array(
                    //'col_name' => 'exclude_task_code',
                    'header' => 'Exclude Task',
                )
            ),
//             'sim' => array(
//                'sim',
//                'options' => array(
//                    'col_name' => 'sim',
//                    'header' => 'sim',
//                )
//            ),
            
          
//            'details_btn' => array(
//                'type' => 'details_href',
//                'url' => '#/email/edit/[[user_id]]/customer/[[customer]]',
//                'url_params' => array(
//                    'user_id' => 'user_id',
//                    'customer' => 'customer_id'
//                ),
//                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
//                'target' => '_self',
//                'additional_attr' => array(
//                    'class' => 'table_details_btn'
//                ),
//                'options' => array(
//                    'header' => 'Edit',
//                    'width' => '80px',
//                    'css_class' => 'center',
//                    'sortable' => false,
//                )
//            ),
                   'details_btn' => array(
                'type' => 'details_modal',
                'url' => 'myemail/list-email/edit/[[user_id]]/customer/[[customer]]',
                'url_params' => array(
                    'user_id' => 'user_id',
                    'customer' => 'customer_id'
                ),
 //               'db_encode' => true,
  //              'encoded_param_name' => 'token',
//                'static_params' => array(
//                    'forms_id' => 'NOTES', 
//                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'modal_attr' => array(
                    'title' => 'Edit',
                ),
                'options' => array(
                    'header' => 'Edit',
                    'width' => '120px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
//           'details_btn1' => array(
//                'type' => 'details_modal',
//                'url' => 'myemail/list-email/delete/[[id]]',
//                'url_params' => array(
//                    'id' => 'customerId'
//                ),
//                'title_text' => '<i class="fa fa-trash"></i> <span class="desktop_inline_text">Delete</span>',
//                 'modal_attr' => array(
//                    'title' => 'Delete',
//                 //    'onclick'=>'confirmDeleteModal("112")',
//                ),
//                'options' => array(
//                    'header' => 'Delete',
//                    'width' => '80px',
//                    'css_class' => 'center',
//                    'sortable' => false,
//                )
//            ),
        );
        $this->myemail_datatable_filters = array(
            'type' => 'tabs', //only tab type exists at the moment
            'tabs' => array(
                array(
                    'id' => 'genaral_details', //this must be a unique id
                    'header' => 'My Email Notifications', //tab header to be displayed in the page
                    'fields' => array(
                        //keys needs to match with the keys with columns array ($my_datatable_columns)
                        //for an example key 'firstName' in filters array must be same for the key in columns array
                        'client' => 'Client',
                        'task_code' => 'Task Code',
                        'exclude_task_code' => 'Exclude Task Code',
                    )
                ),
//                 array(
//                    'id' => 'egenaral_details', //this must be a unique id
//                    'header' => 'indi Details', //tab header to be displayed in the page
//                    'fields' => array(
//			//keys needs to match with the keys with columns array ($my_datatable_columns)
//			//for an example key 'firstName' in filters array must be same for the key in columns array
//                        //'code' => 'Code',
//                        'task_code' => 'task_code',
//                //        'code_and_name' => 'Name / Code',
//                    )
//                ),
            )
        );
    }

    public function myemailListAction(Request $request) {
        $staff = 'Y';
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $staff = 'N';
        } else {
            $staff = 'Y';
        }

        if ($staff == 'Y') {
            $dataTable = $this->container->get('datatables_services')->DrawTable($this->myemail_datatable_id, array(
                'columns' => $this->myemail_datatable_columns,
                'source_url' => $this->container->get('router')->generate('weblogsmainmtl_myemail_data_ajax_list', array('cc' => $request->get('cc'))),
                'disable_initial_sorting' => true,
                'filtering' => $this->myemail_datatable_filters,
            ));

            return $this->render('WEBLOGSMAINMTLMyemailBundle:Myemail:list.html.twig', array(
                        'dataTable' => $dataTable,
            ));
        } else {
            return $this->render('WEBLOGSMAINMTLMyemailBundle:Myemail:error.html.twig'
            );
        }
    }

    public function myemailDataAction(Request $request) {
        $data = array(
            'table' => array(
                'type' => 'service', //type needs to be 'service', mandatory parameter
                'details' => array(//mandatory parameter
                    'name' => 'WEBLOGS\MAIN\MTL\MyemailBundle\Services\EmailBundleServices', //location and name of the services file
                    'function_name' => 'ListEmail', //name of the services function
                    'function_params' => array() //any parameter for the services function, except $type, $alias and $query_only which are being injected
                )
            ),
            'index_col' => 'user_id', //the unique column of the datatable, mandatory parameter
            'columns' => $this->myemail_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
            'table_id' => $this->myemail_datatable_id, //unique id of the datatable, mandatory parameter
            'filtering' => $this->myemail_datatable_filters,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->myemail_datatable_id //unique datatable id we declared earlier, mandatory parameter
        ));
        //print_r($contents);die;

        return $this->container->get('core_function_services')->ESERVGetResponse($contents); //returning a custom response (which is a Symfony response)
    }

    public function emailNewAction() {



        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $email_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyemailBundle\Form\AddMtlClientNotifyType(), null, array(
            //    'csrf_protection' => false,

            'action' => $this->generateUrl('weblogsmainmtl_myemail_create'),
            // 'author' =>  $this->get('security.context')->getToken()->getUser()->getId(),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));

        return $this->render("WEBLOGSMAINMTLMyemailBundle:Myemail:add.html.twig", array(
                    'form' => $email_form->createView(),
                    'refresh_table_id' => $this->myemail_datatable_id,
        ));
    }

    public function emailCreateAction(Request $request) {
        $status = false;
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $email_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyemailBundle\Form\AddMtlClientNotifyType(), null, array(
            //      'csrf_protection' => false,
            'action' => $this->generateUrl('weblogsmainmtl_myemail_create'),
            //'author' =>  $this->get('security.context')->getToken()->getUser()->getId(),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));


        if ($request->isMethod('POST')) {
            $email_form->handleRequest($request);
            //var_dump($country_form);die;
            if ($email_form->isValid()) {
                try {

                    $em->getConnection()->beginTransaction();
                    $postData = $request->request->all();

                    //$from_data = $email_form->getData();
                    $customer_id = $postData['weblogs_main_mtl_myemailbundle_mtlclientnotify']['customerId'];
                    $task_code = $postData['weblogs_main_mtl_myemailbundle_mtlclientnotify']['taskCode'];
                    $excludeTaskCode = $postData['weblogs_main_mtl_myemailbundle_mtlclientnotify']['excludeTaskCode'];
                    //check that if customer id already exists  if exists don't allow customer to insert same customer again//

                    $result = $this->getDoctrine()->getManager();
                    $query = $result->createQueryBuilder()
                            ->select('u.userId user_id,u.customerId customer_id')
                            ->from('WEBLOGSMAINMTLMyemailBundle:MtlClientNotify', 'u')
                            ->where('u.userId = :user_id')
                            ->setParameter('user_id', $userId)
                            ->andWhere('u.customerId = :customer_id')
                            ->setParameter('customer_id', $customer_id)
                            ->setMaxResults(1)
                            ->getQuery();
                    $data = $query->getArrayResult();


                    if (empty($data)) {
                        $customer = new \WEBLOGS\MAIN\MTL\MyemailBundle\Entity\MtlClientNotify();

                        //var_dump($customer_id);die;
                        $customer->setCustomerId($customer_id);
                        $customer->setUserId($userId);
                        $customer->setTaskCode($task_code);
                        $customer->setExcludeTaskCode($excludeTaskCode);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($customer);
                        $em->flush();
                        $message = "Email has been successfully added!";
                        $status = true;
                        $em->getConnection()->commit();
                    } else {


                        $message = ' This Customer already exists';
                        $errors_array = $this->container->get('core_function_services')->getEservFormErrors($email_form->getErrors(true));
                    }
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {

                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($email_form->getErrors(true));
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            $url = $this->generateUrl("weblogsmainmtl_myemail_list", array());
            return $this->redirect($url);
        }
    }

    public function taskAction(Request $request) {

        $cust_id = $request->request->get('id');

        $selectQuery = "SELECT * FROM CUSTOMER_TASKS "
                . "WHERE CTK_CUSTOMER_ID = '$cust_id' ";

        $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery);

        $nullval = Array
            (
            Array
                (
                'CTK_CUSTOMER_ID' => $cust_id,
                'CTK_CODE' => 'All',
                'CTK_NAME' => 'All'
            ),
            Array
                (
                'CTK_CUSTOMER_ID' => $cust_id,
                'CTK_CODE' => 'None',
                'CTK_NAME' => 'None'
            )
        );
//print_r($result);print_r($nullval);
        $result_array = array_merge_recursive($nullval, $result);
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($result_array, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function editEmailAction($user_id, $customer) {


        //$userId = $this->get('security.context')->getToken()->getUser()->getId();
        $userId = $user_id;
        $customerId = $customer;
        if (isset($customerId) && $customerId != '') {

            $action_url = $this->generateUrl('weblogsmainmtl_myemail_update', array('customerId' => $customerId));


            $em = $this->getDoctrine()->getManager();

            $result = $em->getRepository('WEBLOGSMAINMTLMyemailBundle:MtlClientNotify')->findOneBy(array('userId' => $userId, 'customerId' => $customerId));
            //  'taskCode' => $em->getRepository('WEBLOGSMAINMTLMyemailBundle:CustomerTasks')->findOneBy(array('ctkCustomerId' => $customerId,'ctkCode'=>$result->getTaskCode())),
//var_dump($result);die;
            //var_dump($result);die;
            $tmpData = array(
                'customerId' => $em->getRepository('WEBLOGSMAINMTLMyemailBundle:VWwvCustomers')->findOneBy(array('customerId' => $customerId)),
                'taskCode' => $result->getTaskCode(),
                'excludeTaskCode' => $result->getExcludeTaskCode()
            );


            $form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyemailBundle\Form\EditMtlClientNotifyType(), $tmpData, array(
                'csrf_protection' => false,
                'action' => $this->generateUrl('weblogsmainmtl_myemail_update', array('customerId' => $customerId)),
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable',
                )
            ));
            // die('hi');
            return $this->render("WEBLOGSMAINMTLMyemailBundle:Myemail:edit.html.twig", array(
                        'form' => $form->createView(),
                        'customerId' => $customerId,
                        'refresh_table_id' => $this->myemail_datatable_id,
                            //           'task_code' => $result->gettaskCode(),
                            //          'customer' => $result->getcustomerId(),
                            //         'refresh_table_id' => $this->$myemail_datatable_id,
            ));
        } else {
            throw new \Exception('ID cannot be blank', 500);
        }
//        $country_form = $this->createForm(new \EXAMPLE\MAIN\Country1Bundle\Form\Country\CountryType(), $data, array(
//            'action' => $this->generateUrl('weblogsmainmtl_myemail_update', array('id' => $id)),
//            'attr' => array(
//                'class' => 'eserv_form form-horizontal eserv_form_editable',
//            )
//        ));
//
//        return $this->render("EXAMPLEMAINCountry1Bundle:Country:edit.html.twig", array(
//                    'form' => $country_form->createView(),
//                    'id' => $id
//        ));
    }

    public function updateEmailAction($customerId, Request $request) {
//        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        $status = false;
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();
        $userId = $this->get('security.context')->getToken()->getUser()->getId();

        $action_url = $this->generateUrl('weblogsmainmtl_myemail_update', array('customerId' => $customerId));


        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('WEBLOGSMAINMTLMyemailBundle:MtlClientNotify')->findOneBy(array('userId' => $userId, 'customerId' => $customerId));
        //  'taskCode' => $em->getRepository('WEBLOGSMAINMTLMyemailBundle:CustomerTasks')->findOneBy(array('ctkCustomerId' => $customerId,'ctkCode'=>$result->getTaskCode())),

        $tmpData = array(
            'customerId' => $em->getRepository('WEBLOGSMAINMTLMyemailBundle:VWwvCustomers')->findOneBy(array('customerId' => $customerId)),
            'taskCode' => $result->getTaskCode(),
            'excludeTaskCode' => $result->getExcludeTaskCode()
        );


        $form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyemailBundle\Form\EditMtlClientNotifyType(), $tmpData, array(
            'csrf_protection' => false,
            'action' => $this->generateUrl('weblogsmainmtl_myemail_update', array('customerId' => $customerId)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $email_update_data = $request->request->all();

                    $task_code = $email_update_data['weblogs_main_mtl_myemailbundle_mtlclientnotify']['taskCode'];
                    $customer = $email_update_data['weblogs_main_mtl_myemailbundle_mtlclientnotify']['customerId'];
                    $excludeTaskCode = $email_update_data['weblogs_main_mtl_myemailbundle_mtlclientnotify']['excludeTaskCode'];

                    $result = $this->getDoctrine()->getManager();
                    $qb = $result->createQueryBuilder();
                    $q = $qb->update('WEBLOGSMAINMTLMyemailBundle:MtlClientNotify', 'u')
                            ->set('u.taskCode', '?1')
                            ->set('u.excludeTaskCode', '?2')
                            ->set('u.customerId', '?3')
                            ->where('u.userId = ?4')
                            ->andWhere('u.customerId = ?5')
                            ->setParameter(1, $task_code)
                            ->setParameter(2, $excludeTaskCode)
                            ->setParameter(3, $customer)
                            ->setParameter(4, $userId)
                            ->setParameter(5, $customerId)
                            ->getQuery();
                    //echo $q->getSql();
                    // die;
                    $p = $q->execute();

                    $message = "Email has been successfully updated!";
                    $status = true;
                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            $url = $this->generateUrl("weblogsmainmtl_myemail_list", array());
            return $this->redirect($url);
        }
    }

    public function deleteEmailAction($customerId, Request $request) {
        $status = false;
        $message = '';
        $em = $this->getDoctrine()->getManager();
        $userId = $this->get('security.context')->getToken()->getUser()->getId();
        try {
//            $email_notify = $em->getRepository('WEBLOGSMAINMTLMyemailBundle:MtlClientNotify')->findOneBy(array(
//                'userId' => $userId, 'customerId' => $customerId
//            ));
//           //print_r($email_notify);die;
//            $em->getConnection()->beginTransaction();
//
//            $em->remove($email_notify);
//
//            $em->flush();
            $em = $this->getDoctrine()->getManager();
            //   $US_id='1' ;
//               $selectQuery = "SELECT full_name FROM mtl_client_notify "
//                    . "WHERE person_id = '$person_id' ";
            $sql = "DELETE FROM mtl_client_notify "
                    . "WHERE user_id = '$userId' " . "AND customer_id = '$customerId'";
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            //   $stmt->flush();
            $message = "Email has been successfully deleted!";
            $status = true;
            //  $em->getConnection()->commit();
        } catch (\Exeption $e) {
            $message = 'An exception has occurred :- ' . $e->getMessage();
        }


        $result = array(
            'success' => $status,
            'msg' => $message,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            $url = $this->generateUrl("weblogsmainmtl_myemail_list", array());
            return $this->redirect($url);
        }
    }

}
