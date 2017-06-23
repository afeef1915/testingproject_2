<?php

namespace WEBLOGS\MAIN\MTL\ShowUsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\DataTables; //inheriting the DataTable class
use Symfony\Component\HttpFoundation\Request; //inheriting the Request class

use WEBLOGS\MAIN\MTL\ShowUsersController\Entity\VShowusers;
//use WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\VWwvMtlLogs;



class ShowUsersController extends Controller
{
    public $showusers_datatable_columns;
    public $showusers_datatable_id = 'eserv_my_table'; //this id needs to be unique
    public $showusers_datatable_filters; //variable to hold filters array
    
    public function __construct()
    {
        $this->showusers_datatable_columns = array(
            
         
            'csev_seq_id' => array(
                'csev_seq_id',
                'options' => array(
                    'header' => 'Id',
                    'sortable' => false
                )
            ),
            'csev_name' => array(
                'csev_name',
                'options' => array(
                    'header' => 'Name',
                    'sortable' => false
                )
            ),
            'csev_title' => array(
                'csev_title',
                'options' => array(
                    'header' => 'Title',
                    
                )
            ),
             'csev_department' => array(
                'csev_department',
                'options' => array(
                    'header' => 'Department',
                    
                )
            ),
             'csev_email' => array(
                'csev_email',
                'options' => array(
                    'header' => 'Email',
                    
                )
            ),
             'csev_telephone_no' => array(
                'csev_telephone_no',
                'options' => array(
                    'header' => 'Phone no',
                    
                )
            ),
             'csev_extension' => array(
                'csev_extension',
                'options' => array(
                    'header' => 'Extension',
                    
                )
            ),
             'customer_name' => array(
                'customer_name',
                'options' => array(
                    'header' => 'Customer Name',
                    
                )
            ),
//             'priority' => array(
//                'priority',
//                'options' => array(
//                    'header' => 'priority',
//                    
//                )
//            ),
//            
//            'status' => array(
//                'task',
//                'options' => array(
//                    'header' => 'status',
//                    
//                )
//            ),
//             'mtl' => array(
//                'mtl',
//                'options' => array(
//                    'header' => 'mtl',
//                    
//                )
//            ),
//             'updated' => array(
//                'updated',
//                'options' => array(
//                    'header' => 'updated',
//                    
//                )
//            ),
//             'dueby' => array(
//                'dueby',
//                'options' => array(
//                    'header' => 'dueby',
//                    
//                )
//            ),
//             'dev_status' => array(
//                'dev_status',
//                'options' => array(
//                    'header' => 'dev_status',
//                    
//                )
//            ),
//            
//        'customer_log_id' => array(
//         'customer_log_id',
//         'options' => array(
//             'header' => 'customer_log_id',
//
//         )
//        ),
//         
//         'assigned_to' => array(
//         'assigned_to',
//         'options' => array(
//             'header' => 'assigned_to',
//
//         )
//        ),
           
            'details_btn' => array(
                'type' => 'details_href',
                'url' =>'#/showusers/edit/[[id]]',
                'url_params' => array(
                    'id' => 'csev_seq_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
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
      
        $this->showusers_datatable_filters = array(
            'type' => 'tabs', //only tab type exists at the moment
            'pre_load_data' => false,
            'tabs' => array(
                array(
                    'id' => 'showusers_details', //this must be a unique id
                    'header' => 'Show Users', //tab header to be displayed in the page
                    'fields' => array(
                        //keys needs to match with the keys with columns array ($my_datatable_columns)
                        //for an example key 'firstName' in filters array must be same for the key in columns array
//                        'ctk_showusers' => 'Code',
//                        'task_name' => 'Name',
//                        //'customer_name' => 'customer name',
                        'customer_name' => array(
                            'label' => 'Customer Name',
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
    /************ test showusers****************************/

    /**********************end of test showusers********************/
    
    public function showUsersListAction(Request $request) {
        
        
     
        $ctkNames = $this->CustomersAction();
        $customerListArray = array();

        $i = 0;
        foreach ($ctkNames as $k => $v) {
            $customerListArray[$v['customer_id']] = $v['name'];
        }
        
        $this->showusers_datatable_filters['tabs'][0]['fields']['customer_name']['widget']['choices'] = $customerListArray;
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->showusers_datatable_id, array(
            'columns' => $this->showusers_datatable_columns,
            'source_url' => $this->container->get('router')->generate('weblogsmainmtl_show_users_data', array('cc' => $request->get('cc'))),
            'filtering' => $this->showusers_datatable_filters
//             
        ));

        return $this->render('WEBLOGSMAINMTLShowUsersBundle:showusers:list.html.twig', array(
                    'dataTable' => $dataTable,
        ));
    }

    public function showusersDataAction(Request $request) 
    {
        $data = array(
                'table' => array(
                    'type' => 'service', //type needs to be 'service', mandatory parameter
                    'details' => array( //mandatory parameter
                        'name' => 'WEBLOGS\MAIN\MTL\ShowUsersBundle\Services\ShowUsersBundleServices', //location and name of the services file
                        'function_name' => 'ListMyUsers', //name of the services function
                        'function_params' => array() //any parameter for the services function, except $type, $alias and $query_only which are being injected
                    )
                ),
                'index_col' => 'csev_seq_id', //the unique column of the datatable, mandatory parameter
                'columns' => $this->showusers_datatable_columns, //passing the coloumns array we created earlier, mandatory parameter
                'table_id' => $this->showusers_datatable_id, //unique id of the datatable, mandatory parameter
                'filtering' => $this->showusers_datatable_filters,
                 'use_col_visibility_btn'=>true,
            );
            
            $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
                'table_id' => $this->showusers_datatable_id //unique datatable id we declared earlier, mandatory parameter
            ));

            return $this->container->get('core_function_services')->ESERVGetResponse($contents); //returning a custom response (which is a Symfony response)
     }
     
    /*-------------------------form  showusers  starts------------------------------------------------------*/
      /* FORMS CODE  ----------------------ADD FORM CODE------------------------------------------------- */
     public function showusersNewAction()
    {
         
        
        $showusers_form = $this->createForm(new \WEBLOGS\MAIN\MTL\ShowUsersBundle\Form\CustomerContactsType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_show_users_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )            
        ));
        
        return $this->render("WEBLOGSMAINMTLShowUsersBundle:showusers:add.html.twig", array(
                    'form' => $showusers_form->createView(),
                    'refresh_table_id' => $this->showusers_datatable_id
        ));

    }
    
    public function showusersCreateAction(Request $request)
    {
        $status = false;        
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();
        
        
        $showusers_form = $this->createForm(new \WEBLOGS\MAIN\MTL\ShowUsersBundle\Form\CustomerContactsType(), null, array(
            'action' => $this->generateUrl('weblogsmainmtl_show_users_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )            
        )); 
        
        if ($request->isMethod('POST')) { 
            $showusers_form->handleRequest($request);
            if ($showusers_form->isValid()) { 
                try { 
                    $em->getConnection()->beginTransaction(); 
                   // var_dump($showusers_form->getData());die;
                    $em->persist($showusers_form->getData());
                    $em->flush();                    
                    $message = "Users has been successfully added!";                   
                    $status = true;                   
                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($showusers_form->getErrors(true));
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
            $url = $this->generateUrl("weblogsmainmtl_show_users_list", array());
            return $this->redirect($url);
        }
    }
//    
//    /* ---------------------------------END OF ADD FORM   CODE----------------------------------------------------*/
//     
//     /*-----------------------end of form showusers --------------------------------------------------------*/
     public function CustomersAction() {
         $data = array();
         $temp=array();

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
            $data =  $this->container->get('core_function_services')->GetOutputFormat($result->getQuery(), 'array');
           
        }
        
       return $data;

      
    }
//    
//    /***********************update showusers *************************************************/
//     /* ----------------------START OF EDIT FORM CODE -------------------------------------------------------------------*/
     public function showusersEditAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $showusers = $em->getRepository('WEBLOGSMAINMTLShowUsersBundle:CustomerContacts')->find($id);
        //print_r($showusers);die;
        $showusers_form = $this->createForm(new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form\EditCustomerTasksType(), $showusers, array(
            'action' => $this->generateUrl('weblogsmainmtl_showusers_maintainance_customer_update', array('id' => $id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )            
        )); 
       
        return $this->render("WEBLOGSMAINMTLCodeMaintainanceBundle:showusersmaintainance:edit.html.twig", array(
                    'form' => $showusers_form->createView(),
                    'id' => $id
        ));
    }
    
     public function showusersUpdateAction($id, Request $request)
    {
        $status = false;        
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();
        
        $showusers = $em->getRepository('WEBLOGSMAINMTLCodeMaintainanceBundle:CustomerTasks')->find($id);
        $showusers_form = $this->createForm(new \WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form\EditCustomerTasksType(), $showusers, array(
            'action' => $this->generateUrl('weblogsmainmtl_showusers_maintainance_customer_update', array('id' => $id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable',
            )            
        )); 
        
        if ($request->isMethod('POST')) { 
            $showusers_form->handleRequest($request);
            if ($showusers_form->isValid()) { 
                try { 
                    $em->getConnection()->beginTransaction(); 
                    $em->persist($showusers_form->getData());
                    $em->flush();                    
                    $message = "Code has been successfully updated!";                   
                    $status = true;                   
                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('An error occurred: ') . ': ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($showusers_form->getErrors(true));
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
            $url = $this->generateUrl("weblogsmainmtl_showusers_maintainance_showuserslist", array());
            return $this->redirect($url);
        }
    }
    /* END OF UPADATE CODE */
    
    
    
    /****************end of showusers *********************************************************/
}

