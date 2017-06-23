<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\DataTables; //inheriting the DataTable class
use Symfony\Component\HttpFoundation\Request; //inheriting the Request class
use WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogs;
use WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogTasks;
use WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogAttentionOf;
use WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlClientStatus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Cookie;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;
use \DateTime;

class MyLogsController extends Controller {

    public $mylogs_datatable_columns;
    public $mylogs_datatable_id = 'eserv_my_table'; //this id needs to be unique
    public $mylogs_datatable_filters; //variable to hold filters array

    public function __construct() {

        $this->mylogs_datatable_columns = array(
            'job_no' => array(
                'job_no',
                'options' => array(
                    'header' => 'Job No',
                    'sortable' => false
                )
            ),
            'job_no_autoselect' => array(
                'job_no_autoselect',
                'options' => array(
                    'header' => 'Job No AutoSelect',
                    'sortable' => false,
                    'visible' => false
                )
            ),
            'customer' => array(
                'customer',
                'options' => array(
                    'header' => 'Cust',
                    'sortable' => false
                )
            ),
            'task_description' => array(
                'task_description',
                'options' => array(
                    'header' => 'Task Description',
                )
            ),
            'category' => array(
                'category',
                'options' => array(
                    'header' => 'Cat',
                )
            ),
            'title' => array(
                'title',
                'options' => array(
                    'header' => 'Title',
                )
            ),
            'attention_of' => array(
                'attention_of',
                'options' => array(
                    'header' => 'Attention Of',
                )
            ),
            'requested_by' => array(
                'requested_by',
                'options' => array(
                    'header' => 'Requested By',
                )
            ),
            'assigned_to' => array(
                'assigned_to',
                'options' => array(
                    'header' => 'ASSIGNED TO',
                )
            ),
            'requested' => array(
                'requested',
                'col_type' => 'date',
                'date_format' => 'd-M-Y',
                'options' => array(
                    'header' => 'Requested',
                )
            ),
            'priority' => array(
                'priority',
                'options' => array(
                    'header' => 'Priority',
                )
            ),
//
            'developer_status' => array(
                'developer_status',
                'options' => array(
                    'header' => 'Status',
                )
            ),
            'mtl_action' => array(
                'mtl_action',
                'options' => array(
                    'header' => 'MTL',
                )
            ),
            'updated' => array(
                'updated',
                'options' => array(
                    'header' => 'Updated',
                )
            ),
            'due_by' => array(
                'due_by',
                'col_type' => 'date',
                'date_format' => 'd-M-Y',
                'options' => array(
                    'header' => 'Due By',
                )
            ),
            'date_completed' => array(
                'date_completed',
                'col_type' => 'date',
                'date_format' => 'd-M-Y',
                'options' => array(
                    'header' => 'Date Completed',
                )
            ),
            'dev_status' => array(
                'dev_status',
                'options' => array(
                    'header' => 'Dev Status',
                )
            ),
//
            'customer_log_id' => array(
                'customer_log_id',
                'options' => array(
                    'header' => 'customer_log_id',
                    'visible' => false
                )
            ),
            'brief_description' => array(
                'brief_description',
                'options' => array(
                    'header' => 'brief_description',
                    'visible' => false
                )
            ),
            'mtl_description' => array(
                'mtl_description',
                'options' => array(
                    'header' => 'mtl_description',
                    'visible' => false
                )
            ),
            'assigned_to_id' => array(
                'assigned_to_id',
                'options' => array(
                    'header' => 'assigned_to_id',
                    'visible' => false
                )
            ),
            'department_code' => array(
                'department_code',
                'options' => array(
                    'header' => 'department_code',
                    'visible' => false
                )
            ),
//            'group_id' => array(
//                'group_id',
//                'options' => array(
//                    'header' => 'group_id',
//                    'visible' => false
//                )
//            ),
//            'assigned_to_id' => array(
//                ' assigned_to_id',
//                'options' => array(
//                    'header' => ' assigned_to_id',
//                    'visible' => false
//                )
//            ),
            'version_no' => array(
                'version_no',
                'options' => array(
                    'header' => 'version_no',
                    'visible' => false
                )
            ),
            'chargeable' => array(
                'chargeable',
                'options' => array(
                    'header' => 'chargeable',
                    'visible' => false
                )
            ),
            'mlo_quote_id' => array(
                'mlo_quote_id',
                'options' => array(
                    'header' => 'mlo_quote_id',
                    'visible' => false
                )
            ),
            'completed_by' => array(
                'completed_by',
                'options' => array(
                    'header' => 'completed_by',
                    'visible' => false
                )
            ),
            'mtl_status' => array(
                'mtl_status',
                'options' => array(
                    'header' => 'mtl_status',
                    'visible' => false
                )
            ),
            'mtl_person_id' => array(
                'mtl_person_id',
                'options' => array(
                    'header' => 'mtl_person_id',
                    'visible' => false
                )
            ),
//            'user_id' => array(
//                'user_id',
//                'options' => array(
//                    'header' => 'user_id',
//                    'visible' => false
//                )
//            ),
            'details_btn' => array(
                'type' => 'details_href',
                //'url' => '#/mylogs/edit/[[id]]/customer/[[customer]]',
                'url' => '#/mylogs/edit-portlets/[[id]]/customer/[[customer]]',
                'url_params' => array(
                    'id' => 'job_no',
                    'customer' => 'customer'
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
                    'sortable' => false
                )
            ),
        );



        $this->mylogs_datatable_filters = array(
            'type' => 'tabs', //only tab type exists at the moment
            'pre_load_data' => false,
            'tabs' => array(
                array(
                    'id' => 'mylogs_details', //this must be a unique id
                    'header' => 'My Logs', //tab header to be displayed in the page
                    'fields' => array(
                        //keys needs to match with the keys with columns array ($my_datatable_columns)
                        //for an example key 'firstName' in filters array must be same for the key in columns array
                        'job_no' => 'Job',
                        'job_no_autoselect' => array(
                            'label' => '',
                            'widget' => array(
                                'type' => 'autocomplete_array',
                                'selected_data' => array(
                                ),
                                'choices' => array(
//                                    '9037566'=>'9037566',
//                                    '9037579'=>'9037579'
//
                                )
                            )
                        ),
                        'task_description' => 'Task Description',
                        //'customer_name' => 'customer name',
                        'customer' => array(
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
                        'priority' => array(
                            'label' => 'Priority',
                            'widget' => array(
                                'type' => 'autocomplete_array',
                                'selected_data' => array(
                                ),
                                'choices' => array(
                                    'Low' => 'Low',
                                    'High' => 'High',
                                    'Medium' => 'Medium'
                                )
                            )
                        ),
                        'category' => array(
                            'label' => 'Category',
                            'widget' => array(
                                'type' => 'autocomplete_array',
                                'selected_data' => array(
                                ),
                                'choices' => array(
                                    'Question' => 'Question',
                                    'Change Control' => 'Change Control',
                                    'Issue' => 'Issue'
                                )
                            )
                        ),
                        'attention_of' => array(
                            'label' => 'Attention Of',
//                             'widget' => array(
//                                'type' => 'autocomplete_array',
//                                'selected_data' => array(
//                                ),
//                                'choices' => array(
//                                    'IN' => 'MTL',
//                                    'NOT IN' => 'MTL',
//
//                                )
//                            )
                        ),
//                        'group_id' => array(
//                            'label' => 'Customer/Mtl',
//                        ),
                        'assigned_to' => array(
                            'label' => 'Assigned To',
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
                        'assigned_to_id' => 'Assigned To Id',
                        'mtl_person_id' => 'Mtl Person Id',
//                           'status' => array(
//                            'label' => 'Job Status',
//                            'widget' => array(
//                                'type' => 'autocomplete_array',
//                                'selected_data' => array(
//                                ),
//                                'choices' => array(
////                                    1 => 'One',
////                                   2=>'two',
////                                   3=>'three'
////
//                                )
//                            )
//                        ),
//                        'date_completed' => array(
//                            'label' => 'Date Completed',
////
//                        ),
                        'customer_log_id' => 'Customer  Log id',
                        'date_completed' => array(
                            'label' => 'Job Status ',
                            'widget' => array(
                                'type' => 'autocomplete_array',
                                'selected_data' => array(
                                ),
                                'choices' => array(
                                    'IS NULL' => 'Open',
                                    'IS NOT NULL' => 'Closed',
                                    '' => 'All'
                                )
                            )
                        ),
                    )
                ),
            )
        );
    }

    /*     * ********** test mylogs*************************** */

    /*     * ********************end of test mylogs******************* */

    public function mylogsListAction(Request $request) {

        $ctkNames = $this->CustomersAction();
        $assigned_to = $this->mylogAssignedToAction();


        $customerListArray = array();
        $contactListArray = array();

        foreach ($ctkNames as $k => $v) {
            $customerListArray[$v['customer_id']] = $v['name'];
        }
        foreach ($assigned_to as $k => $v) {

            $contactListArray[$v['fullname']] = $v['fullname'];
        }
        //print_r($contactListArray);die;
        $staff = 'Y';
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $staff = 'N';
        } else {
            $staff = 'Y';
        }
        $this->mylogs_datatable_filters['tabs'][0]['fields']['customer']['widget']['choices'] = $customerListArray;
        $this->mylogs_datatable_filters['tabs'][0]['fields']['assigned_to']['widget']['choices'] = $contactListArray;
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->mylogs_datatable_id, array(
            'columns' => $this->mylogs_datatable_columns,
            'source_url' => $this->container->get('router')->generate('weblogsmainmtl_my_logs_datatable_data', array('cc' => $request->get('cc'))),
            'filtering' => $this->mylogs_datatable_filters,
            'pre_load_data' => false,
            'output_options' => array(
                'export_buttons' => array(
                    'pdf' => array(
                        'label' => '<i class="fa fa-file-pdf-o"></i> Export to PDF',
                        'title' => 'Test Title PDF',
                        'content' => 'Test Content',
                        'file_name' => 'test_file_name_pdf',
                        'extraClass' => ''
                    ),
                    'csv' => array(
                        'label' => '<i class="fa fa-file-excel-o"></i> Export to CSV',
                        'title' => 'Test Title CSV', //title of the pdf as well as the name field of queued db process
                        'file_name' => 'test_file_name_csv',
                        'extraClass' => ''
                    )
                )
            ),
//
        ));

        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        //print_r($userGroup);die;
        $person = '';
        //        if ($userGroup['userGroup'] != 'CUSTOMER') {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $result = "select * from mm_user_setting_fos where fos_user_id='" . $user->getId() . "' ";
        $person_id = $this->container->get('db_core_function_services')->runRawSql($result);
        $person = $person_id[0]['PERSON_ID'];
        $result_1 = "SELECT forename||' '||surname attention_of,ID FROM PERSON_WEB WHERE ID='" . $person . "' ";
        $fullname_arr = $this->container->get('db_core_function_services')->runRawSql($result_1);
        //   print_r($fullname); die;
        $fullname = $fullname_arr[0]['ID'];

        //print_r($fullname);
        // die;
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $assigned_to_id = $fullname;
        } else {
            $assigned_to_id = '';
        }

