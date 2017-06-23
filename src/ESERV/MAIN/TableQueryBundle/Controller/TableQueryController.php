<?php

namespace ESERV\MAIN\TableQueryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TableQueryController extends Controller 
{
    public $app_session_name = 'application_id';
        
    public function __construct()
    {
        
    }
    
    public function createAction()
    {   
        try{
            
            
            return $this->render('ESERVMAINTableQueryBundle:TableQuery:controller.html.twig', array());        
            
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 500);
        }
        
    }
    
    public function newStep1Action()
    {   
        $em = $this->getDoctrine()->getManager();
        
        $wzServices = new \ESERV\MAIN\WizardBundle\Services\WizardService($em, $this->container, $this->app_session_name);

        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $app_id = !empty($session->get($this->app_session_name)) ? $session->get($this->app_session_name) : false;
        $wzParams = $wzServices->createNewWizard(\ESERV\MAIN\Services\AppConstants::ESERV_WZ_TABLE_QUERY_CODE, false, $app_id);
        
//        $this->get('core_function_services')->checkApplicationExists($this->app_session_name, $em, 1);
        
        $action_url = $this->generateUrl('eserv_main_table_query_process_steps', array('stepNo' => 1));
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            )
        );
        $wzAppId = $wzParams['application_id'];
        $data = $wzServices->getWzPage(1, $wzAppId);
        
        $dataArray = array();
        $dataArray['appId'] = $wzAppId;
        
        if($data != false && !empty($data->getFieldOne()) && !empty($data->getFieldTwo())){
            $dataArray['view'] = $em->getReference('ESERV\MAIN\TableQueryBundle\Entity\QueryView', $data->getFieldOne());
            $dataArray['name'] = $data->getFieldTwo();            
        }        
        
        $form = $this->createForm(new \ESERV\MAIN\TableQueryBundle\Form\TableQuery\Step1Type(), $dataArray, $form_options_array);

        return $this->render('ESERVMAINTableQueryBundle:TableQuery:step1.html.twig', array(
                    'form' => $form->createView(),
        ));        
    }
    
    public function processStepAction($stepNo, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestDataArray = $request->request->all();
        $applicationId = '';
        $wzServices = new \ESERV\MAIN\WizardBundle\Services\WizardService($em, $this->container, $this->app_session_name);
        
        $success = false;
        $msg = '';
        
        try{
           switch($stepNo){
                case '1': 
                    $applicationId = $requestDataArray['eserv_main_table_query_step_1']['appId'];
                    if ($this->checkFormValidity('\ESERV\MAIN\TableQueryBundle\Form\TableQuery\Step1Type', $request)) {
                        $wzServices->toggleStarted('Y', $applicationId);
                        $dataArray = array(
                            'pageNo' => '1',
                            'completed' => 'Y',
                            'data' => array(
                                'fieldOne' => $requestDataArray['eserv_main_table_query_step_1']['view'],
                                'fieldTwo' => $requestDataArray['eserv_main_table_query_step_1']['name'],
                            )
                        );
                        
                        if($wzServices->saveWzPage($dataArray, $applicationId)){
                            $success = true;
                            $msg = 'Step 1 successfully saved!';
                        }
                    }
                    break;
                case '2': 
                    $applicationId = $requestDataArray['eserv_main_table_query_step_2']['appId'];
                    if ($this->checkFormValidity('\ESERV\MAIN\TableQueryBundle\Form\TableQuery\Step2Type', $request)) {
                        $dataArray = array(
                            'pageNo' => '2',
                            'completed' => 'Y',
                            'data' => array(
                                'fieldLongtextOne' => $requestDataArray['eserv_main_table_query_step_2']['rawSqlQuery'],
                                'fieldLongtextTwo' => $requestDataArray['eserv_main_table_query_step_2']['jsonSqlData'],
                                'fieldOne' => $requestDataArray['eserv_main_table_query_step_2']['isCountPressed'],
                            )
                        );

                        if($wzServices->saveWzPage($dataArray, $applicationId)){
                            $success = true;
                            $msg = 'Step 2 successfully saved!';
                        }
                    }
                    break;
                case '3':
                    $applicationId = $requestDataArray['eserv_main_table_query_step_3']['appId'];
                    $queryViewId = false;        
        
                    $wzServices = new \ESERV\MAIN\WizardBundle\Services\WizardService($em, $this->container, $this->app_session_name);
                    $data1 = $wzServices->getWzPage(1, $applicationId);

                    if($data1 != false && !empty($data1->getFieldOne()) && !empty($data1->getFieldTwo())){ 
                        $queryViewId = $data1->getFieldOne();            
                    }  
                    $form_options_array = array(
                        'params' => array(
                            'query_view_id' => $queryViewId
                        )
                    );

                    if ($this->checkFormValidity('\ESERV\MAIN\TableQueryBundle\Form\TableQuery\Step3Type', $request, $form_options_array)) { 
                        $dataArray = array(
                            'pageNo' => '3',
                            'completed' => 'Y',
                            'data' => array(
                                'fieldOne' => $requestDataArray['eserv_main_table_query_step_3']['field'],
                                'fieldBooleanOne' => !empty($requestDataArray['eserv_main_table_query_step_3']['descending']) ? true : false,
                            )
                        );
                        
                        if($wzServices->saveWzPage($dataArray, $applicationId)){
                            //saving to real tables
                            $result = $this->populateTableQueryTables($applicationId); 
                            if($result['success']){
                                $this->clearAddApplicationAction($applicationId);
                                $success = true;
                                $msg = 'Step 3 successfully saved! Redirecting to the list page.';
                            }else{
                                $msg = $result['msg'];
                            }
                        }
                    }
                    break;
                default: throw new \Exception('Error saving data to the wizard.');
            } 
        }catch(\Exception $e){
            $success = false;
            $msg = 'Exception Occurred - '. $e->getMessage();
        }
        
        $array = array(
            'success' => $success,
            'msg' => $msg,
            'application_id' => $applicationId
        );
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($array);
    }
    
    
    public function populateTableQueryTables($app_id)
    {   
        $status = false;
        $msg = '';
        try{      
            
            $em = $this->getDoctrine()->getManager();
            $wzServices = new \ESERV\MAIN\WizardBundle\Services\WizardService($em, $this->container, $this->app_session_name);

            $data1 = $wzServices->getWzPage(1, $app_id);  
            $data2 = $wzServices->getWzPage(2, $app_id); 
            
            $queryView = $em->getRepository('ESERVMAINTableQueryBundle:QueryView')->find($data1->getFieldOne());

            //saving to query master table
            $queryMaster = new \ESERV\MAIN\TableQueryBundle\Entity\QueryMaster();
            $queryMaster->setName($data1->getFieldTwo());        
            $queryMaster->setQueryView($queryView);
            $queryMaster->setQueryJson($data2->getFieldLongtextTwo());
            $queryMaster->setRawSql($data2->getFieldLongtextOne());
            $em->persist($queryMaster);

            //saving query detail where table            
            $jsonArray =  json_decode($data2->getFieldLongtextTwo(), true); 
            $tqServices = new \ESERV\MAIN\TableQueryBundle\Services\TableQueryServices($em, $this->container);
            $tqServices->iterateArray($jsonArray, $queryMaster);
            
            //saving query detail order table
            $data3 = $wzServices->getWzPage(3, $app_id); 
            $orderByField =  $data3->getFieldOne();         
            $orderByFieldDesc =  $data3->getFieldBooleanOne();         
            
            $queryOrder = new \ESERV\MAIN\TableQueryBundle\Entity\QueryDetailOrder();
            $queryOrder->setLineNo(1);    
            $queryOrder->setQueryMaster($queryMaster);
            
            $viewField = $em->getRepository('ESERVMAINTableQueryBundle:QueryViewField')->find($orderByField);
            $queryOrder->setQueryViewField($viewField);
            $orderByFieldDesc ? $queryOrder->setQdoDescending('Y') : $queryOrder->setQdoDescending('N');
            $em->persist($queryOrder);
            
            $em->flush();
            
            $status = true;
            $msg = 'Success populateTableQueryTables';
        }catch(\Exception $e){
            $msg = 'Exception occurred :- ' . $e->getMessage();
        }
        return array(
            'success' => $status,
            'msg' => $msg
        );
    }
    
    
    
    
    
    
    
    private function checkFormValidity($formClass, $request, $formOptionsArray = array())
    {
        $return = false;
        
        $form = $this->createForm(new $formClass(), null, $formOptionsArray);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $return = true;
        }
        
        return $return;
    }
    
    
    
    public function newStep2Action($app_id)
    {   
        $em = $this->getDoctrine()->getManager();
        $this->get('core_function_services')->checkApplicationExists($this->app_session_name, false, 2, false, $app_id);
        
        $action_url = $this->generateUrl('eserv_main_table_query_process_steps', array('stepNo' => 2));
        
        $wzServices = new \ESERV\MAIN\WizardBundle\Services\WizardService($em, $this->container, $this->app_session_name);
        
        $data1 = $wzServices->getWzPage(1, $app_id);
        $dataArray = array(); 
        $dataArray['appId'] = $app_id;
        if($data1 != false && !empty($data1->getFieldOne()) && !empty($data1->getFieldTwo())){ 
            $dataArray['viewId'] = $data1->getFieldOne();            
            $queryView = $em->getReference('ESERV\MAIN\TableQueryBundle\Entity\QueryView', $data1->getFieldOne());
            $dataArray['viewDescription'] = $queryView->getName();
            $dataArray['viewName'] = $queryView->getViewName();
            
        }  
        $data2 = $wzServices->getWzPage(2, $app_id);
        if($data2 != false && !empty($data2->getFieldLongtextTwo())){ 
            $dataArray['jsonSqlData'] = $data2->getFieldLongtextTwo();
            $dataArray['isCountPressed'] = $data2->getFieldOne();
        } 
        
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
        );

        $form = $this->createForm(new \ESERV\MAIN\TableQueryBundle\Form\TableQuery\Step2Type(), $dataArray, $form_options_array);

        return $this->render('ESERVMAINTableQueryBundle:TableQuery:step2.html.twig', array(
                    'form' => $form->createView(),
        ));        
    }
    
    public function newStep3Action($app_id)
    {   
        $em = $this->getDoctrine()->getManager();
        $this->get('core_function_services')->checkApplicationExists($this->app_session_name, false, 3, false, $app_id);
        $queryViewId = false;        
        
        $wzServices = new \ESERV\MAIN\WizardBundle\Services\WizardService($em, $this->container, $this->app_session_name);
        $dataArray = array();
        $dataArray['appId'] = $app_id;
        $data1 = $wzServices->getWzPage(1, $app_id);        
        if($data1 != false && !empty($data1->getFieldOne()) && !empty($data1->getFieldTwo())){ 
            $queryViewId = $data1->getFieldOne();            
        }  
        
        $data3 = $wzServices->getWzPage(3, $app_id);       
        
        if($data3 != false && !empty($data3->getFieldOne())){ 
            $dataArray['field'] =  $em->getRepository('ESERVMAINTableQueryBundle:QueryViewField')->find($data3->getFieldOne());            
            $dataArray['descending'] =  $data3->getFieldBooleanOne();            
        }
        
        $action_url = $this->generateUrl('eserv_main_table_query_process_steps', array('stepNo' => 3));
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
            'params' => array(
                'query_view_id' => $queryViewId
            )
        );
        
        $form = $this->createForm(new \ESERV\MAIN\TableQueryBundle\Form\TableQuery\Step3Type(), $dataArray, $form_options_array);

        return $this->render('ESERVMAINTableQueryBundle:TableQuery:step3.html.twig', array(
                    'form' => $form->createView(),
        ));        
    }
    
    public function listAction()
    {
        //this function has been moved to the client namespace.
        die('This function has been moved to the client namespace');
        return $this->render('ESERVMAINTableQueryBundle:TableQuery:list.html.twig', array(
                    
        ));
    }
    
    public function getFieldsByIdAction(Request $request)
    {   
        $array = array(
            'query_view_id' => $request->request->get('id')
        ); 

        $tqs = new \ESERV\MAIN\TableQueryBundle\Services\TableQueryServices($this->getDoctrine()->getManager(), $this->container);
        
        $return = array(
            'data' => $tqs->getFieldsByViewId($array)
        );
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($return);        
    }
    
    public function getExecuteCountSqlAction(Request $request)
    {
        try{
            $result = $this->container->get('db_core_function_services')->runRawSql($request->request->get('rawSql')); 
            $msg = 'The query successfully executed and returned a count of (' .$result[0]['C'] .') results. You may press the Next button.';
            $success = true;
        }catch(\Exception $e){
            $msg = $e->getMessage();
            $success = false;
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'msg' => $msg,
            'success' => $success
        ));        
    }
    
    
    public function clearAddApplicationAction($deleteWizardRecord = false)
    {
        $success = false;
        $msg = '';
        try{
            $em = $this->getDoctrine()->getManager();
            $session = new \Symfony\Component\HttpFoundation\Session\Session();
            $session->remove($this->app_session_name);
            
            if($deleteWizardRecord !== false){
                $wzServices = new \ESERV\MAIN\WizardBundle\Services\WizardService($em, $this->container, $this->app_session_name);
                $res = $wzServices->deleteWizard($deleteWizardRecord);
                if($res['status']){
                    $em->flush();
                    $success = true;
                }                                
            }
            
            $msg = $this->app_session_name. ' session has been removed.';
            $success = true;
        }catch(\Exception $e){
            $msg = 'Exception :- '.$e->getMessage();
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'msg' => $msg,
            'success' => $success
        ));
    }
}
