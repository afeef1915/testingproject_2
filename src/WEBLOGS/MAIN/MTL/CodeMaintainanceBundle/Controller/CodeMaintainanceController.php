<?php

namespace WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\DataTables; //inheriting the DataTable class
use Symfony\Component\HttpFoundation\Request; //inheriting the Request class
use WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\CustomerTasks;
use WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\VCustomerTasks;
use WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\VWwvCustomers;
use WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\VCodeMaintainance;
use Security\Services\SecurityConstants;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

//
//use Symfony\Component\Serializer\Serializer;
//use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
//use Symfony\Component\Serializer\Encoder\JsonEncoder;

class CodeMaintainanceController extends Controller {

    public $code_datatable_columns;
    public $code_datatable_id = 'eserv_my_table'; //this id needs to be unique
    public $code_datatable_filters; //variable to hold filters array

    public function __construct() {
        $this->code_datatable_columns = array(
            'ctk_code' => array(
                'ctk_code',
                'options' => array(
                    'header' => 'Code',
                    'sortable' => false
                )
            ),
            'task_name' => array(
                'task_name',
                'options' => array(
                    'header' => 'Name',
                    'sortable' => false
                )
            ),
            'ctk_customer_id' => array(
                'ctk_customer_id',
                'options' => array(
                    'header' => 'Customer',
                    'visible' => false
                )
            ),
            'ctk_budget_code' => array(
                'ctk_budget_code',
                'options' => array(
                    'col_name' => 'ctk_budget_code',
                    'header' => 'Budget',
                    'sortable' => false
                )
            ),
            'customer_name' => array(
                'customer_name',
                'options' => array(
                    'col_name' => 'customer_name',
                    'header' => 'Customer Name',
                    'sortable' => false
                //'width' => '120px',
                //'visible' => false
                )
            ),
//            'details_btn' => array(
//                'type' => 'details_href',
//                'url' => '#/code/edit/[[id]]/customer/[[customer]]',
//                'url_params' => array(
//                    'id' => 'ctk_code',
//                    'customer' => 'ctk_customer_id'
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
                'url' => 'code/edit/[[id]]/customer/[[customer]]',
                'url_params' => array(
                   'id' => 'ctk_code',
                    'customer' => 'ctk_customer_id'
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
        );

        $this->code_datatable_filters = array(
            'type' => 'tabs', //only tab type exists at the moment
            'pre_load_data' => false,
            'tabs' => array(
                array(
                    'id' => 'code_details', //this must be a unique id
                    'header' => ' Code Maintenance', //tab header to be displayed in the page
                    'fields' => array(
                        //keys needs to match with the keys with columns array ($my_datatable_columns)
                        //for an example key 'firstName' in filters array must be same for the key in columns array
                        'ctk_code' => 'Code',
                        'task_name' => 'Name',
                        //'customer_name' => 'customer name',
                        'ctk_customer_id' => array(
                            'label' => 'Customer',
                            'widget' => array(
                                'type' => 'autocomplete_array',
                                'selected_data' => array(
                                ),
                                'choices' => array(
//                                    1 => 'One',
//                                   2=>'two',
//                                   3=>'three'
//                                        
                                )
                            )
                        ),
                    )
                ),
            )
        );
    }

    /*     * ********** test code*************************** */

    /*     * ********************end of test code******************* */

    public function codeListAction(Request $request) {
        $staff = 'Y';
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $staff = 'N';
        } else {
            $staff = 'Y';
        }
        if ($staff == 'Y') {
            $ctkNames = $this->CustomersAction();
            $customerListArray = array();

            $i = 0;
            foreach ($ctkNames as $k => $v) {
                $customerListArray[$v['customer_id']] = $v['name'];
            }

            $this->code_datatable_filters['tabs'][0]['fields']['ctk_customer_id']['widget']['choices'] = $customerListArray;
            $dataTable = $this->container->get('datatables_services')->DrawTable($this->code_datatable_id, array(
                'columns' => $this->code_datatable_columns,
                'source_url' => $this->container->get('router')->generate('weblogsmainmtl_code_maintainance_codedata', array('cc' => $request->get('cc'))),
                'filtering' => $this->code_datatable_filters
//             
            ));

            return $this->render('WEBLOGSMAINMTLCodeMaintainanceBundle:codemaintainance:list.html.twig', array(
                        'dataTable' => $dataTable,
            ));
        } else {
            return $this->render('WEBLOGSMAINMTLCodeMaintainanceBundle:codemaintainance:error.html.twig');
        }
    }