        if ($userGroup['userGroup'] == 'MTL') {
            $person_id = $person;
        } else {
            $person_id = '';
        }
        return $this->render('WEBLOGSMAINMTLMyLogsBundle:mylogs:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->mylogs_datatable_id,
                    'staff' => $staff,
                    'assigned_to_id' => $assigned_to_id,
                    'mtl_perosn_id' => $person_id,
                    'user' => $userGroup['userGroup']
        ));
    }

    public function mylogsList1Action($id) {

        $ctkNames = $this->CustomersAction();
        $assigned_to = $this->mylogAssignedToAction();

        $customerListArray = array();
        $contactListArray = array();
        $keywordListArray = array();

        foreach ($ctkNames as $k => $v) {
            $customerListArray[$v['customer_id']] = $v['name'];
        }
        foreach ($assigned_to as $k => $v) {

            $contactListArray[$v['fullname']] = $v['fullname'];
        }
        $staff = 'Y';
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $staff = 'N';
        } else {
            $staff = 'Y';
        }

//        //print_r($contactListArray);die;
//
        $this->mylogs_datatable_filters['tabs'][0]['fields']['customer']['widget']['choices'] = $customerListArray;
        $this->mylogs_datatable_filters['tabs'][0]['fields']['assigned_to']['widget']['choices'] = $contactListArray;
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->mylogs_datatable_id, array(
            'columns' => $this->mylogs_datatable_columns,
            'source_url' => $this->container->get('router')->generate('weblogsmainmtl_my_logs_datatable_data1'),
            'filtering' => $this->mylogs_datatable_filters,
            'pre_load_data' => false,
            'output_options' => array(
                'export_buttons' => array(
                    'pdf' => array(
                        'label' => '<i class="fa fa-file-pdf-o"></i> Export to PDF',
                        'title' => 'Test Title PDF',
                        'content' => 'Test Content',
                        'file_name' => 'test_file_name_pdf',
                        'extraClass' => ''
                    ),
                    'csv' => array(
                        'label' => '<i class="fa fa-file-excel-o"></i> Export to CSV',
                        'title' => 'Test Title CSV', //title of the pdf as well as the name field of queued db process
                        'file_name' => 'test_file_name_csv',
                        'extraClass' => ''
                    )
                )
            ),
        ));

        return $this->render('WEBLOGSMAINMTLMyLogsBundle:mylogs:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->mylogs_datatable_id,
                    'staff' => $staff
        ));
    }

    public function mylogsDataAction(Request $request) {


        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        //print_r($userGroup);die;
        $person = '';
        //        if ($userGroup['userGroup'] != 'CUSTOMER') {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $result = "select * from mm_user_setting_fos where fos_user_id='" . $user->getId() . "' ";
        $person_id = $this->container->get('db_core_function_services')->runRawSql($result);
        $person = $person_id[0]['PERSON_ID'];
        $result_1 = "SELECT forename||' '||surname attention_of,ID FROM PERSON_WEB WHERE ID='" . $person . "' ";
        $fullname_arr = $this->container->get('db_core_function_services')->runRawSql($result_1);
        //   print_r($fullname); die;
        $fullname = $fullname_arr[0]['ID'];

        //print_r($fullname);
        // die;
        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $flag = 0;
            $postData = $request->request->all();
            $assigned_to_id = $postData['sSearch_20'];
            //print_r($postData);die;
            if (empty($assigned_to_id)) {
                $flag = 1;
            }

            $data = array(
                'table' => array(
                    'type' => 'service', //type needs to be 'service', mandatory parameter
                    'details' => array(//mandatory parameter
                        'name' => 'WEBLOGS\MAIN\COMMON\CommonBundle\Services\CommonBundleServices', //location and name of the services file
                        'function_name' => 'ListMyLogs', //name of the services function
                        'function_params' => array(
                            'type' => 'doctrine',
                            'customerCode' => $userGroup['customerCode'],
                            'person_id' => $person,
                            'fullname' => $fullname,
                            'assigned_to_id' => $assigned_to_id,
                            // 'job_status' =>$search_status,
                            'flag' => $flag,
                            'userGroup' => $userGroup['userGroup']
                        ) //any parameter for the services function, except $type, $alias and $query_only which are being injected
                    )
                ),
                'index_col' => 'job_no', //the unique column of the datatable, mandatory parameter
                'columns' => $this->mylogs_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
                'table_id' => $this->mylogs_datatable_id, //unique id of the datatable, mandatory parameter
                'filtering' => $this->mylogs_datatable_filters,
                'use_col_visibility_btn' => true,
            );
        } else {
            $flag = 0;
            $postData = $request->request->all();
            //print_r($postData);die;
            $usertype_customer = $postData['sSearch_2'];
            $job_no_autocomplete = $postData['sSearch_1'];
            $assigned_to_id_data = $postData['sSearch_27'];
//            if (!empty($usertype_customer) || (!empty($job_no_autocomplete)) ||(!empty($assigned_to_id_data))) {
//                $flag = 1;
//            }
            if (empty($assigned_to_id_data)) {
                $flag = 1;
            }
            $data = array(
                'table' => array(
                    'type' => 'service', //type needs to be 'service', mandatory parameter
                    'details' => array(//mandatory parameter
                        'name' => 'WEBLOGS\MAIN\COMMON\CommonBundle\Services\CommonBundleServices', //location and name of the services file
                        'function_name' => 'ListMyLogsMTL', //name of the services function
                        'function_params' => array(
                            'type' => 'doctrine',
                            'customerCode' => $userGroup['customerCode'],
                            'person_id' => $person,
                            'fullname' => $fullname,
                            'flag' => $flag,
                            //'assigned_to_id'=>$assigned_to_id,
                            // 'job_status' =>$search_status,
                            'userGroup' => $userGroup['userGroup']
                        ) //any parameter for the services function, except $type, $alias and $query_only which are being injected
                    )
                ),
                'index_col' => 'job_no', //the unique column of the datatable, mandatory parameter
                'columns' => $this->mylogs_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
                'table_id' => $this->mylogs_datatable_id, //unique id of the datatable, mandatory parameter
                'filtering' => $this->mylogs_datatable_filters,
                'use_col_visibility_btn' => true,
            );
        }

        // print_r($data);die;
        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->mylogs_datatable_id //unique datatable id we declared earlier, mandatory parameter
        ));
        //print_r($contents);die;
        return $this->container->get('core_function_services')->ESERVGetResponse($contents); //returning a custom response (which is a Symfony response)
    }

    public function mylogsData1Action(Request $request) {

        $postData = $request->request->all();

        $usertype = $postData['sSearch_6'];

        if ($usertype == 'MTL' || $usertype == '%' || $usertype == '') {

            $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();



            $data = array(
                'table' => array(
                    'type' => 'service', //type needs to be 'service', mandatory parameter
                    'details' => array(//mandatory parameter
                        'name' => 'WEBLOGS\MAIN\COMMON\CommonBundle\Services\CommonBundleServices', //location and name of the services file
                        'function_name' => 'ListMyLogs1', //name of the services function
                        'function_params' => array(
                            'type' => 'doctrine',
                            'user_type' => $usertype,
                        //'customerCode' => $userGroup['customerCode'],
                        //'person_id' => $person,
                        // 'job_status' =>$search_status,
                        //'userGroup' => $userGroup['userGroup']
                        ) //any parameter for the services function, except $type, $alias and $query_only which are being injected
                    )
                ),
                'index_col' => 'job_no', //the unique column of the datatable, mandatory parameter
                'columns' => $this->mylogs_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
                'table_id' => $this->mylogs_datatable_id, //unique id of the datatable, mandatory parameter
                'filtering' => $this->mylogs_datatable_filters,
                'use_col_visibility_btn' => true,
            );
        } else {

            $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
            //print_r($userGroup);die;


            $data = array(
                'table' => array(
                    'type' => 'service', //type needs to be 'service', mandatory parameter
                    'details' => array(//mandatory parameter
                        'name' => 'WEBLOGS\MAIN\COMMON\CommonBundle\Services\CommonBundleServices', //location and name of the services file
                        'function_name' => 'ListMyLogs2', //name of the services function
                        'function_params' => array(
                            'type' => 'doctrine',
                        //'customerCode' => $userGroup['customerCode'],
                        //'person_id' => $person,
                        // 'job_status' =>$search_status,
                        //'userGroup' => $userGroup['userGroup']
                        ) //any parameter for the services function, except $type, $alias and $query_only which are being injected
                    )
                ),
                'index_col' => 'job_no', //the unique column of the datatable, mandatory parameter
                'columns' => $this->mylogs_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
                'table_id' => $this->mylogs_datatable_id, //unique id of the datatable, mandatory parameter
                'filtering' => $this->mylogs_datatable_filters,
                'use_col_visibility_btn' => true,
            );
        }


        // print_r($data);die;
        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->mylogs_datatable_id //unique datatable id we declared earlier, mandatory parameter
        ));
        //print_r($contents);die;
        return $this->container->get('core_function_services')->ESERVGetResponse($contents); //returning a custom response (which is a Symfony response)
    }

    /* -------------------------form  mylogs  starts------------------------------------------------------ */

    public function CustomersAction() {
        $data = array();

        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();

        if ($userGroup['userGroup'] == 'CUSTOMER') {
            $result = $this->getDoctrine()->getManager();
            $customer = $result->createQueryBuilder()
                    ->select('u.customer_id, u.name')
                    ->from('WEBLOGSMAINMTLDashboardBundle:VWwvCustomers', 'u')
                    ->where('u.customer_id = ?1')
                    ->setParameter(1, $userGroup['customerCode'])
            //->orderBy('u.person_id', 'desc')
            ;
        } else {


            $result = $this->getDoctrine()->getManager();
            $customer = $result->createQueryBuilder()
                    ->select('u.customer_id, u.name')
                    ->from('WEBLOGSMAINMTLDashboardBundle:VWwvCustomers', 'u')

            //->orderBy('u.person_id', 'desc')
            ;
        }


        if (!$customer) {
            throw $this->createNotFoundException(
                    'No output letter found-- Function "CustomersAction"'
            );
        } else {
            $data = $this->container->get('core_function_services')->GetOutputFormat($customer->getQuery(), 'array');
        }

        return $data;
    }

    public function AssisgnedToAction() {
        $data = array();


        $result = $this->getDoctrine()->getManager();
        $result = $result->createQueryBuilder()
                ->select('u.user_display_name, u.user_id')
                ->from('WEBLOGSMAINMTLMyLogsBundle:VAssignedTo', 'u')
                ->orderBy('u.user_display_name', 'ASC')
        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No output letter found-- Function "AssignedToAction"'
            );
        } else {
            $data = $this->container->get('core_function_services')->GetOutputFormat($result->getQuery(), 'array');
        }
        //print_r($data);die;
        return $data;
    }

    public function mylogAssignedToAction() {

        $data = array();

        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        //print_r($userGroup);die;
        $person = '';
//        if ($userGroup['userGroup'] != 'CUSTOMER') {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $result = "select * from mm_user_setting_fos where fos_user_id='" . $user->getId() . "' ";
        $person_id = $this->container->get('db_core_function_services')->runRawSql($result);
        $person = $person_id[0]['PERSON_ID'];


        if ($userGroup['userGroup'] == 'CUSTOMER') {

            $result = $this->getDoctrine()->getManager();
            $result = $result->createQueryBuilder()
                    ->select('u.fullname, u.person_id,u.forename')
                    ->from('WEBLOGSMAINMTLMyLogsBundle:VPersons', 'u')
                    ->where('u.person_id = ?1')
                    ->setParameter(1, $person)
            //->orderBy('u.person_id', 'desc')
            ;
        } else {

            $result = $this->getDoctrine()->getManager();
            $result = $result->createQueryBuilder()
                    ->select('u.fullname, u.person_id,u.forename')
                    ->from('WEBLOGSMAINMTLMyLogsBundle:VPersons', 'u')
            //->orderBy('u.person_id', 'desc')
            ;
        }


        if (!$result) {
            throw $this->createNotFoundException(
                    'No output letter found-- Function "mylogAassignedToAction"'
            );
        } else {
            $data = $this->container->get('core_function_services')->GetOutputFormat($result->getQuery(), 'array');
        }
        // print_r($data);die;
        return $data;
    }

    /* -------------------------create new logs -------------------------------------------- */








    /* -------------------------form  mylogs  starts------------------------------------------------------ */
    /* FORMS CODE  ----------------------ADD FORM CODE------------------------------------------------- */

    public function mylogsNewAction() {

        $mylogs_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\VMyLogsType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_new_update'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));

        //  die('hi');
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        // $user = $this->container->get('security.context')->getToken()->getUser();
        //      $user=$this->get('security.context')->getToken()->getUser();
        $user_id = $this->get('security.context')->getToken()->getUser()->getId();
        // echo $user_id;die;
        $mm_person = "SELECT * FROM mm_user_setting_fos WHERE fos_user_id='$user_id'";
        $result_mm = $this->container->get('db_core_function_services')->runRawSql($mm_person);
        //  print_r($result_mm['0']['PERSON_ID']);die;
        $per_id = $result_mm['0']['PERSON_ID'];
        $selectQ = "SELECT * FROM person_web WHERE  ID ='$per_id'  ";
        $result = $this->container->get('db_core_function_services')->runRawSql($selectQ);

        if (!empty($result['0']['SURNAME']) || !empty($result['0']['FORENAME'])) {

            $fullname = $result['0']['SURNAME'] . " " . $result['0']['FORENAME'];
        } else {
            $fullname = '';
        }
        //print_r($NAME);die;
        return $this->render("WEBLOGSMAINMTLMyLogsBundle:mylogs:add.html.twig", array(
                    'form' => $mylogs_form->createView(),
                    'refresh_table_id' => $this->mylogs_datatable_id,
                    'user_group' => $userGroup['userGroup'],
                    'requested_by' => $fullname,
        ));
    }

    public function logCategoryAction(Request $request) {

        $cust_id = $request->request->get('id');


        $select_category = " SELECT cat.category_code, cat.NAME FROM customer_categories cc, categories  cat WHERE cc.customer_id = '" . $cust_id . "'
         AND cc.category_code = cat.category_code ORDER BY cat.NAME";

//        $select_att = " SELECT cc.csev_seq_id, cc.csev_name  FROM customer_contacts cc WHERE cc.csev_customer_id IN (SELECT customer_id
//                   FROM customers
//               START WITH customer_id = '" . $cust_id . "'
//              CONNECT BY PRIOR master_customer_id = customer_id)
//                AND csev_status_code IS NULL
//                  ORDER BY cc.csev_name";
        $select_att = "SELECT p.id csev_seq_id
      ,p.forename||' '||p.surname csev_name

  FROM miller_web_demo.mm_user_setting_org a
      ,miller_web_demo.mm_user_setting_fos b
      ,miller_web_demo.person_web p
WHERE a.mm_user_setting_fos_id=b.id
   AND b.person_id = p.id
   AND customer_code='$cust_id'";
        $select_task = "SELECT ctk_customer_id,ctk_code, ctk_name   FROM customer_tasks  WHERE ctk_customer_id =  '" . $cust_id . "'
       ORDER BY ctk_name";
        $result_1 = $this->container->get('db_core_function_services')->runRawSql($select_category);
        $result_2 = $this->container->get('db_core_function_services')->runRawSql($select_att);
        $result_3 = $this->container->get('db_core_function_services')->runRawSql($select_task);

        $result_array = array_merge_recursive($result_1, $result_2, $result_3);
        //  print_r($result_array);die;
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($result_array, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function mylogsCreateAction(Request $request) {
        $status = false;

        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();


        $mylogs_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\VMyLogsType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_new_update'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));
        $user_id = $this->get('security.context')->getToken()->getUser()->getId();
        if ($request->isMethod('POST')) {
            $mylogs_form->handleRequest($request);
            if ($mylogs_form->isValid()) {
                try {

                    $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
                    $user_id = $this->get('security.context')->getToken()->getUser()->getId();
                    $mm_person = "SELECT * FROM mm_user_setting_fos WHERE fos_user_id='$user_id'";
                    $result_mm = $this->container->get('db_core_function_services')->runRawSql($mm_person);
                    $per_id = $result_mm['0']['PERSON_ID'];

                    $postData = $request->request->all();

                    //  echo $postData['weblogs_main_mtl_mylogsbundle_vmylogs']['dev_status'];die;
                    $em->getConnection()->beginTransaction();
                    $sql = "DECLARE \n"
                            . "BEGIN \n"
                            . "get_next_claim_number(:param1, :param2 , :param3,:param4,:param5,:param6,:param7); \n"
                            . "END;\n";

                    $l_log_id;
                    $default = '';
                    $qb = $em->getConnection()->prepare($sql);
                    $log = 'LOG_ID';
                    $qb->bindParam('param1', $log, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->bindParam('param2', $l_log_id, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->bindParam('param3', $default, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->bindParam('param4', $default, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->bindParam('param5', $default, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->bindParam('param6', $default, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->bindParam('param7', $default, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $res = $qb->execute();
                    $log_id = $l_log_id;

                    $priority = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:VWwvPriorityLevel')->findOneBy(array('PRIORITY_ORDER' =>
                        $postData['weblogs_main_mtl_mylogsbundle_vmylogs']['priority']));
                    $priority_data = (!empty($priority)) ? $priority->getPRIORITYID() : '';
                    // print_r($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['dueby']);die;
                    $request_date = date("d-m-Y");
                    //   echo $request_date;

                    if (!empty($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['dueby'])) {
                        $formatted_date = $this->container->get('core_function_services')->changeDateFormat($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['dueby']);
                        $logs_due_date_new_date = new \DateTime($formatted_date);
                        //$formatted_date_request = $this->container->get('core_function_services')->changeDateFormat($request_date);
                    } else {
                        $logs_due_date_new_date = '';
                    }
//
// 
//
                    //$request_date_create = new \DateTime($formatted_date_request);
                    if (!empty($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['date_completed'])) {
                        $formatted_date_logs_completed = $this->container->get('core_function_services')->changeDateFormat($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['date_completed']);
                        $logs_date_completed_date_new_date = new \DateTime($formatted_date_logs_completed);
                    } else {
                        $logs_date_completed_date_new_date = '';
                    }

                    $mtllogs = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogs();
                    $mtllogs->setLOGID($log_id);
                    $mtllogs->setCUSTOMER($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['customer']);
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['customer_log_id'] != '') {
                        $mtllogs->setCUSTOMERLOGID($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['customer_log_id']);
                    }
                    $mtllogs->setSHORTDESCRIPTION($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['short_description']);
                    $mtllogs->setDESCRIPTION($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['task_description']);

                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['requested_by'] != '') {
                        $mtllogs->setREQUESTEDBY($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['requested_by']);
                    }
                    $mtllogs->setPRIORITYLEVEL($priority_data);
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['assigned_to'] != '') {
                        $mtllogs->setMTLPERSONID($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['assigned_to']);
                    }
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['CHARGABLE'] != '') {
                        $mtllogs->setCHARGABLE($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['CHARGABLE']);
                    }
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['mlo_quote_id'] != '') {
                        $mtllogs->setMLOQUOTEID($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['mlo_quote_id']);
                    }
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['mtl'] != '') {
                        $mtllogs->setMTLACTION($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['mtl']);
                    }
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['category'] != '') {
                        $mtllogs->setCATEGORY($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['category']);
                    }
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['dev_status'] != '') {
                        $mtllogs->setMTLDEVID($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['dev_status']);
                    }
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['version_no'] != '') {
                        $mtllogs->setVERSIONNO($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['version_no']);
                    }
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['completed_by'] != '') {
                        $mtllogs->setCOMPLETEDBY($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['completed_by']);
                    }
                    if ($logs_due_date_new_date != '') {
                        $mtllogs->setLOGDUEDATE($logs_due_date_new_date);
                    }
                    if ($logs_date_completed_date_new_date != '') {
                        $mtllogs->setDATECOMPLETED($logs_date_completed_date_new_date);
                    }
                    //print_r($request_date);die;
                    $mtllogs->setDATEREQUESTED(new \DateTime());
                    $em->persist($mtllogs);
                    $em->flush();
                    //$em->getConnection()->commit();

                    $mtllogstask = new
                            \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogTasks();
                    $mtllogstask->setLOGID($log_id);
                    $mtllogstask->setTASK($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['task']);
                    $em = $this->getDoctrine()->getManager();
                    //$em->getConnection()->beginTransaction();
                    $em->persist($mtllogstask);
                    $em->flush();
                    //$em->getConnection()->commit();

                    $mtllogattentionof = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogAttentionOf();
                    $mtllogattentionof->setLOGID($log_id);
                    $mtllogattentionof->setASSIGNEDTOID($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['attention_of']);
                    $em = $this->getDoctrine()->getManager();
                    //$em->getConnection()->beginTransaction();
                    $em->persist($mtllogattentionof);
                    $em->flush();
                    //$em->getConnection()->commit();

                    $mtlclientstatus = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlClientStatus();
                    $mtlclientstatus->setLOGID($log_id);
                    if ($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['status'] != '') {
                        $mtlclientstatus->setSTATUS($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['status']);
                    }
                    $em = $this->getDoctrine()->getManager();
                    //$em->getConnection()->beginTransaction();
                    $em->persist($mtlclientstatus);
                    $em->flush();
                    //$em->getConnection()->commit();

                    /* notification code starts */
                    $cust_noti = $postData['weblogs_main_mtl_mylogsbundle_vmylogs']['customer'];
                    $selectQ = "SELECT * FROM mtl_client_notify WHERE  USER_ID !='$user_id' AND customer_id='$cust_noti'  ";
                    $result = $this->container->get('db_core_function_services')->runRawSql($selectQ);
                    foreach ($result as $rs) {
                        $log_noti_seq = 0;
                        //$em = $this->getDoctrine()->getEntityManager();
                        // $em->getConnection()->beginTransaction();
                        $sql_no = "DECLARE ln_seq NUMBER; BEGIN SELECT miller_web_demo.S_LOGSHEET_NOTIFICATIONS.NEXTVAL
                                            INTO ln_seq FROM DUAL; :P_SEQ := to_char(ln_seq); END;";
                        $data;
                        $qbd = $em->getConnection()->prepare($sql_no);
                        $qbd->bindParam(':P_SEQ', $log_noti_seq, \PDO::PARAM_INPUT_OUTPUT, 4000);
                        $qbd->execute();
                        $log_noti = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\LogsheetNotifications();
                        $log_noti->setID($log_noti_seq);
                        $log_noti->setUSERID($rs['USER_ID']);
                        $log_noti->setLOGID($log_id);
                        $log_noti->setCREATEDBY($user_id);
                        $log_noti->setCUSTOMERID($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['customer']);
                        $log_noti->setNOTIFICATION("Response ['$cust_noti']['$log_id']");
                        $log_noti->setSTATUS('Y');
                        $em = $this->getDoctrine()->getManager();
                        //$em->getConnection()->beginTransaction();
                        $em->persist($log_noti);
                        $em->flush(); //$em->getConnection()->commit();
                    }

                    $em->getConnection()->commit();
                    $message = "logs has been successfully added!";
//echo $log_id;die;
                    $status = true;
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($mylogs_form->getErrors(true));
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
            'log_id' => $log_id,
            'customer_id' => $postData['weblogs_main_mtl_mylogsbundle_vmylogs']['customer']
        );

        if ($request->isXmlHttpRequest()) {

            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {

            $url = $this->generateUrl("weblogsmainmtl_my_logs_datatable_view", array());
            return $this->redirect($url);
        }
    }

