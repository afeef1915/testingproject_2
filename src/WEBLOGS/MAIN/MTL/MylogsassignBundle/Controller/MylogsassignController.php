<?php

namespace WEBLOGS\MAIN\MTL\MylogsassignBundle\Controller;

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

class MylogsassignController extends Controller {

    public $mylogsassign_datatable_columns;
    public $mylogsassign_datatable_id = 'mylogsassign_my_table'; //this id needs to be unique
    public $mylogsassign_datatable_filters; //variable to hold filters array

    public function __construct() {
        $this->mylogsassign_datatable_columns = array(
            'job_no' => array(
                'job_no',
                'options' => array(
                    'col_name' => 'job_no',
                    'header' => 'Job No',
                )
            ),
            'customer' => array(
                'customer',
                'options' => array(
                    'col_name' => 'customer',
                    'header' => 'Customer',
                )
            ),
            'category' => array(
                'category',
                'options' => array(
                    'col_name' => 'category',
                    'header' => 'Category',
                )
            ),
            'title' => array(
                'title',
                'options' => array(
                    'col_name' => 'title',
                    'header' => 'Title',
                )
            ),
            'requested_by' => array(
                'requested_by',
                'options' => array(
                    'col_name' => 'requested_by',
                    'header' => 'Requested By',
                //      'visible'=>false
                )
            ),
            'requested' => array(
                'requested',
                'options' => array(
                    'col_name' => 'requested',
                    'header' => 'Requested',
                )
            ),
            'log_due_date' => array(
                'log_due_date',
                'options' => array(
                    'col_name' => 'log_due_date',
                    'header' => 'Due By',
                )
            ),
            'priority_desc' => array(
                'priority_desc',
                'options' => array(
                    'col_name' => 'priority_desc',
                    'header' => 'Priority',
                )
            ),
            'dev_status' => array(
                'dev_status',
                'options' => array(
                    'col_name' => 'dev_status',
                    'header' => 'Dev Status',
                )
            ),
            'mtl_status' => array(
                'mtl_status',
                'options' => array(
                    'col_name' => 'mtl_status',
                    'header' => 'MTL',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => 'javascript:void(0)',
                'url_params' => array(
                    'id' => 'job_no'
                ),
                'title_text' => '<i class="fa fa-envelopet"></i> <span class="desktop_inline_text">Get Update</span>',
                'target' => '_self',
                'additional_attr' => array(
                    'class' => 'table_details_btn',
                    'onClick' => 'openSolution(this);'
                ),
                'options' => array(
                    'header' => 'Reminder',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
//            'details_btn' => array(
//                'type' => 'details_href',
//                'url' => '#/mylogsassign/mymail/[[id]]',
//                'url_params' => array(
//                    'id' => 'job_no'
//                ),
//                'title_text' => '<i class="fa fa-envelopet"></i> <span class="desktop_inline_text">Get Update</span>',
//                'target' => '_self',
//                'additional_attr' => array(
//                    'class' => 'table_details_btn'
//                ),
//                'options' => array(
//                    'header' => 'Reminder',
//                    'width' => '80px',
//                    'css_class' => 'center',
//                    'sortable' => false,
//                )
//            ),
//           'details_btn1' => array(
//                'type' => 'details_modal',
//                'url' => 'myemail/list-email/delete/[[id]]',
//                'url_params' => array(
//                    'id' => 'job_no'
//                ),
//                'title_text' => '<i class="fa fa-trash"></i> <span class="desktop_inline_text">Get Update</span>',
//                 'modal_attr' => array(
//                    'title' => 'Delete',  
//                 //    'onclick'=>'confirmDeleteModal("112")',
//                ),
//                'options' => array(
//                    'header' => 'Get Update',
//                    'width' => '80px',
//                    'css_class' => 'center',
//                    'sortable' => false,
//                )
//            ),
        );
        $this->mylogsassign_datatable_filters = array(
            'type' => 'tabs', //only tab type exists at the moment
            'tabs' => array(
                array(
                    'id' => 'genaral_details', //this must be a unique id
                    'header' => 'My Logs Assigned', //tab header to be displayed in the page
                    'fields' => array(
                        //keys needs to match with the keys with columns array ($my_datatable_columns)
                        //for an example key 'firstName' in filters array must be same for the key in columns array
                        'job_no' => 'job no',
                    //    'task_code' => 'Task Code',
                    //     'exclude_task_code' => 'Exclude Task Code',
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
            ),
        );
    }

    public function mylogsListAction(Request $request) {
        $staff = 'Y';
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $staff = 'N';
        } else {
            $staff = 'Y';
        }

        if ($staff == 'Y') {
            $dataTable = $this->container->get('datatables_services')->DrawTable($this->mylogsassign_datatable_id, array(
                'columns' => $this->mylogsassign_datatable_columns,
                'source_url' => $this->container->get('router')->generate('weblogsmainmtl_mylogsassign_data_ajax_list', array('cc' => $request->get('cc'))),
                'disable_initial_sorting' => true,
                'filtering' => $this->mylogsassign_datatable_filters,
            ));

            return $this->render('WEBLOGSMAINMTLMylogsassignBundle:Mylogsassign:list.html.twig', array(
                        'dataTable' => $dataTable,
            ));
        } else {
            return $this->render('WEBLOGSMAINMTLMylogsassignBundle:Mylogsassign:error.html.twig');
        }
    }

    public function mylogsDataAction(Request $request) {
        
        
          $user = $this->container->get('security.context')->getToken()->getUser();
        $result = "select * from mm_user_setting_fos where fos_user_id='" . $user->getId() . "' ";
        $person_id = $this->container->get('db_core_function_services')->runRawSql($result);
        $person = $person_id[0]['PERSON_ID'];
        //$mm_person = "SELECT * FROM mm_user_setting_fos WHERE fos_user_id='$user_id'";
       // $result_mm = $this->container->get('db_core_function_services')->runRawSql($mm_person);
        //  print_r($result_mm['0']['PERSON_ID']);die;
     //   $per_id = $result_mm['0']['PERSON_ID'];
 // echo $per_id;die;
        $data = array(
            'table' => array(
                'type' => 'service', //type needs to be 'service', mandatory parameter
                'details' => array(//mandatory parameter
                    'name' => 'WEBLOGS\MAIN\MTL\MylogsassignBundle\Services\MylogsassignBundleServices', //location and name of the services file
                    'function_name' => 'ListMylogsassign', //name of the services function
                    'function_params' => array(
                        'type' => 'doctrine',
                      //  'customerCode' => $userGroup['customerCode'],
                        'person_id' => $person,
                        
                    ) //any parameter for the services function, except $type, $alias and $query_only which are being injected
                )
            ),
            'index_col' => 'job_no', //the unique column of the datatable, mandatory parameter
            'columns' => $this->mylogsassign_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
            'table_id' => $this->mylogsassign_datatable_id, //unique id of the datatable, mandatory parameter
            'filtering' => $this->mylogsassign_datatable_filters,
        );
        //   die('in');
//print_r($data);die;
        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->mylogsassign_datatable_id //unique datatable id we declared earlier, mandatory parameter
        ));


        return $this->container->get('core_function_services')->ESERVGetResponse($contents); //returning a custom response (which is a Symfony response)
    }

    public function logsMailAction(Request $request) {

        $cust_id = $request->request->get('id');


        $em = $this->getDoctrine()->getManager();

        try {

//                    $sql = "DECLARE \n"
//                            . "BEGIN \n"
//                            . "WWV_LOGSHEET_EMAIL.SEND_GET_STATUS_EMAIL(:param1); \n"
//                            . "END;\n";
//
//                    $l_log_id=$id;
//                  
//                    $qb = $em->getConnection()->prepare($sql);
//                    
//                    $qb->bindParam('param1', $l_log_id, \PDO::PARAM_INPUT_OUTPUT, 4000);
//
//                    $res = $qb->execute();
//                    
            $res = true;


            $message = "Email has been successfully send!";
            $status = true;
        } catch (\Exeption $e) {
            $message = 'An exception has occurred :- ' . $e->getMessage();
        }


        $result = array(
            'success' => $status,
            'msg' => $message,
        );
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        }
//        print_r('<div  class="alert alert-success">
//            <a  class="close" data-dismiss="alert" aria-label="close">×</a>
//            <strong>'.$result['msg'].'</strong>
//            </div>');
//            die; 
        //  return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }

}