    public function codeDataAction(Request $request) {


        $data = array(
            'table' => array(
                'type' => 'service', //type needs to be 'service', mandatory parameter
                'details' => array(//mandatory parameter
                    'name' => 'WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Services\CodeMaintainanceBundleServices', //location and name of the services file
                    'function_name' => 'ListCodes', //name of the services function
                    'function_params' => array() //any parameter for the services function, except $type, $alias and $query_only which are being injected
                )
            ),
            'index_col' => 'ctk_code', //the unique column of the datatable, mandatory parameter
            'columns' => $this->code_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
            'table_id' => $this->code_datatable_id, //unique id of the datatable, mandatory parameter
            'filtering' => $this->code_datatable_filters,
            'use_col_visibility_btn' => true,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->code_datatable_id //unique datatable id we declared earlier, mandatory parameter
        ));

        return $this->container->get('core_function_services')->ESERVGetResponse($contents); //returning a custom response (which is a Symfony response)
    }

    /* -------------------------form  code  starts------------------------------------------------------ */
    /* FORMS CODE  ----------------------ADD FORM CODE------------------------------------------------- */

    public function codeNewAction() {


        $code_form = $this->createForm(new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form\CustomerTasksType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_code_maintainance_form_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));

        return $this->render("WEBLOGSMAINMTLCodeMaintainanceBundle:codemaintainance:add.html.twig", array(
                    'form' => $code_form->createView(),
                    'refresh_table_id' => $this->code_datatable_id
        ));
    }

    public function taskAction(Request $request) {

        $cust_id = $request->request->get('id');

        $selectQuery = "SELECT * FROM MTL_LOG_BUDGETS "
                . "WHERE mlb_customer_id = '$cust_id' ";

        $result = $this->container->get('db_core_function_services')->runRawSql($selectQuery);

//   $nullval=     Array
//(
//     Array
//        (
//            'CTK_CUSTOMER_ID' => $cust_id,
//            'CTK_CODE' => 'All',
//            'CTK_NAME' => 'All'
//        ),
//       Array
//        (
//            'CTK_CUSTOMER_ID' => $cust_id,
//            'CTK_CODE' => 'None',
//            'CTK_NAME' => 'None'
//        )
//       );
//print_r($result);print_r($nullval);
        //  $result_array=array_merge_recursive($nullval,$result);
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($result, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function codeCreateAction(Request $request) {
        $status = false;
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();


        $code_form = $this->createForm(new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form\CustomerTasksType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_code_maintainance_form_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));
        //$flag=0;


        if ($request->isMethod('POST')) {
            $code_form->handleRequest($request);
            if ($code_form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    //                    $customer=new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\VWwvCustomers();
                    // var_dump($code_form->getData());die;
                    $data = $code_form->getData();
                    $ctk_code = $data->getCtkCode();
                    $ctk_customer_id = $data->getCtkCustomerId();
                    $ctk_name = $data->getCtkName();
                    $ctk_budget_code = $data->getCtkBudgetCode();
                    $em = $this->getDoctrine()->getManager();
                    $customer_update = $em->getRepository('WEBLOGSMAINMTLCodeMaintainanceBundle:VWwvCustomers')->find($ctk_customer_id);
                    $customer_id = $customer_update->getCustomerId();
                    //$ctk_customer_id = $data->$customer->getCustomerId();
                    // $t=$data->$ctk_customer_id;

                    $result = $this->getDoctrine()->getManager();
                    $query = $result->createQueryBuilder()
                            ->select('u.ctk_code ctk_code,u.ctk_customer_id  ctk_customer_id')
                            ->from('WEBLOGSMAINMTLCodeMaintainanceBundle:CustomerTasks', 'u')
                            ->where('u.ctk_code = :ctk_code')
                            // ->setParameter('ctk_code', $ctk_code)
                            //->andWhere('u.ctk_customer_id = :ctk_customer_id')
                            ->setParameter('ctk_code', $ctk_code)
                            ->andWhere('u.ctk_customer_id = :ctk_customer_id')
                            ->setParameter('ctk_customer_id', $customer_id)
                            //->setParameter('ctk_customer_id', $ctk_customer_id)
                            ->setMaxResults(1)
                            ->getQuery()

                    ;

                    $datas = $query->getArrayResult();
                    if (empty($datas)) {
                        $customer = new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\CustomerTasks();

                        //var_dump($customer_id);die;
                        $customer->setCtkCode($ctk_code);
                        $customer->setCtkName($ctk_name);
                        $customer->setCtkCustomerId($customer_id);
                        $customer->setCtkBudgetCode($ctk_budget_code);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($customer);
                        $em->flush();
                        $message = "Code has been successfully added!";
                        $status = true;
                        $em->getConnection()->commit();
                    } else {


                        $message = ' This code already exists';
                        $errors_array = $this->container->get('core_function_services')->getEservFormErrors($code_form->getErrors(true));
                    }
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($code_form->getErrors(true));
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
            $url = $this->generateUrl("weblogsmainmtl_code_maintainance_codelist", array());
            return $this->redirect($url);
        }
    }

    /* ---------------------------------END OF ADD FORM   CODE---------------------------------------------------- */

    /* -----------------------end of form code -------------------------------------------------------- */

    public function CustomersAction() {
        $data = array();
        $temp = array();

        $result = $this->getDoctrine()->getManager();
        $result = $result->createQueryBuilder()
                ->select('u.customer_id, u.name')
                ->from('WEBLOGSMAINMTLCodeMaintainanceBundle:VWwvCustomers', 'u')
                ->orderBy('u.name', 'ASC')
        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No output letter found-- Function "CustomersAction"'
            );
        } else {
            $data = $this->container->get('core_function_services')->GetOutputFormat($result->getQuery(), 'array');
        }

        return $data;
    }

    /*     * *********************update code ************************************************ */
    /* ----------------------START OF EDIT FORM CODE ------------------------------------------------------------------- */

    public function codeEditAction($id, $customer) {

        $em = $this->getDoctrine()->getManager();
        $code = $em->getRepository('WEBLOGSMAINMTLCodeMaintainanceBundle:CustomerTasks')->findOneBy(array('ctk_code' => $id, 'ctk_customer_id' => $customer));

        //var_dump($code);die;
        $tmpData = array(
            'ctk_customer_id' => $code->getCtkCustomerId(),
            'ctk_code' => $id,
            'ctk_name' => $code->getCtkName(),
            'ctk_budget_code' => $code->getCtkBudgetCode()
        );

        $code_form = $this->createForm(new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form\EditCustomerTasksType(), $tmpData, array(
            'action' => $this->generateUrl('weblogsmainmtl_code_maintainance_customer_update', array('id' => $id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));

        return $this->render("WEBLOGSMAINMTLCodeMaintainanceBundle:codemaintainance:edit.html.twig", array(
                    'form' => $code_form->createView(),
                    'id' => $id,
                    'customer' => $customer,
                    'refresh_table_id' => $this->code_datatable_id
        ));
    }

    public function codeUpdateAction($id, Request $request) {


        $status = false;
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();
        $datass = $this->getRequest()->request->all();

        //var_dump($datass['weblogs_main_mtl_codemaintainancebundle_customertasks']['ctk_customer_id']);die;
        $code = $em->getRepository('WEBLOGSMAINMTLCodeMaintainanceBundle:CustomerTasks')->findOneBy(array('ctk_code' => $id, 'ctk_customer_id' => $datass['weblogs_main_mtl_codemaintainancebundle_customertasks']['ctk_customer_id']));


        // $code = $em->getRepository('WEBLOGSMAINMTLCodeMaintainanceBundle:CustomerTasks')->findOneBy(array('ctk_code' => $id));
        // var_dump($code);die;
//         $tmpData = array(
//                'ctk_customer_id' => $code[0]->getCtkCustomerId(),
//                'ctk_code' => $id,
//                'ctk_name' => $code[0]->getCtkName()
//            ); 
        $code_form = $this->createForm(new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form\EditCustomerTasksType(), $code, array(
            'action' => $this->generateUrl('weblogsmainmtl_code_maintainance_customer_update', array('id' => $id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));

        if ($request->isMethod('POST')) {
            $code_form->handleRequest($request);
            if ($code_form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
//                     $em = $this->getDoctrine()->getManager();
                    $dt = $code_form->getData();
//               
                    //print_r($dt);die;
                    $data = $em->getRepository('WEBLOGSMAINMTLCodeMaintainanceBundle:CustomerTasks')->findOneBy(array('ctk_code' => $id, 'ctk_customer_id' => $code->getCtkCustomerId())); // ATest is my entitity class
                    //var_dump($data);die;
                    $result = $this->getDoctrine()->getManager();
                    $qb = $result->createQueryBuilder();
                    $q = $qb->update('WEBLOGSMAINMTLCodeMaintainanceBundle:CustomerTasks', 'u')
                            ->set('u.ctk_name', '?1')
                            ->set('u.ctk_budget_code', '?2')
                            ->where('u.ctk_code = ?3')
                            ->andWhere('u.ctk_customer_id = ?4')
                            //->andWhere('u.ctk_budget_code = ?4')
                            ->setParameter(1, $dt->getCtkName())
                            ->setParameter(2, $dt->getCtkBudgetCode())
                            ->setParameter(3, $id)
                            ->setParameter(4, $code->getCtkCustomerId())
                            ->getQuery();
                    // echo $q->getSql();
                    // die;
                    $p = $q->execute();



                    $message = "Code has been successfully updated!";
                    $status = true;
                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($code_form->getErrors(true));
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
            $url = $this->generateUrl("weblogsmainmtl_code_maintainance_codelist", array());
            return $this->redirect($url);
        }
    }

    /* END OF UPADATE CODE */



    /*     * **************end of code ******************************************************** */
}