//    /* ---------------------------------END OF ADD FORM   CODE----------------------------------------------------*/

    /* ---------------------------------end of code  _-------------------------------------------- */

//
//    /***********************update mylogs *************************************************/
//     /* ----------------------START OF EDIT FORM CODE -------------------------------------------------------------------*/
    /* ----------------------START OF EDIT FORM CODE ------------------------------------------------------------------- */
    /* ----------------------START OF EDIT FORM CODE ------------------------------------------------------------------- */
    public function mylogsEditAction($id, $customer) {



        $em = $this->getDoctrine()->getManager();
        $mylogs_edit = $em->getRepository('WEBLOGSMAINCOMMONCommonBundle:VMyLogs')->findOneBy(array('job_no' => $id, 'customer' => $customer));

        //print_r($mylogs_edit);die;
        $mylogs_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\EditVMyLogsType(), $mylogs_edit, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_new_update_todo', array('id' => $id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
        ));
        $result = $this->getDoctrine()->getManager();
        //logs tasks value selected
        //ctk_name
        $logs_tasks_vali = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:CustomerTasks')->findOneBy(array('ctk_name' => $mylogs_edit->getTaskDescription(), 'ctk_customer_id' => $customer));
        $logs_tasks = (!empty($logs_tasks_vali)) ? $logs_tasks_vali : '';
        //var_dump($mylogs_edit->getCategory());die;
        $logs_category_data = $result->createQueryBuilder()
                ->select('u.CATEGORY category')
                ->from('WEBLOGSMAINMTLMyLogsBundle:MtlLogs', 'u')
                ->where('u.LOG_ID = ?1')
                ->andWhere('u.CUSTOMER = ?2')
                ->setParameter(1, $id)
                ->setParameter(2, $customer);
        $logs_category_vali = $logs_category_data->getQuery()->getArrayResult();

        $logs_category = (!empty($logs_category_vali)) ? $logs_category_vali : '';

        //var_dump($logs_category);die;
        //$logs_category = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:MtlLogs')->findOneBy(array('LOG_ID' => $id, 'CUSTOMER' => $customer));
        // print_r($logs_category);
        // die("tt");
        $assigned_to_id = (!empty($mylogs_edit->getAssignedToId())) ? $mylogs_edit->getAssignedToId() : '';

        $logs_attention_of = "select * from Mtl_Log_Attention_Of where log_id='$id' and assigned_to_id='$assigned_to_id' ";


        $result_logs_data_vali = $this->container->get('db_core_function_services')->runRawSql($logs_attention_of);

        $result_logs_data = (!empty($result_logs_data_vali)) ? $result_logs_data_vali : '';

        //$logs_attention_of = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:CustomerContacts')->findOneBy(array('csev_name' => $mylogs_edit->getAttentionOf(), 'csev_customer_id' => $customer));

        $logs_priority_data = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:VWwvPriorityLevel')->findOneBy(array('DESCRIPTION' => $mylogs_edit->getPriority()));

        //$logs_priority = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:VWwvPriorityLevel')->findOneBy(array('DESCRIPTION' => $mylogs_edit->getPriority()));
        //$priority = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:VWwvPriorityLevel')->findOneBy(array('PRIORITY_LEVEL' => $mylogs_edit->getPriority() ));
        $logs_priority = (!empty($logs_priority_data)) ? $logs_priority_data->getPRIORITYORDER() : '';
        //print_r($logs_priority);die;

        $logs_status_data = $result->createQueryBuilder()
                ->select('distinct(u.LOG_ID),u.STATUS')
                ->from('WEBLOGSMAINMTLMyLogsBundle:MtlClientStatus', 'u')
                ->where('u.LOG_ID = ?1')
                ->setParameter(1, $id);
        $logs_status_vali = $logs_status_data->getQuery()->getArrayResult();

        $logs_status = (!empty($logs_status_vali)) ? $logs_status_vali : '';
        $logs_status_vali = (!empty($logs_status[0]['STATUS'])) ? $logs_status[0]['STATUS'] : '';
        $logs_status_data_get_vali = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:LogClientStatus')->findOneBy(array('ACTION_ID' => $logs_status_vali));
        $logs_status_data_get = (!empty($logs_status_data_get_vali)) ? $logs_status_data_get_vali : '';
        $contact = (!empty($mylogs_edit->getAssignedToId())) ? $mylogs_edit->getAssignedToId() : '';



