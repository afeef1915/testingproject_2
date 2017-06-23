<?php

namespace ESERV\MAIN\ExternalBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\ExternalBundle\Services\MerlinAPIConstants;
use Symfony\Component\HttpFoundation\Response;

class MerlinAPIServices {

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
        $this->dbCore = $this->c->get('db_core_function_services');
    }

    public function getAPIResponse($contents, $type){
        $response = null;
        switch ($type) {
            case 'XML':
                $response = new Response($contents);
                $response->headers->set('Content-Type', 'application/xml');
                break;
            case 'JSON': 
                $response = new Response($contents);
                $response->headers->set('Content-Type', 'application/json');
                break;
            default:
                $response = new Response($contents);
                $response->headers->set('Content-Type', 'application/xml');
                break;
        }

        return $response;
    }
    
    public function getOutput($apiResultArray, $type = 'XML') {
        if (!is_array($apiResultArray)) {
            throw new \Exception('Invalid output!', 500);
        }
        
        $success_flag['API_SUCCESS'] = $apiResultArray['status'] ? 'Y' : 'N'; 
        $new_raw_output = array_merge($success_flag, $apiResultArray['contents']); 
        
        if (array_key_exists('error_type', $apiResultArray) && !empty($apiResultArray['error_type'])) {
            $api_errors = array();
            if ($apiResultArray['error_type'] != MerlinAPIConstants::AUDIT_ERROR_TYPE_EXCEPTION_CODE) {
                foreach ($apiResultArray['errors'] as $err) {
                    $api_errors['API_ERRORS']['ERROR'] = $err;
                }
            } else {
                $api_errors['API_ERRORS']['ERROR'] = $apiResultArray['msg'];
            }
            $new_raw_output = array_merge($new_raw_output, $api_errors);
        }

        switch ($type) {
            case 'XML':
                $processed_output = $this->toXML($new_raw_output, 'API_DETAILS');
                break;
            case 'JSON':
                $processed_output = json_encode($new_raw_output);
                break;
            default :
                throw new \Exception("Unsupported format! ($type)", 500);
        }
        
        return $processed_output;
    }
    
    public static function toXML($data, $rootNodeName = 'ResultSet', &$xml = null) {
        if (is_null($xml)) //$xml = simplexml_load_string( "" );
            $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");

        // loop through the data passed in.
        foreach ($data as $key => $value) {

            $numeric = false;

            // no numeric keys in our xml please!
            if (is_numeric($key)) {
                $numeric = 1;
                $key = $rootNodeName;
            }

            // delete any char not allowed in XML element names
            $key = preg_replace('/[^a-z0-9\-\_\.\:]/i', '', $key);

            // if there is another array found recrusively call this function
            if (is_array($value)) {
                $node = MerlinAPIServices::isAssoc($value) || $numeric ? $xml->addChild($key) : $xml;

                // recrusive call.
                if ($numeric)
                    $key = 'anon';
                MerlinAPIServices::toXml($value, $key, $node);
            } else {

                // add single node.
                $value = htmlentities($value, ENT_XML1, 'UTF-8');
                #$value = htmlspecialchars($value, ENT_QUOTES);                 

                $xml->addChild($key, $value);
            }
        }

        // pass back as XML
        return $xml->asXML();

        // if you want the XML to be formatted, use the below instead to return the XML
        //$doc = new DOMDocument('1.0');
        //$doc->preserveWhiteSpace = false;
        //$doc->loadXML( $xml->asXML() );
        //$doc->formatOutput = true;
        //return $doc->saveXML();
    }
    
    /**
     * Name: Do all security checking here (e.g. IP validation)
     */
    public function securityCheck($request) {
        $secure_arr = array(
            'status' => true
            , 'msg' => ''
            , 'error_type' => ''
            , 'errors' => array()
            , 'contents' => array()
        );


        $isDevEnvironment = $this->coreF->isDevEnvironment();
        
        if (!$isDevEnvironment) {
            $apiRestrictedIps = $this->c->getParameter('allowed_ips') ? $this->c->getParameter('allowed_ips') : array();            
            $clientIP = $this->c->get('request')->getClientIp();

            if (!in_array($clientIP, $apiRestrictedIps)) {
                $secure_arr = array(
                    'status' => false
                    , 'msg' => 'Access Denied!'
                    , 'error_type' => MerlinAPIConstants::AUDIT_ERROR_TYPE_ACCESS_CODE
                    , 'errors' => array('You are not authorised to access this API!')
                    , 'contents' => array()
                );
            }
        }
//If validation fails return an error
//        $secure_arr = array(
//                          'status' => false
//                         ,'msg' => 'Failed security validation'
//                         ,'error_type' => EServicesAPIConstants::AUDIT_ERROR_TYPE_VALIDATION_CODE
//                         ,'errors' => array('Failed security validation')
//                         ,'contents' => array()
//                      );        

        return $secure_arr;
    }

    // determine if a variable is an associative array
    public static function isAssoc($array){
        return (is_array($array) && 0 !== count(array_diff_key($array, array_keys(array_keys($array)))));
    }
    
    
    public function validateKey($key) {
        $return = false;
        
        $apiSecretKey = $this->c->getParameter('merlin_api')['secret_key'];
        if(is_null($apiSecretKey)){
            throw new \Exception('Merlin API secret key cannot blank or undefined!', 500);
        }else if($apiSecretKey == 'THIS_IS_DEFAULT_KEY_PLEASE_CHANGE') {
            throw new \Exception('Default API Key used. Please use your own key!', 500);
        }else if(md5($apiSecretKey) === $key) {
            $return = true;
        }
        
        return $return;
    }
    
    
}
