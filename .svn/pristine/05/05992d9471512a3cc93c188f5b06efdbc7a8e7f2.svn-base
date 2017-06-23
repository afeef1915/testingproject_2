<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\DataTables; //inheriting the DataTable class
use Symfony\Component\HttpFoundation\Request; //inheriting the Request class


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Cookie;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;

class AttachmentController extends Controller {

    public $attachment_datatable_columns;
    public $attachment_datatable_id = 'eserv_my_table'; //this id needs to be unique
    public $attachment_datatable_filters; //variable to hold filters array

    public function __construct() {

        $this->attachment_datatable_columns = array(
            'media_id' => array(
                'media_id',
                'options' => array(
                    'header' => 'media_id',
                    'sortable' => false,
                    'visible' =>false,
                )
            ),
              'media_type_id' => array(
                'media_type_id',
                'options' => array(
                    'header' => 'media_type_id',
                    'sortable' => false,
                    'visible' =>false,
                )
            ),
               'token' => array(
                'token',
                'options' => array(
                    'header' => 'token',
                    'sortable' => false,
                    'visible' =>false,
                )
            ),
               'job_no' => array(
                'job_no',
                'options' => array(
                    'header' => 'job_no',
                    'sortable' => false,
                    'visible' =>false,
                )
            ),
             
            
            'file_name' => array(
                'file_name',
                'options' => array(
                    'header' => 'Document Name',
                    'sortable' => false,
                 
                )
            ),
               'display_name' => array(
                'display_name',
                'options' => array(
                    'header' => 'User Name',
                    'sortable' => false,
                    
                )
            ),
              'created_at' => array(
                'created_at',
                   'col_type' => 'date',
                'date_format' => 'd-M-Y',
                'options' => array(
                    'header' => 'Uploaded',
                    'sortable' => false,
//                    'visible' =>false,
                 
                )
            ),
              'updated_at' => array(
                'updated_at',
                   'col_type' => 'date',
                'date_format' => 'd-M-Y',
                'options' => array(
                        'header' => 'updated_at',
                    'sortable' => false,
                     'visible' =>false,
                 
                )
            ),
              'created_by' => array(
                'created_by',
                   'col_type' => 'date',
                'date_format' => 'd-M-Y',
                'options' => array(
                    'header' => 'Created By',
                    'sortable' => false,
                    'visible' =>false,
                 
                )
            ),
             'updated_by' => array(
                'updated_by',
                  'col_type' => 'date',
                'date_format' => 'd-M-Y',
                'options' => array(
                    'header' => 'Updated By',
                    'sortable' => false,
                    'visible' =>false,
                 
                )
            ),
            
            
            
            
//            'customer' => array(
//                'customer',
//                'options' => array(
//                    'header' => 'Cust',
//                    'sortable' => false
//                )
//            ),
//            'task_description' => array(
//                'task_description',
//                'options' => array(
//                    'header' => 'Task Description',
//                )
//            ),
//            'category' => array(
//                'category',
//                'options' => array(
//                    'header' => 'Cat',
//                )
//            ),
//            'title' => array(
//                'title',
//                'options' => array(
//                    'header' => 'Title',
//                )
//            ),
//            'attention_of' => array(
//                'attention_of',
//                'options' => array(
//                    'header' => 'Attention Of',
//                )
//            ),
//            'requested_by' => array(
//                'requested_by',
//                'options' => array(
//                    'header' => 'Requested By',
//                )
//            ),
//            'assigned_to' => array(
//                'assigned_to',
//                'options' => array(
//                    'header' => 'ASSIGNED TO',
//                )
//            ),
//            'requested' => array(
//                'requested',
//                'col_type' => 'date',
//                'date_format' => 'd-M-Y',
//                'options' => array(
//                    'header' => 'Requested',
//                )
//            ),
//            'priority' => array(
//                'priority',
//                'options' => array(
//                    'header' => 'Priority',
//                )
//            ),
////
//            'developer_status' => array(
//                'developer_status',
//                'options' => array(
//                    'header' => 'Status',
//                )
//            ),
//            'mtl_action' => array(
//                'mtl_action',
//                'options' => array(
//                    'header' => 'MTL',
//                )
//            ),
//            'updated' => array(
//                'updated',
//                'options' => array(
//                    'header' => 'Updated',
//                )
//            ),
//            'due_by' => array(
//                'due_by',
//                'col_type' => 'date',
//                'date_format' => 'd-M-Y',
//                'options' => array(
//                    'header' => 'Due By',
//                )
//            ),
//            'date_completed' => array(
//                'date_completed',
//                'col_type' => 'date',
//                'date_format' => 'd-M-Y',
//                'options' => array(
//                    'header' => 'Date Completed',
//                )
//            ),
//            'dev_status' => array(
//                'dev_status',
//                'options' => array(
//                    'header' => 'Dev Status',
//                )
//            ),
////
//            'customer_log_id' => array(
//                'customer_log_id',
//                'options' => array(
//                    'header' => 'customer_log_id',
//                    'visible' => false
//                )
//            ),
//            'brief_description' => array(
//                'brief_description',
//                'options' => array(
//                    'header' => 'brief_description',
//                    'visible' => false
//                )
//            ),
//            'mtl_description' => array(
//                'mtl_description',
//                'options' => array(
//                    'header' => 'mtl_description',
//                    'visible' => false
//                )
//            ),
//            'assigned_to_id' => array(
//                'assigned_to_id',
//                'options' => array(
//                    'header' => 'assigned_to_id',
//                    'visible' => false
//                )
//            ),
//            'department_code' => array(
//                'department_code',
//                'options' => array(
//                    'header' => 'department_code',
//                    'visible' => false
//                )
//            ),
//            'group_id' => array(
//                'group_id',
//                'options' => array(
//                    'header' => 'group_id',
//                    'visible' => false
//                )
//            ),
////            'assigned_to_id' => array(
////                ' assigned_to_id',
////                'options' => array(
////                    'header' => ' assigned_to_id',
////                    'visible' => false
////                )
////            ),
//            'version_no' => array(
//                'version_no',
//                'options' => array(
//                    'header' => 'version_no',
//                    'visible' => false
//                )
//            ),
//            'chargeable' => array(
//                'chargeable',
//                'options' => array(
//                    'header' => 'chargeable',
//                    'visible' => false
//                )
//            ),
//            'mlo_quote_id' => array(
//                'mlo_quote_id',
//                'options' => array(
//                    'header' => 'mlo_quote_id',
//                    'visible' => false
//                )
//            ),
//            'completed_by' => array(
//                'completed_by',
//                'options' => array(
//                    'header' => 'completed_by',
//                    'visible' => false
//                )
//            ),
//            'mtl_status' => array(
//                'mtl_status',
//                'options' => array(
//                    'header' => 'mtl_status',
//                    'visible' => false
//                )
//            ),
//            'mtl_person_id' => array(
//                'mtl_person_id',
//                'options' => array(
//                    'header' => 'mtl_person_id',
//                    'visible' => false
//                )
//            ),
//            'user_id' => array(
//                'user_id',
//                'options' => array(
//                    'header' => 'user_id',
//                    'visible' => false
//                )
//            ),
            'details_btn' => array(
                'type' => 'download_link',
                'url' => 'weblogs/media-files/download/[[id]]',
               // 'url' => '#/attachment/edit-portlets/[[id]]/customer/[[customer]]',
                'url_params' => array(
                    'id' => 'media_id',
                    
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View (Right Click to Save As)</span>',
                'target' => '_self',
                'additional_attr' => array(
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'View/Download',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false
                )
            ),
        );



//        $this->attachment_datatable_filters = array(
//            'type' => 'tabs', //only tab type exists at the moment
//            'pre_load_data' => false,
//            'tabs' => array(
//                array(
//                    'id' => 'attachment_details', //this must be a unique id
//                    'header' => 'My Logs', //tab header to be displayed in the page
//                    'fields' => array(
//                        //keys needs to match with the keys with columns array ($my_datatable_columns)
//                        //for an example key 'firstName' in filters array must be same for the key in columns array
//                        'job_no' => 'Job',
//                        'job_no_autoselect' => array(
//                            'label' => '',
//                            'widget' => array(
//                                'type' => 'autocomplete_array',
//                                'selected_data' => array(
//                                ),
//                                'choices' => array(
////                                    '9037566'=>'9037566',
////                                    '9037579'=>'9037579'
////
//                                )
//                            )
//                        ),
//                        'task_description' => 'Task Description',
//                        //'customer_name' => 'customer name',
//                        'customer' => array(
//                            'label' => 'Customer',
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
//                        'priority' => array(
//                            'label' => 'Priority',
//                            'widget' => array(
//                                'type' => 'autocomplete_array',
//                                'selected_data' => array(
//                                ),
//                                'choices' => array(
//                                    'Low' => 'Low',
//                                    'High' => 'High',
//                                    'Medium' => 'Medium'
//                                )
//                            )
//                        ),
//                        'category' => array(
//                            'label' => 'Category',
//                            'widget' => array(
//                                'type' => 'autocomplete_array',
//                                'selected_data' => array(
//                                ),
//                                'choices' => array(
//                                    'Question' => 'Question',
//                                    'Change Control' => 'Change Control',
//                                    'Issue' => 'Issue'
//                                )
//                            )
//                        ),
////                        'attention_of' => array(
////                            'label' => 'Attention Of',
////                        ),
//                        'group_id' => array(
//                            'label' => 'Customer/Mtl',
//                        ),
//                        'assigned_to' => array(
//                            'label' => 'Assigned To',
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
////                           'status' => array(
////                            'label' => 'Job Status',
////                            'widget' => array(
////                                'type' => 'autocomplete_array',
////                                'selected_data' => array(
////                                ),
////                                'choices' => array(
//////                                    1 => 'One',
//////                                   2=>'two',
//////                                   3=>'three'
//////
////                                )
////                            )
////                        ),
////                        'date_completed' => array(
////                            'label' => 'Date Completed',
//////
////                        ),
//                        'customer_log_id' => 'Customer  Log id',
//                        'date_completed' => array(
//                            'label' => 'Job Status ',
//                            'widget' => array(
//                                'type' => 'autocomplete_array',
//                                'selected_data' => array(
//                                ),
//                                'choices' => array(
//                                    'IS NULL' => 'Open',
//                                    'IS NOT NULL' => 'Closed',
//                                    '' => 'All'
//                                )
//                            )
//                        ),
//                    )
//                ),
//            )
//        );
    }
    
    //datatable list  code
     public function AttachmentsListAction($id) {
       
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->attachment_datatable_id, array(
            'columns' => $this->attachment_datatable_columns,
            'source_url' => $this->container->get('router')->generate('weblogsmainmtl_my_attachments_data',array('logid' => $id)),
            'filtering' => $this->attachment_datatable_filters,
            'pre_load_data' => false
        ));

        return $this->render('WEBLOGSMAINMTLMyLogsBundle:Attachments:attachment.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->attachment_datatable_id
        ));
    }
    //fetch the data from service file
    public function AttachmentsDataAction(Request $request) {
    $logid= $request->get('logid');
        
        $userGroup = $this->container->get('weblogs_main_services')->getLoggedInUserDetails();
        $data = array(
            'table' => array(
                'type' => 'service', //type needs to be 'service', mandatory parameter
                'details' => array(//mandatory parameter
                    'name' => 'WEBLOGS\MAIN\COMMON\CommonBundle\Services\CommonBundleServices', //location and name of the services file
                    'function_name' => 'ListMyAttachments', //name of the services function
                    'function_params' => array(
                        'type' => 'doctrine',
                        'customerCode' => $userGroup['customerCode'],
                        'log_id' => $logid,
                        // 'job_status' =>$search_status,
                        'userGroup' => $userGroup['userGroup']
                    ) //any parameter for the services function, except $type, $alias and $query_only which are being injected
                )
            ),
            'index_col' => 'media_id', //the unique column of the datatable, mandatory parameter
            'columns' => $this->attachment_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
            'table_id' => $this->attachment_datatable_id, //unique id of the datatable, mandatory parameter
            'filtering' => $this->attachment_datatable_filters,
            'use_col_visibility_btn' => true,
        );

        // print_r($data);die;
        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->attachment_datatable_id //unique datatable id we declared earlier, mandatory parameter
        ));
        //print_r($contents);die;
        return $this->container->get('core_function_services')->ESERVGetResponse($contents); //returning a custom response (which is a Symfony response)
    }

 

}