//        $attention_of_data = (!empty($result_logs_data)) ? $result_logs_data[0]['ID'] : '';

        $mtl_perosn_id = (!empty($mylogs_edit->getMtlPersonId())) ? $mylogs_edit->getMtlPersonId() : '';

        //var_dump($mtl_perosn_id);die;
        //$attention_of_data = (!empty($result_logs_data)) ? $result_logs_data[0]['ID'] : '';



        $attention_of_data = (!empty($result_logs_data)) ? $result_logs_data[0]['ASSIGNED_TO_ID'] : '';
        //  echo $attention_of_data;die;

        $logs_status_data = (!empty($logs_status_data_get)) ? $logs_status_data_get->getACTIONID() : '';
        $logs_tasks_data = (!empty($logs_tasks)) ? $logs_tasks->getCtkcode() : '';
        $mylogs_requested_by_data = (!empty($mylogs_edit)) ? $mylogs_edit->getRequestedBy() : '';
        $mylogs_chargable_data = (!empty($mylogs_edit)) ? $mylogs_edit->getChargeable() : '';
        $dev_status = (!empty($mylogs_edit)) ? $mylogs_edit->getDevStatus() : '';
        $version_no = (!empty($mylogs_edit)) ? $mylogs_edit->getVersionNo() : '';
        $mtl_status = (!empty($mylogs_edit)) ? $mylogs_edit->getMtlAction() : '';
        $completed_by = (!empty($mylogs_edit)) ? $mylogs_edit->getCompletedBy() : '';
        //var_dump($logs_category);die;
        $logs_category_data = (!empty($logs_category)) ? $logs_category[0]['category'] : '';
        $logs_priority_data_update = (!empty($logs_priority_data)) ? $logs_priority_data->getPRIORITYORDER() : '';

        //echo $dev_status;die;
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        // var_dump($logs_status_data);die;
        return $this->render("WEBLOGSMAINMTLMyLogsBundle:mylogs:edit.html.twig", array(
                    'form' => $mylogs_form->createView(),
                    'id' => $id,
                    'customer' => $customer,
                    'log_tasks' => $logs_tasks_data,
                    'requested_by' => $mylogs_requested_by_data,
                    'chargeable' => $mylogs_chargable_data,
                    'category' => $logs_category_data,
                    'attention' => $attention_of_data,
                    'priority_task' => $logs_priority_data_update,
                    'logs_status' => $logs_status_data,
                    'user_group' => $userGroup['userGroup'],
//                    'dev_status' =>$dev_status,
//                    'version_no'=>$version_no,
//                    'mtl_action'=>$mtl_status,
//                    'completed_by'=>$completed_by,
                    'mtl_person_id' => $mtl_perosn_id,
                    'dev_status' => $dev_status,
                    'version_no' => $version_no,
                    'mtl_action' => $mtl_status,
                    'completed_by' => $completed_by,
//                    'dev_status' => $dev_status,
//                    'version_no' => $version_no,
//                    'mtl_action' => $mtl_status,
//                    'completed_by' => $completed_by,
                    'contact' => $contact,
                    'refresh_table_id' => $this->mylogs_datatable_id
        ));
    }

    public function mylogsUpdateAction(Request $request) {


        $status = false;
        $em = $this->getDoctrine()->getManager();
        $customer = $this->getRequest()->request->all();
        // print_r($customer);die;
        $id = $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['job_no'];
        $customers = $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['customer'];
        $mtl_status = (!empty($customer['weblogs_main_mtl_mylogsbundle_vmylogs']['mtl_status'])) ? $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['mtl_status'] : '';
        // weblogs_main_mtl_mylogsbundle_vmylogs[dev_status]
        //  $dev_status= $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['dev_status'];
        $dev_status_data = (!empty($customer['weblogs_main_mtl_mylogsbundle_vmylogs']['dev_status'])) ? $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['dev_status'] : '';
        //die;
        //$category = $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['category'];
        $category = (!empty($customer['weblogs_main_mtl_mylogsbundle_vmylogs']['category'])) ? $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['category'] : '';
        $completed_by = (!empty($customer['weblogs_main_mtl_mylogsbundle_vmylogs']['completed_by'])) ? $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['completed_by'] : '';
        $result = $this->getDoctrine()->getManager();
        $logs_category = $result->createQueryBuilder()
                ->select('u.category,u.category_name')
                ->from('WEBLOGSMAINMTLMyLogsBundle:VWwvMtlLogs', 'u')
                ->where('u.log_id = ?1')
                ->setParameter(1, $id);
        $logs_category = $logs_category->getQuery()->getArrayResult();
        //print_r($logs_category[0]['category']);
        // die;
        //$logs_category = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:VWwvMtlLogs')->findOneBy(array('category' => $category, 'customer' => $customers));
        $logs_category = (!empty($logs_category)) ? $logs_category[0]['category'] : '';

        //$attention_of = $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['attention_of'];
        $attention_of = (!empty($customer['weblogs_main_mtl_mylogsbundle_vmylogs']['attention_of'])) ? $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['attention_of'] : '';

        $logs_attention_of = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:CustomerContacts')->findOneBy(array('csev_seq_id' => $attention_of, 'csev_customer_id' => $customers));
        //var_dump($result_logs_data);die;
        //  $logs_attention_of = (!empty($result_logs_data)) ? $result_logs_data[0]['ID'] : '';
        //$task_description = $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['task_description'];
        $task_description = (!empty($customer['weblogs_main_mtl_mylogsbundle_vmylogs']['task_description'])) ? $customer['weblogs_main_mtl_mylogsbundle_vmylogs']['task_description'] : '';
        $logs_tasks = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:CustomerTasks')->findOneBy(array('ctk_code' => $task_description, 'ctk_customer_id' => $customers));
        $logs_tasks = (!empty($logs_tasks)) ? $logs_tasks : '';

        $errors_array = array();
        $message = '';

        $mylogs_edit = $em->getRepository('WEBLOGSMAINCOMMONCommonBundle:VMyLogs')->findOneBy(array('job_no' => $id,
            'customer' => $customers
        ));
        // print_r($mylogs_edit);die;
        //$mylogs_edit = $em->getRepository('WEBLOGSMAINCOMMONCommonBundle:VMyLogs')->findOneBy(array('job_no' => $id, 'customer' => $customers, 'task_description' => $task_description));
        $mylogs_edit = array(
            'job_no' => $id,
            'customer' => $customers,
                // 'dev_status'=>$dev_status
        );
        // var_dump($logs_attention_of->getCsevName());
        //die;
        $mylogs_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\EditVMyLogsType(), $mylogs_edit, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_new_update_todo'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            ),
            'taskDescription' => array($task_description => $logs_tasks),
            //   'attentionOf' => array($attention_of => $logs_attention_of),
            'category' => array($category => $logs_category)
                //'dateCompleted'=>new \Date()
        ));

        if ($request->isMethod('POST')) {
            $mylogs_form->handleRequest($request);
            //var_dump($mylogs_form->isValid());die;
            if ($mylogs_form->isValid()) {
                try {

                    $em->getConnection()->beginTransaction();
                    //$postData = $request->request->all();
                    $mylogs_form_data_post = $mylogs_form->getData();
                    //echo $mylogs_form_data_post['dev_status'];die;

                    $em = $this->getDoctrine()->getEntityManager();
                    $sql = "DECLARE \n"
                            . "BEGIN \n"
                            . "get_next_claim_number(:param1, :param2 , :param3,:param4,:param5,:param6,:param7); \n"
                            . "END;\n";

                    //get person id //
                    $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
                    $user_id = $this->get('security.context')->getToken()->getUser()->getId();
                    $mm_person = "SELECT * FROM mm_user_setting_fos WHERE fos_user_id='$user_id'";
                    $result_mm = $this->container->get('db_core_function_services')->runRawSql($mm_person);
                    $person_id = $result_mm['0']['PERSON_ID'];
                    //end of person id code //
                    //handling null conditions//
                    //var_dump($mylogs_form_data_post['priority']->getPRIORITYORDER());die;
                    $log_id = (!empty($mylogs_form_data_post['job_no'])) ? $mylogs_form_data_post['job_no'] : '';
                    $mtl_assign_id = (!empty($mylogs_form_data_post['assigned_to'])) ? $mylogs_form_data_post['assigned_to']->getPersonId() : '';
                    $customer_id_data = (!empty($mylogs_form_data_post['customer'])) ? $mylogs_form_data_post['customer']->getCustomerId() : '';
                    $customer_logid_data = (!empty($mylogs_form_data_post['customer_log_id'])) ? $mylogs_form_data_post['customer_log_id'] : '';
                    $title_data = (!empty($mylogs_form_data_post['title'])) ? $mylogs_form_data_post['title'] : '';
                    $brief_description_data = (!empty($mylogs_form_data_post['brief_description'])) ? $mylogs_form_data_post['brief_description'] : '';
                    $requested_by_data = (!empty($mylogs_form_data_post['requested_by'])) ? $mylogs_form_data_post['requested_by'] : '';

                    $priority = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:VWwvPriorityLevel')->findOneBy(array('PRIORITY_ORDER' => $mylogs_form_data_post['priority']->getPRIORITYORDER()));
                    $priority_data = (!empty($priority)) ? $priority->getPRIORITYID() : '';
                    // $priority_data = (!empty($mylogs_form_data_post['priority'])) ? $mylogs_form_data_post['priority']->getPRIORITYORDER() : '';

                    $chargeable_data = (!empty($mylogs_form_data_post['chargeable'])) ? $mylogs_form_data_post['chargeable'] : '';
                    $mlo_quote_id_data = (!empty($mylogs_form_data_post['mlo_quote_id'])) ? $mylogs_form_data_post['mlo_quote_id'] : '';
                    $developer_status_data = (!empty($mylogs_form_data_post['developer_status'])) ? $mylogs_form_data_post['developer_status']->getACTIONID() : '';
                    $category_data = (!empty($mylogs_form_data_post['category'])) ? $mylogs_form_data_post['category'] : '';
                    $version_no = (!empty($mylogs_form_data_post['version_no'])) ? $mylogs_form_data_post['version_no'] : '';
                    $task_description_data = $mylogs_form_data_post['task_description'];
                    //echo $dev_status_data;die;
                    $result = $this->getDoctrine()->getManager();
                    $qb = $result->createQueryBuilder();
                    $logs_due_date_formatted_date = '';
                    $logs_date_completed_date = '';
                    if (array_key_exists('dueby', $mylogs_form_data_post) && $mylogs_form_data_post['dueby'] != null) {
                        if (!empty($mylogs_form_data_post['dueby'])) {
                            $logs_due_date_formatted_date = $mylogs_form_data_post['dueby']->format('Y-m-d');
                        }
                    }
                    if (array_key_exists('date_completed', $mylogs_form_data_post) && $mylogs_form_data_post['date_completed'] != null) {
                        if (!empty($mylogs_form_data_post['date_completed'])) {
                            $logs_due_date_formatted_date = $mylogs_form_data_post['date_completed']->format('Y-m-d H:i:s');
                        }
                    }
                    // $logs_due_date_formatted_date = $this->container->get('core_function_services')->changeDateFormat($mylogs_form_data_post['dueby']->format('d-M-Y'));
                    // $logs_due_date_formatted_date = (!empty($mylogs_form_data_post['dueby'])) ? $mylogs_form_data_post['dueby']->format('Y-m-d ') : '';
                    // var_dump($logs_due_date_formatted_date);die;
                    //$date_complted_formatted_date = $this->container->get('core_function_services')->changeDateFormat($mylogs_form_data_post['date_completed']->format('Y-m-d H:i:s'));
                    // $logs_date_completed_date = (!empty($mylogs_form_data_post['date_completed'])) ? $mylogs_form_data_post['date_completed']->format('Y-m-d H:i:s') : '';
                    // var_dump($mtl_status);die;
                    //var_dump($mtl_assign_id);die;
                    //  $logs_date_completed_date = (!empty($mylogs_form_data_post['date_completed'])) ? $mylogs_form_data_post['date_completed']->format('Y-m-d H:i:s') : '';
                    //$logs_date_completed_date = (!empty($mylogs_form_data_post['date_completed'])) ? $mylogs_form_data_post['date_completed']->format('Y-m-d H:i:s') : '';

                    $q = $qb->update('WEBLOGSMAINMTLMyLogsBundle:MtlLogs', 'u')

                            //->set('u.LOG_ID', '?1')
                            ->set('u.CUSTOMER', '?1')
                            ->set('u.CUSTOMER_LOG_ID', '?2')
                            ->set('u.SHORT_DESCRIPTION', '?3')
                            ->set('u.DESCRIPTION', '?4')
                            ->set('u.REQUESTED_BY', '?5')
                            ->set('u.PRIORITY_LEVEL', '?6')
                            ->set('u.CHARGABLE', '?7')
                            ->set('u.MLO_QUOTE_ID', '?8')
                            ->set('u.MTL_ACTION', '?9')
                            ->set('u.CATEGORY', '?10')
                            ->set('u.MTL_DEV_ID', '?11')
                            ->set('u.MTL_PERSON_ID', '?12')
                            ->set('u.VERSION_NO', '?13')
                            ->set('u.COMPLETED_BY', '?14')
                            // ->where('u.LOG_ID = ?12')
                            // ->andWhere('u.MTL_PERSON_ID = ?13')
                            //->set('u.MTL_PERSON_ID', '?12')
                            // ->where('u.LOG_ID = ?12')
                            // ->andWhere('u.MTL_PERSON_ID = ?13')
                            ->set('u.LOG_DUE_DATE', '?15')
                            ->set('u.DATE_COMPLETED', '?16')
                            ->where('u.LOG_ID = ?17')
                            ->setParameter(1, $customer_id_data)
                            ->setParameter(2, $customer_logid_data)
                            ->setParameter(3, $title_data)
                            ->setParameter(4, $brief_description_data)
                            ->setParameter(5, $requested_by_data)
                            ->setParameter(6, $priority_data)
                            ->setParameter(7, $chargeable_data)
                            ->setParameter(8, $mlo_quote_id_data)
                            //->setParameter(9, $developer_status_data)
                            ->setParameter(9, $mtl_status)
                            ->setParameter(10, $category_data)
                            ->setParameter(11, $dev_status_data)
                            ->setParameter(12, $mtl_assign_id)
                            ->setParameter(13, $version_no)
                            ->setParameter(14, $completed_by)
                            ->setParameter(15, $logs_due_date_formatted_date)
                            ->setParameter(16, $logs_date_completed_date)
                            ->setParameter(17, $log_id)
                            ->getQuery();
                    // echo $q->getSql();
                    //die;
                    $p = $q->execute();


                    $qb1 = $result->createQueryBuilder();
                    $q1 = $qb1->update('WEBLOGSMAINMTLMyLogsBundle:MtlLogTasks', 'u')
                            //->set('u.LOG_ID', '?1')
                            ->set('u.TASK', '?14')
                            ->where('u.LOG_ID = ?15')
                            ->setParameter(14, $task_description_data)
                            ->setParameter(15, $log_id)
                            ->getQuery();
                    //echo $q1->getSql();
                    //die;
                    $p1 = $q1->execute();

                    $qb2 = $result->createQueryBuilder();
                    $q2 = $qb2->update('WEBLOGSMAINMTLMyLogsBundle:MtlLogAttentionOf', 'u')
                            //->set('u.LOG_ID', '?1')
                            ->set('u.ASSIGNED_TO_ID', '?16')
                            ->where('u.LOG_ID = ?17')
                            ->setParameter(16, $attention_of)
                            ->setParameter(17, $log_id)
                            ->getQuery();
                    //echo $q->getSql();
                    // die;
                    $p2 = $q2->execute();

//                    //$mtllogattentionof->setLOGID($log_id);
//
//                    $em = $this->getDoctrine()->getManager();
//                    $em->persist($mtllogattentionof);
//                    $em->flush();
                    // $mtlclientstatus = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlClientStatus();
                    $qb3 = $result->createQueryBuilder();
                    $q3 = $qb3->update('WEBLOGSMAINMTLMyLogsBundle:MtlClientStatus', 'u')
                            //->set('u.LOG_ID', '?1')
                            ->set('u.STATUS', '?18')
                            ->where('u.LOG_ID = ?19')
                            ->setParameter(18, $developer_status_data)
                            ->setParameter(19, $log_id)
                            ->getQuery();
                    //echo $q->getSql();
                    // die;
                    $p3 = $q3->execute();
//                    $mtlclientstatus->setLOGID($log_id);
//                    $mtlclientstatus->setSTATUS($developer_status_data);
//                    $em = $this->getDoctrine()->getManager();
//                    $em->persist($mtlclientstatus);
//                    $em->flush();


                    $message = "logs has been successfully updated!";
                    $status = true;
                    $em->getConnection()->commit();
                } catch (\Exception $e) {

                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($mylogs_form->getErrors(true));
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );



        //$foobar = $session->get('edit_mylogs');

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {

            $url = $this->generateUrl("weblogsmainmtl_my_logs_datatable_view", array());

            return $this->redirect($url);
        }
    }

//    /* END OF UPADATE CODE */
//
//

    /*     * **************end of mylogs ******************************************************** */
//    public function getMessageAction($result) {
//        print_r($result);
//        die;
//
//
//    }
    /* logs reposne form */


    public function AddImportAction(Request $request) {
        $mylogs_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\NewImageType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_logs_new_upload_image_form_update'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
                //,
                //'attentionOf' => array($attention_of => $logs_attention_of->getCsevName()),
        ));

        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        return $this->render("WEBLOGSMAINMTLMyLogsBundle:mylogs:add_image.html.twig", array(
                    'form' => $mylogs_form->createView(),
                    //'csev_name'=>$json['csev_name'],
                    //'csev_seq_id'=>$json['csev_seq_id'],
                    //  'user_group' => $userGroup['userGroup'],
                    'refresh_table_id' => $this->mylogs_datatable_id
        ));
    }

    public function UpdateImportAction(Request $request) {  //die('dsaf');
        $result = array();
        $message = '';
        $errors_array = array();
        $status = false;

        // $em = $this->getDoctrine()->getManager();
        //  $admin_bundle_services = new \ESERV\MAIN\AdministrationBundle\Services\AdministrationBundleInterfaceService($em, $this->container);
        //  $membershipOrgChoice = $admin_bundle_services->getMembershipOrgChoice();
        $import_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\NewImageType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_logs_new_upload_image_form_update'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
                //,
                //'attentionOf' => array($attention_of => $logs_attention_of->getCsevName()),
        ));
        //  $import_form->handleRequest($request);

        if ($request->isMethod('POST')) {

            // if ($mylogs_form->isValid()) {
            $import_form->handleRequest($request);
            //var_dump($mylogs_form->isValid());die;
            //echo $import_form->isValid();die;

            $fos_user_id = $this->get('security.context')->getToken()->getUser()->getId();
            // echo $fos_user_id;die;
            $mm_person = "SELECT * FROM mm_user_setting_fos WHERE fos_user_id='$fos_user_id'";
            $result_mm = $this->container->get('db_core_function_services')->runRawSql($mm_person);
            //  print_r($result_mm['0']['PERSON_ID']);die;
            $per_id = $result_mm['0']['PERSON_ID'];
            $selectQ = "SELECT * FROM person_web WHERE  ID ='$per_id'  ";
            $result = $this->container->get('db_core_function_services')->runRawSql($selectQ);

            if (!empty($result['0']['ID'])) {

                $user_id = $result['0']['ID'];
            } else {
                $user_id = '';
            }

            if ($import_form->isValid()) {

                try {
                    $em = $this->getDoctrine()->getManager();
//
                    $log_id = $request->request->get('log_id');
                    $postData = $request->request->get('weblogs_main_mtl_mylogsbundle_mtllogs_new_image');

                    $em = $this->getDoctrine()->getEntityManager();
                    $qb = $em->getConnection()->prepare("begin  SELECT s_media_store.nextval  INTO :item_seq FROM DUAL; end;");
                    $qb->bindParam('item_seq', $item_seq, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->execute();
                    $logs_attachment = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\LogsAttachments();
                    $logs_attachment->setId($item_seq);
                    $logs_attachment->setLogId($log_id);
                    $logs_attachment->setMediaStoreId($postData['attachment']);
                    $logs_attachment->setUserId($user_id);


                    $token = '';

                    $em->persist($logs_attachment);
                    $em->flush();
                    $result = $this->getDoctrine()->getManager();
                    $qb1 = $result->createQueryBuilder();
                    $q1 = $qb1->update('WEBLOGSCOREMAINMediaBundle:MediaStore', 'u')
                            //->set('u.LOG_ID', '?1')
                            ->set('u.tempToken', '?14')
                            ->where('u.id = ?15')
                            ->setParameter(14, $token)
                            ->setParameter(15, $postData['attachment'])
                            ->getQuery();
                    // echo $q1->getSql();
                    //die;
                    $p1 = $q1->execute();

//
                    $message = "Image has been add successfully";

                    $status = true;
                } catch (\Exception $e) {
                    $message = 'An error occurred: ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($import_form->getErrors(true));
                $status = false;
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            //   $url = $this->generateUrl("weblogsmainmtl_my_logs_datatable_view", array());
            return $message;
        }
    }

    public function AddResponseAction(Request $request) {
        $mylogs_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\NewResponseType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_logs_new_response_form_update'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )
                //,
                //'attentionOf' => array($attention_of => $logs_attention_of->getCsevName()),
        ));

        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        return $this->render("WEBLOGSMAINMTLMyLogsBundle:mylogs:add_response.html.twig", array(
                    'form' => $mylogs_form->createView(),
                    //'csev_name'=>$json['csev_name'],
                    //'csev_seq_id'=>$json['csev_seq_id'],
                    'user_group' => $userGroup['userGroup'],
                    'refresh_table_id' => $this->mylogs_datatable_id
        ));
    }

    /* --------------------update response code---------------------------------------------------- */

    public function UpdateResponseAction(Request $request) {

        //$data=$this->AjaxDataGetResponseAction();
        $newresponse = $this->getRequest()->request->all();
        $status = false;
        $em = $this->getDoctrine()->getManager();
        $errors_array = array();
        $message = '';
        //print_r($newresponse);die;

        $attention_of = $newresponse['weblogs_main_mtl_mylogsbundle_newresponsetype']['attention_of'];
        $logs_attention_of = $em->getRepository('WEBLOGSMAINMTLMyLogsBundle:CustomerContacts')->findOneBy(array('csev_seq_id' => $attention_of, 'csev_customer_id' => $newresponse['weblogs_main_mtl_mylogsbundle_newresponsetype']['customer']));
        $logs_attention_of_data = (!empty($logs_attention_of) ? $logs_attention_of->getCsevName() : '');
        $newresponse_form = $this->createForm(new \WEBLOGS\MAIN\MTL\MyLogsBundle\Form\NewResponseType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_my_logs_logs_new_response_form_update'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            ),
//            'taskDescription' => array($task_description => $logs_tasks),
            'attentionOf' => array($attention_of => $logs_attention_of_data)
//            'category' => array($category => $logs_category)
                //'dateCompleted'=>new \Date()
        ));

        if ($request->isMethod('POST')) {
            $newresponse_form->handleRequest($request);
            //var_dump($mylogs_form->isValid());die;
            if ($newresponse_form->isValid()) {
                try {

                    $em->getConnection()->beginTransaction();
                    // $postData = $request->request->all();
                    $newresponse_form_data_post = $newresponse_form->getData();
                    $mtllogs = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogResponses();
                    $em = $this->getDoctrine()->getEntityManager();
                    $qb = $em->getConnection()->prepare("begin SELECT miller.S_LOG_RESPONSES.NEXTVAL INTO :item_seq FROM DUAL; end;");
                    $qb->bindParam('item_seq', $results, \PDO::PARAM_INPUT_OUTPUT, 4000);
                    $qb->execute();


                    $user_id = $this->get('security.context')->getToken()->getUser()->getId();
                    $logs_id = $newresponse_form_data_post['job_no'];
                    //var_dump($logs_id);die;
                    $response_id = $results;

                    $timestamp = strtotime(date('d-M-Y'));
                    $new_date = date('Y-m-d', $timestamp);
                    $date_created = $new_date;

                    //print_r($newresponse_form_data_post['date_completed']);die;
                    $time_stamp = (!empty($newresponse_form_data_post['date_completed'])) ? $newresponse_form_data_post['date_completed']->format('Y-m-d') : $date_created;
                    $time_stamp = $this->container->get('core_function_services')->changeDateFormat($time_stamp);

                    //$formatted_new_date = new \DateTime($time_stamp);
//                    $formatted_date_completed_date = $this->container->get('core_function_services')->changeDateFormat($postData['weblogs_main_mtl_mylogsbundle_vmylogs']['date_completed']);
//                    $logs_date_completed_date_new_date = new \DateTime($formatted_date_completed_date);
                    // $date_updated = $new_date;
                    $response_status_id = ' ';
                    if (isset($newresponse_form_data_post['mtl_status'])) {
                        $response_status_id = $newresponse_form_data_post['mtl_status']->getACTIONID();
                    }
                    $response_by_id = $user_id;
                    $assigned_to_id = $newresponse_form_data_post['attention_of'];
                    $response_text = $newresponse_form_data_post['brief_description'];
                    $developer_text = $newresponse_form_data_post['title'];
                    $cust_noti = $newresponse_form_data_post['customer'];
                    //print_r($response_status_id);
                    //print_r($user_id);
                    // die;
                    //print_r($date_created);die;
                    //setting parameters//
                    $mtllogs->setLogId($logs_id);
                    $mtllogs->setResponseId($response_id);
                    $mtllogs->setDateCreated($date_created);
                    $mtllogs->setDateUpdated($time_stamp);

                    $mtllogs->setResponseStatusId($response_status_id);

                    $mtllogs->setResponseById($response_by_id);
                    $mtllogs->setAssignedToId($assigned_to_id);
                    $mtllogs->setResponseText($response_text);
                    $mtllogs->setDeveloperText($developer_text);



                    $em = $this->getDoctrine()->getManager();
                    $em->persist($mtllogs);
                    $em->flush();

                    $result1 = $this->getDoctrine()->getManager();
                    $qb2 = $result1->createQueryBuilder();
                    $q2 = $qb2->update('WEBLOGSMAINMTLMyLogsBundle:MtlLogAttentionOf', 'u')
                            //->set('u.LOG_ID', '?1')
                            ->set('u.ASSIGNED_TO_ID', '?16')
                            ->where('u.LOG_ID = ?17')
                            ->setParameter(16, $assigned_to_id)
                            ->setParameter(17, $logs_id)
                            ->getQuery();
                    // echo $q->getSql();
                    //die;
                    $p2 = $q2->execute();
                    //    $cust_noti = $postData['weblogs_main_mtl_mylogsbundle_vmylogs']['customer'];
                    $selectQ = "SELECT * FROM mtl_client_notify WHERE  USER_ID !='$user_id' AND  customer_id='$cust_noti'  ";
                    $result = $this->container->get('db_core_function_services')->runRawSql($selectQ);


                    foreach ($result as $rs) {
                        //print_r($rs['USER_ID']);die;
                        $log_noti_seq = 0;
                        $em = $this->getDoctrine()->getEntityManager();
                        $sql_no = "DECLARE ln_seq  NUMBER; BEGIN SELECT miller_web_demo.S_LOGSHEET_NOTIFICATIONS.NEXTVAL INTO ln_seq FROM DUAL; :P_SEQ := to_char(ln_seq); END;";
                        $data;
                        $qbd = $em->getConnection()->prepare($sql_no);
                        $qbd->bindParam(':P_SEQ', $log_noti_seq, \PDO::PARAM_INPUT_OUTPUT, 4000);
                        $qbd->execute();
                        $log_noti = new \WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\LogsheetNotifications();


                        $log_noti->setID($log_noti_seq);
                        $log_noti->setUSERID($rs['USER_ID']);
                        $log_noti->setLOGID($logs_id);
                        $log_noti->setCREATEDBY($user_id);

                        // $log_noti->setCUSTOMERID($postData['weblogs_main_mtl_mylogsbundle_newresponce']['customer']);
                        $log_noti->setCUSTOMERID($cust_noti);
                        $log_noti->setNOTIFICATION("Response ['$cust_noti']['$logs_id']");
                        $log_noti->setSTATUS('Y');

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($log_noti);
                        $em->flush();
                    }
                    $message = "New Response has been successfully updated!";
                    $status = true;
//                    $cookie = new Cookie('myCookie', 1);
//                    $response = new Response();
//                    $response->headers->setCookie($cookie);
                    $em->getConnection()->commit();
                } catch (\Exception $e) {

                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($newresponse_form->getErrors(true));
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
            $url = $this->generateUrl("weblogsmainmtl_my_logs_datatable_view", array());
            return $this->redirect($url);
        }
    }

    /* ------------------------------- Api data-------------------------------------------------------- */

//    /* END OF UPADATE CODE */
    //logs tasks data
    public function LogsTasksAction(Request $request) {
        $data = $request->request->all();
        $customer = $data['customer_id'];

        $result = $this->getDoctrine()->getManager();
        $results = $result->createQueryBuilder()
                ->select('u.ctk_customer_id, u.ctk_name,u.ctk_code')
                ->from('WEBLOGSMAINMTLMyLogsBundle:CustomerTasks', 'u')
                ->where('u.ctk_customer_id=:ctk_customer_id')
                ->setParameter('ctk_customer_id', $customer)
                ->orderBy('u.ctk_name', 'DESC')
                ->getQuery()
        ;
        $data = $results->getArrayResult();
        //print_r($data);die;
        if (!$data) {
            throw $this->createNotFoundException(
                    'No logs_tasks found for customer_tasks ' . $data
            );
        }
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
            JsonEncoder()));
        $json = $serializer->serialize($data, 'json');
        print_r($json);
        die;
    }

    //log Category
    public function LogsCategoryAction(Request $request) {
        $data = $request->request->all();
        $customer = $data['customer_id'];
        // print_r($customer);die;
        $result = $this->getDoctrine()->getManager();
        $results = $result->createQueryBuilder()
                ->select('distinct(cat.CATEGORY_CODE) CATEGORY_CODE,cat.NAME NAME')
                ->from('WEBLOGSMAINMTLMyLogsBundle:CustomerCategories', 'cc')
                ->innerJoin('WEBLOGSMAINMTLMyLogsBundle:Categories', 'cat', 'WITH', 'cat.CATEGORY_CODE  = cc.category_code')
                ->where('cc.customer_id = :customer_id')
                ->setParameter('customer_id', $customer)

        ;
        //$sql=$results->getQuery();
        //echo   $sql->getSql();
        $data = $results->getQuery()->getResult();

        if (!$data) {
            throw $this->createNotFoundException(
                    'No logs_tasks found for LogsCategory ' . $data
            );
        }
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
            JsonEncoder()));
        $json = $serializer->serialize($data, 'json');
        print_r($json);
        die;
    }

    //Attention of
    public function AttentionOfAction(Request $request) {
        $data = $request->request->all();
        $customer = $data['customer_id'];
        $select_att = "SELECT p.id csev_seq_id
        ,p.forename||' '||p.surname csev_name

        FROM miller_web_demo.mm_user_setting_org a
        ,miller_web_demo.mm_user_setting_fos b
        ,miller_web_demo.person_web p
        WHERE a.mm_user_setting_fos_id=b.id
        AND b.person_id = p.id
        AND customer_code='$customer'";

        //  $result_1 = $this->container->get('db_core_function_services')->runRawSql($select_category);
        $data = $this->container->get('db_core_function_services')->runRawSql($select_att);

        if (!$data) {
            throw $this->createNotFoundException(
                    'No AttentionOfAction found for AttentionOf ' . $data
            );
        }
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
            JsonEncoder()));
        $json = $serializer->serialize($data, 'json');
        print_r($json);
        die;
    }

    /* ----------------------my logs portlets code----------------------- */

    public function MyLogsPortletAction($id, $customer) {
        return $this->render("WEBLOGSMAINMTLMyLogsBundle:MylogPortlet:render.html.twig", array(
                    'id' => $id,
                    'customer' => $customer,
                    // 'form' => $mylogs_form->createView(),
                    //'csev_name'=>$json['csev_name'],
                    //'csev_seq_id'=>$json['csev_seq_id'],
                    'refresh_table_id' => $this->mylogs_datatable_id
        ));
    }

    public function NotiInactiveAction(Request $request) {
        //return @true;
        $user_id = $this->get('security.context')->getToken()->getUser()->getId();
        $log_id = $request->request->get('id');
        $cust_id = $request->request->get('customer');
        $em = $this->getDoctrine()->getManager();
        //   $US_id='1' ;
//               $selectQuery = "SELECT full_name FROM mtl_client_notify "
//                    . "WHERE person_id = '$person_id' ";

        $sql = "UPDATE logsheet_notifications
SET status='N'" .
                "WHERE USER_ID='$user_id'" . "AND LOG_ID='$log_id'";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();


        echo $cust_id;
        die;
    }

    public function RenderPortletSearchAction(Request $request) {

        //step1.check login is mtl or customer.
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        // print_r($userGroup);die;
        if ($userGroup['userGroup'] == 'MTL') {
            $search_data = $this->getRequest()->request->all();
            $em = $this->getDoctrine()->getManager();
            $search = $em->getRepository('WEBLOGSMAINCOMMONCommonBundle:VMyLogs')->findOneBy(array('job_no' => $search_data['id']));
            if (!empty($search)) {
                echo $search->getCustomer();
            } else {
                echo "false";
            }
        } else {
            $search_data = $this->getRequest()->request->all();
            $em = $this->getDoctrine()->getManager();
            $search = $em->getRepository('WEBLOGSMAINCOMMONCommonBundle:VMyLogs')->findOneBy(array('job_no' => $search_data['id']));
            if (!empty($search)) {
                $search_customer = $search->getCustomer();
                $login_customer_id = $userGroup['customerCode'];
                //if login customer match with search log id customer then grant access otherwiserwise return false
                if ($login_customer_id == $search_customer) {
                    echo $search->getCustomer();
                } else {
                    echo "false";
                }
            } else {
                echo "false";
            }
        }



        die;
    }

    public function ErrorTemplateAction() {

        return $this->render("WEBLOGSMAINMTLMyLogsBundle:mylogs:error_template.html.twig");
    }

    /* ----------- new responses code -------------------------------- */

    public function NewResponseAction($id) {

        $new_response = "select
        rownum response,
        r.response_text response_text,
        r.developer_text developer_text,
        to_char(r.date_updated, 'DD-MON-YYYY HH24:MI') response_date_time,
        r.date_updated response_date ,
        r.response_by_id,
        p1.forename||' '||p1.surname  response_assigned_user_name
        from mtl_log_responses r,person_web p1
        where r.log_id = '$id'  and  p1.id=r.assigned_to_id ORDER BY r.date_updated DESC";
        $result1 = $this->container->get('db_core_function_services')->runRawSql($new_response);

        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        $person = '';
        $user = $this->container->get('security.context')->getToken()->getUser();
        $result = "select * from mm_user_setting_fos where fos_user_id='" . $user->getId() . "' ";
        $person_id = $this->container->get('db_core_function_services')->runRawSql($result);
        $person = $person_id[0]['PERSON_ID'];

        $new_response_person_web = "SELECT forename||' '||surname response_user_name FROM PERSON_WEB WHERE ID='" . $person . "' ";
        // $new_response_person_web = "select p2.forename||' '||p2.surname response_user_name from person_web p2 where id='125'";

        $result2 = $this->container->get('db_core_function_services')->runRawSql($new_response_person_web);

        //$result_array = array_merge_recursive($result1, $result2);
        $final_array = [];
        foreach ($result1 as $key => $value) {
            foreach ($result2 as $key1 => $value2) {

                $value = array_merge($value, $value2);
            }
            $final_array[] = $value;
        }

//        $final_array = [];
//        foreach ($result1 as $array) {
//            $final_array[] = array_merge($array, $result2[$key]);
//        }
//        print_r(array_combine(array_values($result1), array_values($result2)));
//        //print_r($result2);
//        die;
        //die;
//        $select_response = "SELECT rownum response,r.response_text response_text,r.developer_text developer_text,nvl(v.user_display_name, 'Uknown') response_user_name,
//        nvl(v2.user_display_name, 'Uknown') response_assigned_user_name,to_char(r.date_updated, 'DD-MON-YYYY HH24:MI') response_date_time,
//        r.date_updated response_date ,r.response_by_id  FROM mtl_log_responses r,v_wwv_users   v,v_wwv_users  v2 WHERE r.log_id = '" . $id . "'  AND v.user_id(+) = r.response_by_id  AND v2.user_id(+) = r.assigned_to_id
//           ORDER BY r.date_updated DESC";
//        $select_task = "SELECT ctk_customer_id,ctk_code, ctk_name   FROM customer_tasks  WHERE ctk_customer_id =  '" . $cust_id . "'
//       ORDER BY ctk_name";
        // $result = $this->container->get('db_core_function_services')->runRawSql($select_response);
//        print_r($result);
//        die;
        return $this->render("WEBLOGSMAINMTLMyLogsBundle:mylogs:new_response_template.html.twig", array(
                    'id' => $id,
                    'data' => $final_array,
//                    //'refresh_table_id' => $this->mylogs_datatable_id
        ));
    }

