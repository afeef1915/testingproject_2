<?php

namespace ESERV\MAIN\ExternalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\ExternalBundle\Services\MerlinAPIConstants;
use Exception;


class MerlinAPIController extends Controller
{
    public function callApiAction(Request $request){
        $dateAndTime = date("Y/m/d h:i:sa");                
        $return = '';
        $key = $request->query->get('key');
        $apiName = $request->query->get('api');
        $apiFormat = $request->query->get('format', 'XML');        
        $apiFormatUpper = strtoupper($apiFormat);
        $apiServices = new \ESERV\MAIN\ExternalBundle\Services\MerlinAPIServices($this->getDoctrine()->getManager(), $this->container);
        
        try{
            $log = "Date and Time - ".$dateAndTime.", API Name - ". $apiName ."\n";
            $log .= "IP - ".$request->getClientIp()."\n";
            
            $secure = $apiServices->securityCheck($request); //checking against allowed IP's
            if ($secure['status']) {
                if(!$apiServices->validateKey($key)){ //checking for key validity
                    $errorMsg = "Invalid API Key given! ($key)";
                    $result = array(
                        'status' => false,
                        'msg' => $errorMsg,
                        'error_type' => MerlinAPIConstants::AUDIT_ERROR_TYPE_EXCEPTION_CODE,
                        'errors' => array(),
                        'contents' => array(),
                    ); 
                    $return = $apiServices->getAPIResponse($apiServices->getOutput($result, $apiFormatUpper), $apiFormatUpper); 
                    $log .= 'Error, '. $errorMsg;

                }else{
                    $apiClass = $this->container->getParameter('merlin_api')['functions_class_path'];
                    if(is_null($apiClass)){
                        throw new \Exception('API Class is null or undefined!', 500);
                    }
                    $class = new $apiClass($this->getDoctrine()->getManager(), $this->container);
                    if(method_exists($class, $apiName)){ //checking for the API method
                        $result = $class->$apiName($request->query->all());                          
                        
                        $return = $apiServices->getAPIResponse($apiServices->getOutput($result, $apiFormatUpper), $apiFormatUpper);                         
                        $log .= "Results,  $return\n";            
                    }else{ 
                        $errorMsg = "API does not exist! ($apiName)";
                        $result = array(
                            'status' => false,
                            'msg' => $errorMsg,
                            'error_type' => MerlinAPIConstants::AUDIT_ERROR_TYPE_EXCEPTION_CODE,
                            'errors' => array(),
                            'contents' => array(),
                        ); 
                        $return = $apiServices->getAPIResponse($apiServices->getOutput($result, $apiFormatUpper), $apiFormatUpper); 
                        $log .= 'Error, '. $errorMsg;
                    }
                }
            }else{   
                $errorMsg = $secure['msg'];
                $result = array(
                    'status' => false,
                    'msg' => $secure['msg'],
                    'error_type' => $secure['error_type'],
                    'errors' => $secure['errors'],
                    'contents' => array(),
                ); 

                $return = $apiServices->getAPIResponse($apiServices->getOutput($result, $apiFormatUpper), $apiFormatUpper); 
                $log .= 'Error, '. $errorMsg;
            }            
        }catch(Exception $e){
            $errorMsg = $e->getMessage();
            $result = array(
                'status' => false,
                'msg' => $errorMsg,
                'error_type' => MerlinAPIConstants::AUDIT_ERROR_TYPE_EXCEPTION_CODE,
                'contents' => array(),
            ); 
            
            $return = $apiServices->getAPIResponse($apiServices->getOutput($result), $apiFormat);             
            $log .= 'An exception has occurred :- '. $errorMsg;     
        }
        
        $log .= "\n------------------------------------------------------ \n";            
        $this->container->get('core_function_services')->CustomErrorLogger('api_access', 'api_access.log', $log, 'TMPCODE');
            
        return $return;
    }
}