//     public function GetPersonIdAction() {
//
//     }
    //* service that will get results according to keyword search */
    public function KeywordSearchAction(Request $request) {

//        $sql=select job_no
//              from v_my_logs v1
//              where
//              v1.mtl_person_id  = '125'
//
//              AND (UPPER(v1.brief_description) like '%'||UPPER('test')||'%'
//              OR upper(v1.mtl_description) like '%'||UPPER('test')||'%'
//              OR upper(v1.title) like '%'||UPPER('test')||'%'
//              OR EXISTS (select 1 from mtl_log_responses inb WHERE v1.job_no = inb.log_id
//              AND ( upper(inb.response_text) LIKE '%'||UPPER('test')||'%'
//              OR upper(developer_text) LIKE '%'||UPPER('test')||'%'
//              )
//              )
//              )
//             group by job_no
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        //print_r($userGroup);die;
        $person = '';
        if ($userGroup['userGroup'] != 'CUSTOMER') {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $result = "select * from mm_user_setting_fos where fos_user_id='" . $user->getId() . "' ";
            $person_id = $this->container->get('db_core_function_services')->runRawSql($result);
            $person = $person_id[0]['PERSON_ID'];
            // print_r($person);die;
        } else {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $result = $user->getId();
            $person = $result;
        }
        $keyword_data = $request->request->get('data');
        $key_data = "'" . $keyword_data . "'";
        $keywords = 'UPPER(' . $key_data . ')';
        $data = array();

        $select_keyword = "SELECT DISTINCT ml.log_id

        FROM miller.mtl_logs ml,miller.mtl_log_responses mlr

        WHERE ml.log_id = mlr.log_id (+)

        AND (LOWER(response_text)   LIKE '%'||$keywords||'%' OR

        LOWER(description)     LIKE '%'||$keywords||'%' OR

        LOWER(mtl_description) LIKE '%'||$keywords||'%'

        )
        ";
//        $select_keyword = "select job_no
//              from v_mtl_logs v1
//              where
//              v1.mtl_person_id  = '$person'
//
//              AND (UPPER(v1.brief_description) like '%'||$keywords||'%'
//              OR upper(v1.mtl_description) like '%'||$keywords||'%'
//              OR upper(v1.title) like '%'||$keywords||'%'
//              OR EXISTS (
//                            select 1 from mtl_log_responses inb WHERE v1.job_no = inb.log_id
//                            AND
//                            (
//                                upper(inb.response_text) LIKE '%'||$keywords||'%'
//                                OR upper(developer_text) LIKE '%'||$keywords||'%'
//                            )
//                        )
//              )
//             group by job_no";
        $result = $this->container->get('db_core_function_services')->runRawSql($select_keyword);
        //$temp=$data[]['keyword_saerch'];
        foreach ($result as $key => $value) {
            //$customerListArray[$v['customer_id']] = $v['name'];
            $data['keyword_search']['data'][$key] = $value;
        }

        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response($serializer->serialize($data, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

//    // Assigned To Mtl Service //
//    public function AssignedToMtlServiceAction(Request $request) {
//        $assigned_mtl_customer = $request->request->get('customer');
//        //print_r($assigned_mtl);
//        //die;
//        $data = array();
//        $assigned_mtl = "select  ml.log_id job_no
//                        FROM     v_wwv_mtl_logs    ml
//                                ,customer_contacts cc
//                        WHERE
//                        ml.customer = '$assigned_mtl_customer'
//                        AND  ml.date_completed IS NULL
//                        and  assigned_to_id = csev_seq_id
//                        AND cc.csev_mtlgroup = 'Y'
//                       ";
//        $result = $this->container->get('db_core_function_services')->runRawSql($assigned_mtl);
//        foreach ($result as $key => $value) {
//            //$customerListArray[$v['customer_id']] = $v['name'];
//            $data['assigned_to_mtl']['data'][$key] = $value;
//        }
//
//        $encoders = array(new JsonEncoder());
//        $normalizers = array(new GetSetMethodNormalizer());
//        $serializer = new Serializer($normalizers, $encoders);
//
//        $response = new Response($serializer->serialize($data, 'json'));
//        $response->headers->set('Content-Type', 'application/json');
//
//        return $response;
//    }
//
//    // Total Open Log Service //
//    public function TotalOpenLogServiceAction(Request $request) {
//        $customer = $request->request->get('customer');
//        //print_r($assigned_mtl);
//        //die;
//        $data = array();
//        $total_open_logs = "SELECT  ml.log_id job_no
//                          FROM	v_wwv_mtl_logs       ml
//                          WHERE	ml.customer = '$customer'
//                          AND  ml.date_completed IS NULL
//                           GROUP BY ml.log_id
//
//	  		 ";
//        $result = $this->container->get('db_core_function_services')->runRawSql($total_open_logs);
//        foreach ($result as $key => $value) {
//            //$customerListArray[$v['customer_id']] = $v['name'];
//            $data['total_to_mtl']['data'][$key] = $value;
//        }
//
//        $encoders = array(new JsonEncoder());
//        $normalizers = array(new GetSetMethodNormalizer());
//        $serializer = new Serializer($normalizers, $encoders);
//
//        $response = new Response($serializer->serialize($data, 'json'));
//        $response->headers->set('Content-Type', 'application/json');
//
//        return $response;
//    }
//
//    // Assigned to Customer Service //
//    public function AssignedToCustomerServiceAction(Request $request) {
//        $customer = $request->request->get('customer');
//        $data = array();
//        $assigned_to_customer = "SELECT  ml.log_id job_no
//                            FROM    v_wwv_mtl_logs       ml
//                                   ,customer_contacts cc
//                            WHERE   ml.customer = '$customer'
//                            AND     ml.date_completed IS NULL
//                            and     assigned_to_id = csev_seq_id
//                            AND     cc.csev_mtlgroup = 'N'
//
//	  		 ";
//        $result = $this->container->get('db_core_function_services')->runRawSql($assigned_to_customer);
//        foreach ($result as $key => $value) {
//            //$customerListArray[$v['customer_id']] = $v['name'];
//            $data['assigned_to_customer']['data'][$key] = $value;
//        }
//
//        $encoders = array(new JsonEncoder());
//        $normalizers = array(new GetSetMethodNormalizer());
//        $serializer = new Serializer($normalizers, $encoders);
//
//        $response = new Response($serializer->serialize($data, 'json'));
//
}