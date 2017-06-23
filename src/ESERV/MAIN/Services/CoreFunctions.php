<?php

namespace ESERV\MAIN\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;
use ESERV\MAIN\Services\AppConstants;
use DateTime;

class CoreFunctions extends Controller {
    /*
     *  Following four parameters will be initialized from the constructor call.
     */

    private $FileSystem;
    private $Request;
    private $Container;
    private $EntityManager;
    private $CachePath;
    private $xmlString;

    /**
     * Intitializes File System, Request, Security Context, Container and Entity Manager.(1777499389)
     *
     * @param RequestStack $request_stack (Injected parameter)
     * @param Container $c (Injected parameter)
     * @param EntityManager $e (Injected parameter)
     *
     * @return n/a
     * @throw n/a
     */
    public function __construct(RequestStack $request_stack, Container $c = null, EntityManager $e = null) {
        $ds = DIRECTORY_SEPARATOR;
        $this->FileSystem = new Filesystem();
        $this->Request = $request_stack->getCurrentRequest();
        $this->Container = $c;
        $this->EntityManager = $e;
        $this->CachePath = __DIR__ . '..' . $ds . '..' . $ds . '..' . $ds . '..' . $ds . '..' . $ds . 'app' . $ds . 'cache' . $ds;
    }

    /**
     * Logs errors/exceptions into a file.(2304035594)
     *
     * @param String FolderName (Mandatory)
     * @param String FileName (Mandatory)
     * @param String Message (Mandatory)
     * @param String TmpCode Any unique code (possibly md5() code) (Optional, default is '')
     *
     * @return n/a
     * @throw n/a
     *
     */
    public function CustomErrorLogger($FolderName, $FileName, $Message, $TmpCode = '') {
        $found = false;
//        $ds = DIRECTORY_SEPARATOR;
//        $Path = __DIR__ . '..' . $ds . '..' . $ds . '..' . $ds . '..' . $ds . '..' . $ds . 'web' . $ds . 'tmp'
//                . $ds . $FolderName . $ds;
        $rootUrl = $this->Container->get('kernel')->getRootDir();
        $Path = "$rootUrl/../web/tmp/$FolderName/";
        $ErrorMessage = $Message;

        try {
            if (!$this->FileSystem->exists($Path)) {
                $this->FileSystem->mkdir($Path);
            }
            //Check that particular file exists or not
            if ($this->FileSystem->exists($Path . $FileName)) {
                $lines = file($Path . $FileName);

                //Checking for existing TmpCodes
                foreach ($lines as $line) {
                    if (!empty($TmpCode)) {
                        if (strpos($line, $TmpCode) !== false) {
                            $found = true;
                        }
                    }
                }
            }

            //Append the log only if TmpCode is not exists
            if ($found == false) {
                file_put_contents($Path . $FileName, "$ErrorMessage\n", FILE_APPEND | LOCK_EX);
            }
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while creating your directory at " . $e->getPath();
        }
    }

    /**
     * Customize the log message and return (Mainly called using method 'CustomErrorLogger'.(1272285609))
     *
     * @param String $TmpCode (Mandatory)
     * @param String $ErrorMessage (Mandatory)
     * @param String $ErrorLocation (Mandatory)
     * @param String $Ip - (Optional, default is '')
     * @param String $StatusCode - Any unique code (possibly md5() code) (Optional, default is '')
     *
     * @return String
     * @throw n/a
     *
     */
    public function GetLogMessage($TmpCode, $ErrorMessage, $ErrorLocation, $Ip = '', $StatusCode = '') {
        $outputMsg = '';

        $outputMsg .= date('Y-m-d H:i:s');
        $outputMsg .= $Ip != '' ? ' | IP :- ' . $Ip : '| IP :- ' . $_SERVER['REMOTE_ADDR'];
        $outputMsg .= $StatusCode != '' ? ' | Error Code :- ' . $StatusCode : '';
        $outputMsg .= ' | Error Message [' . $TmpCode . '] :- ' . $ErrorMessage;
        $outputMsg .= ' | Error Location :- ' . $ErrorLocation;
        $outputMsg .= PHP_EOL;

        return $outputMsg;
    }

    /**
     * Split Doctrine objects into array, xml or json formats and return.(1697379375)
     *
     * @param Doctrine $Obj (Mandatory)
     * @param String $Type (Mandatory)
     *
     * @return Array, XML, JSON or Doctrine
     * @throw n/a
     *
     */
    public function GetOutputFormat($Obj, $Type) {
        $output = '';
        switch ($Type) {
            case 'array': $output = $this->getArray($Obj);
                break;
            case 'xml': break;
            case 'json': break;
            case 'doctrine': $output = $Obj;
                break;
            default: $output = $Obj;
        }

        return $output;
    }

    /**
     * Get the XML of Doctrine object.(****)
     *
     * @param ORMEntityManager $em (Mandatory)

     * @return XML
     * @throw n/a
     *
     */
    public function getXML(Doctrine\ORM\EntityManager $em) {
        
    }

    /**
     * Get the Array of Doctrine object. Includes single or multiple results.(1090389294)
     *
     * @param Doctrine $data (Mandatory)
     * @param Boolean $single_result (Optional, default is 'false')
     *
     * @return Array
     * @throw n/a
     *
     */
    public function getArray($data, $single_result = false) {
        return $single_result ? $data->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY) : $data->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    /**
     * Returns a XML for an Array.()
     *
     * @param Array $result_array (Mandatory)
     * @param SimpleXmlElement $simple_xml_element
     *
     * @return String SimpleXMLElement
     * @throw n/a
     *
     */
    public function arrayToXml($result_array, $simple_xml_element) {
        $arrayKeyCode = AppConstants::ARRAY_KEY_CODE;
        foreach ($result_array as $key => $value) {
            if (is_array($value)) {
                $key = is_numeric($key) ? "$arrayKeyCode" : $key;
                $subnode = $simple_xml_element->addChild("$key");
                self::arrayToXml($value, $subnode);
            } else {
                $key = is_numeric($key) ? "$arrayKeyCode" : $key;
                if (is_object($value) && isset($value->date)) {
                    $simple_xml_element->addChild("$key", "$value->date");
                } else {
                    //For null values
                    if ($value == null) {
                        $newVal = '-';
                        $simple_xml_element->addChild("$key", htmlspecialchars($newVal));
                    } else {
                        $simple_xml_element->addChild("$key", htmlspecialchars($value));
                    }
                }
            }
        }
        return $simple_xml_element->asXML();
    }

    function getXMLFromArray($array, $emptyXml = true) {
        if($emptyXml){
            $this->xmlString = '';
        }
        foreach ($array as $key => $subArray) {
            if (is_array($subArray)) {
                $attrs = "";
                if (isset($subArray["@attributes"])) {
                    foreach ($subArray["@attributes"] as $attrKey => $attrValue) {
                        $attrs .= $attrKey . '="' . $attrValue . '" ';
                    }
                    unset($subArray["@attributes"]);
                }
                if (empty($subArray)) {
                    $this->xmlString .= "<$key $attrs> </$key>";
               } else {
                    $arrayKeys = array_keys($subArray);
                    if (in_array('0', $arrayKeys)) {
                        foreach ($subArray as $subKey => $subValue) {
                            if((is_array($subValue) && !empty($subValue)) || (!is_array($subValue) && !empty(trim($subValue)))){
                                $nsubVal[$key] = $subValue;
                                self::getXMLFromArray($nsubVal, false);
                            } else {
                                $this->xmlString .= "<$key $attrs> </$key>";
                            }
                        }
                    } else {
                        $this->xmlString .= "<$key $attrs>";
                        self::getXMLFromArray($subArray, false);
                        $this->xmlString .= "</$key>";
                    }
                }
            } else {
                $this->xmlString .= "<$key>$subArray</$key>";
            }
        }
        return $this->xmlString;
    }

    /**
     * Returns an Array for a given XML String.()
     *
     * @param String $xml_string (Mandatory)
     *
     * @return Array
     * @throw n/a
     *
     */
    public function xmlToArray($xml_string) {
        $xml = simplexml_load_string("<?xml version='1.0'?>" . $xml_string);
        if ($xml) {
            $json = json_encode($xml);
            $data_array[0] = json_decode($json, TRUE);

            $new_array = array();

            if (array_key_exists(AppConstants::ARRAY_KEY_CODE, $data_array[0])) {
                foreach ($data_array[0] as $d) {
                    $new_array[] = $d;
                }
                return $new_array[0];
            } else {
                return $data_array;
            }
        } else {
            return $data_array[0] = array();
//            if($this->isDevEnvironment()){
//                $result = array(
//                    'error_message' => 'Invalid xml',
//                    'xml_string' => $xml_string,
//                    'xml_errors' => libxml_get_errors()
//                );
//            } else {
//                $result = array(
//                    'error_message' => 'Invalid xml'
//                );
//            }
//            throw new \RuntimeException('Invalid xml');
        }
    }

    /**
     * Returns a response for the give type.()
     *
     * @param String $contents (Mandatory)
     * @param String $type (Optional, default is 'application/json')
     *
     * @return Response
     * @throw n/a
     *
     */
    public function ESERVGetResponse($contents, $type = 'application/json') {
        $Response = new \Symfony\Component\HttpFoundation\Response();
        $Response->headers->set('Content-Type', $type);

        $Response->setContent(($contents));
        return $Response;
    }

    public function executeImportCommand($filter) {
        $project_path = $this->Container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $commandline = "php app/console doctrine:mapping:import ESERVClientBundle --filter=$filter yml";

        $process = new \Symfony\Component\Process\Process($commandline);
        $process->setWorkingDirectory($project_path);
        $process->run();
        try {
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }
//            echo $process->getOutput().'<hr/>';
        } catch (\RuntimeException $r) {
            echo $r->getMessage();
        }
    }

    public function executeGenerateEntitiesCommand($entity) {
        $project_path = $this->Container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $commandline = "php app/console doctrine:generate:entities ESERVClientBundle:$entity --path=src --no-backup";

        $process = new \Symfony\Component\Process\Process($commandline);
        $process->setWorkingDirectory($project_path);
        $process->run();
        try {
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }
//            echo $process->getOutput().'<hr/>';
        } catch (\RuntimeException $r) {
            echo $r->getMessage();
        }
    }

    public function executeBuildFormCommand($form_file) {
        $project_path = $this->Container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $commandline = "php app/console doctrine:generate:form ESERVClientBundle:$form_file";
        $form_type_file = $this->Container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                . DIRECTORY_SEPARATOR . 'ClientBundle' . DIRECTORY_SEPARATOR .
                'Form' . DIRECTORY_SEPARATOR . $form_file . 'Type.php';
        if (is_file($form_type_file)) {
            unlink($form_type_file);
        }

        $process = new \Symfony\Component\Process\Process($commandline);
        $process->setWorkingDirectory($project_path);
        $process->run();
        try {
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }
//            echo $process->getOutput().'<hr/>';
        } catch (\RuntimeException $r) {
            echo $r->getMessage();
        }
    }

    /**
     * Use to write to extended entity files for client data groups. Does not use anymore. 
     * Function kept without deleting because this was an important step when we introduce client data.
     * You can delete this if you like :) (Anjana - 07/10/2014)
     *
     * @param RequestStack $tableName Name of the table been created
     * @param Container $type Usually the id of client entity table
     * @param EntityManager $bundleName Name of the symfony 2 bundle
     *
     * @return n/a
     * @throw n/a
     * 
     * @deprecated
     */
    public function appendToEntityFile($tableName, $type, $bundleName = 'ContactBundle') {
        $file = '';
        switch ($type) {
            case '1': $file = 'MyPerson.php';
                break;
            case '2': $file = 'MyOrganisation.php';
                break;
            case '3':
                $file = 'MyWorkplace.php';
                $bundleName = 'MembershipBundle';
                break;
            case '4':
                $file = 'MyEmployer.php';
                $bundleName = 'MembershipBundle';
                break;
            case '5':
                $file = 'MyEstablishment.php';
                $bundleName = 'QualificationBundle';
                break;
            default : die('System cannot find which file to append contents!');
        }
        $rootDir = $this->Container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
                . DIRECTORY_SEPARATOR . 'MAIN' . DIRECTORY_SEPARATOR . $bundleName . DIRECTORY_SEPARATOR .
                'Entity' . DIRECTORY_SEPARATOR . 'MTLEntities' . DIRECTORY_SEPARATOR . $file;

        $var_name = 'eservClient' . $tableName;
        $myFile = $rootDir;
        $stringData = ''
                . '//start_' . $var_name . "\n"
                . 'public $' . $var_name . ';' . ""
                . "\n\n"
                . 'public function setEservClient' . $tableName . '(\ESERV\ClientBundle\Entity\EservClient' . $tableName . ' $' . $var_name . ' = null)' . "\n"
                . "{" . "\n"
                . '$this->' . $var_name . ' = $' . $var_name . ';' . "\n"
                . 'return $this;' . "\n"
                . "}"
                . "\n\n"
                . 'public function getEservClient' . $tableName . '()' . "\n"
                . "{" . "\n"
                . 'return $this->' . $var_name . ';' . "\n"
                . "}" . "\n"
                . '//end_' . $var_name . "\n"
                . "\n\n/***/";

        $file_get_contents = file_get_contents($rootDir);
        $pattern = '/(public )\$(' . $var_name . ';+)/';
        if (!preg_match($pattern, $file_get_contents)) {
            $str = str_replace("/***/", $stringData, $file_get_contents);
            $file_new_contents = $str;
            file_put_contents($myFile, $file_new_contents);
        }
    }

    //    public function createYmlValidation($data = array())
//    {
//        if(is_array($data)){
//            try{
//                $bundleName = $data['bundle_name'];
//                $entityName = $data['entity_name'];
//                $file = 'validation.yml';
//
//                $validation_file = $this->Container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ESERV'
//                        . DIRECTORY_SEPARATOR . $bundleName . DIRECTORY_SEPARATOR .
//                        'Resources' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $file;
//                fopen($validation_file, "w");
//                
//                $stringData = 'ESERV\\'.$bundleName.'\Entity\\'.$entityName;
//                
//            }
//            catch(\Exception $e){
//                return 'Error occured while creating the validation file - '.$e->getMessage();
//            }
//            
//        }else{
//            die('Data needs to be in form of array.');
//        }
//    }

    public function changeDateFormat($date = 'dd/mm/yyyy', $time = '00:00:00', $clientDateFormat = null) {
        $formatted_date = '';
        if ($clientDateFormat !== null) {
            $dateObj = DateTime::createFromFormat($clientDateFormat, $date);
            if ($dateObj instanceof \DateTime) {
                $formatted_date = $dateObj->format('Y-m-d') . ' ' . $time;
            }
        }
        if ($formatted_date === '') {
            $day = substr($date, 0, 2);
            $month = substr($date, 3, 2);
            $year = substr($date, 6, 4);

            $formatted_date = $year . '-' . $month . '-' . $day . ' ' . $time;
        }
        return $formatted_date;
    }

    public function alterDateFormat($oldDate, $oldFormat = 'Y-m-d H:i:s', $newFormat, $newDateAsString = false) {
        $newDateStr = '';
        $newDate = null;
        if (!($oldDate instanceof \DateTime) && (!empty($oldDate)) && (!empty($oldFormat))) {
            $createdOldDate = DateTime::createFromFormat($oldFormat, $oldDate);
            if ($createdOldDate instanceof \DateTime) {
                $oldDate = $createdOldDate;
            }
        }
        if (($oldDate instanceof \DateTime) && (!empty($newFormat))) {
            $newDateStr = $oldDate->format($newFormat);
            $newDate = DateTime::createFromFormat($newFormat, $newDateStr);
        }
        if ($newDateAsString == true) {
            return $newDateStr;
        } else {
            return $newDate;
        }
    }

    public function stringToDate($str, $format = 'Y-m-d H:i:s') {
        $newDate = null;
        if ($str instanceof \DateTime) {
            $newDate = $str;
        } else {
            if ((!empty($str)) && (!empty($format))) {
                $createdDate = DateTime::createFromFormat($format, $str);
                if ($createdDate instanceof \DateTime) {
                    $newDate = $createdDate;
                }
            }
        }
        return $newDate;
    }

    /*
     * Get curl contents of a url
     */

    public function getCurlContents($url, $method, $required_fields, $ssl_disable = false, $options = array()) {

        $result = '';

        try {
            $tmp_fields = '';

            // Prepare the fields for query string, don't include the action URL OR method
            foreach ($required_fields as $key => $value) {
                $tmp_fields .= $key . '=' . rawurlencode($value) . '&';
            }

            // Strip the last comma
            $fields = substr($tmp_fields, 0, strlen($tmp_fields) - 1);

            // Initiate cURL
            $ch = curl_init();
            // Do we need to POST or GET ?
            if (strtoupper($method) == 'POST') {
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $fields);
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            if (array_key_exists('proxy', $options)) {
                curl_setopt($ch, CURLOPT_PROXYPORT, $options['proxy']['port']);
                curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
                curl_setopt($ch, CURLOPT_PROXY, $options['proxy']['ip']);
            }


            if ($ssl_disable) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            }

            // Get result and close cURL
            $result = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }

        return $result;
    }

    public function getEservFormErrors($form_errors) {
        $errors_array = array();
        $field_name = '';

        if (is_object($form_errors)) {
            foreach ($form_errors as $k => $value) {
                $cause = $value->getCause();
//                 if (is_object($cause)) {
//                     echo '$cause: Obj';
//                 } else {
//                     echo '$cause: '.$cause;
//                 }
//                 die;
                if (is_object($cause)) {
                    $field_name = $cause->getPropertyPath();
                    $extracted_values = $this->extractFieldName($field_name);
                    $errors_array[$extracted_values['name']] = array(
                        'name' => implode('', $extracted_values['name_array']),
                        'message' => $value->getMessage(),
                    );
                } else {
                    $_val = $value->getMessage();
                    $error_array = is_array($_val) ? $_val : array($_val);
                    $new_key = key($error_array);
////                    echo '$new_key: '.$new_key;
//                    print_r($error_array);die;
                    $final_array = $error_array[$new_key];
                    if (!is_array($final_array)) {
                        foreach ($error_array as $kk => $vv) {
                            $errors_array[$kk] = array(
                                'name' => "[$kk]",
                                'message' => $vv,
                            );
                        }
                    } else {
                        foreach ($error_array[$new_key] as $kk => $vv) {
                            $errors_array[$new_key . '.' . $kk] = array(
                                'name' => "[$new_key][$kk]",
                                'message' => $vv,
                            );
                        }
                    }
                }
            }
        }

        return $errors_array;
    }

    private function extractFieldName($fieldName) {

        $matches = array();
        $str = '';
        preg_match_all("/\[(.*)\]/U", $fieldName, $matches);

        $name_array = array();

        foreach ($matches[1] as $key => $value) {
            $str .= $value . '.';
        }
        $stripped_str = substr($str, 0, -1);

        foreach ($matches[0] as $key => $value) {
            $name_array[] = $value;
        }

        return array(
            'name' => $stripped_str,
            'name_array' => $name_array
        );
    }

    public function prepareAutoComplete($ResultsArray, $HtmlResult, $Result, $Value = 'id') {
        $items_result = array();

        foreach ($ResultsArray as $obj) {
            $item = array(
                'html_result' => $obj[$HtmlResult],
                'result' => $obj[$Result],
                'value' => $obj[$Value]
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }

    //Show messages
    public function showMessage($status, $message, $request, $form = null, $options = array()) {
        $app_logging_enabled = $this->Container->getParameter('app_logging_enabled', false);


        if (!$message && !$status) {
            $message = 'An error occurred!';
        }

        $errors_array = array();
        if ($form) {
            if ((!$status) && (!$form->isValid())) {
                $errors_array = $this->getEservFormErrors($form->getErrors(true));
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
            if ($app_logging_enabled && !$status) {
                throw new \Exception('Error', 500);
            } else {
                return $message;
            }
        }
    }

    /**
     * Name: validateAddress
     * Returns an array ($result_arr)
     *   - if the address is valid $result_arr is empty 
     *   - if the address is invalid $result_arr contains an array of errors
     *   - if an exception occurs $result_arr['exception'] has the exception
     *     message
     */
    public function validateAddress($address_data, $required = TRUE, $prefix_string = NULL) {
        $status = false;
        $errors_arr = array();
        $msg = '';
        $result_arr = array();


        $line1 = $address_data['address_line1'] == NULL ? NULL : $address_data['address_line1']['value'];
        $line1_key = $address_data['address_line1'] == NULL ? NULL : $address_data['address_line1']['key'];

        $line2 = $address_data['address_line2'] == NULL ? NULL : $address_data['address_line2']['value'];

        $line3 = $address_data['address_line3'] == NULL ? NULL : $address_data['address_line3']['value'];

        $town = $address_data['town'] == NULL ? NULL : $address_data['town']['value'];
        $town_key = $address_data['town'] == NULL ? NULL : $address_data['town']['key'];

        $postcode = $address_data['postcode'] == NULL ? NULL : $address_data['postcode']['value'];
        $postcode_key = $address_data['postcode'] == NULL ? NULL : $address_data['postcode']['key'];

        $county = $address_data['county'] == NULL ? NULL : $address_data['county']['value'];

        $country = $address_data['country'] == NULL ? NULL : $address_data['country']['value'];

        try {
            if (
                    ((empty($line1)) || ($line1 == NULL) || ($line1 == '')) &&
                    ((empty($line2)) || ($line2 == NULL) || ($line2 == '')) &&
                    ((empty($line3)) || ($line3 == NULL) || ($line3 == '')) &&
                    ((empty($town)) || ($town == NULL) || ($town == '')) &&
                    ((empty($county)) || ($county == NULL) || ($county == '')) &&
                    ((empty($country)) || ($country == NULL) || ($country == '')) &&
                    ((empty($postcode)) || ($postcode == NULL) || ($postcode == ''))
            ) {
                if ($required) {
                    $errors_arr[$line1_key] = 'Address Line 1 is required';
                    $errors_arr[$town_key] = 'Town is required';
                    $errors_arr[$postcode_key] = 'Postcode is required';
                    $msg = 'Address details required. Please fill Address details before saving the form.';
                } else {
                    $msg = 'Not required but failed.';
                }
            } else {

                if (
                        ((empty($line1)) || ($line1 == NULL) || ($line1 == '')) ||
                        ((empty($town)) || ($town == NULL) || ($town == '')) ||
                        ((empty($postcode)) || ($postcode == NULL) || ($postcode == ''))
                ) {
                    $msg = 'Please fill in ';
                    if ((empty($line1)) || ($line1 == null) || ($line1 == '')) {
                        $errors_arr[$line1_key] = 'Address Line 1 is required';
                        $msg .= 'Address Line 1, ';
                        $tmp = false;
                    }
                    if ((empty($town)) || ($town == null) || ($town == '')) {
                        $errors_arr[$town_key] = 'Town is required';
                        $msg .= 'Town, ';
                        $tmp = false;
                    }
                    if ((empty($postcode)) || ($postcode == null) || ($postcode == '')) {
                        $errors_arr[$postcode_key] = 'Postcode is required';
                        $msg .= 'Postcode.';
                        $tmp = false;
                    }
                } else {
                    $status = true;
                }
            }
        } catch (\Exception $ex) {
            $this->insertMtlError(
                    substr(
                            sprintf(
                                    'DbCoreFunctions::validateAddress ' .
                                    '$line1: %s, $line2: %s, $line3: %s, $town: %s' .
                                    ', $county: %s, $country: %s, $postcode: %s' .
                                    ', $required: %s'
                                    , $line1, $line2, $line3, $town
                                    , $county, $country, $postcode
                                    , ($required ? 'TRUE' : 'FALSE')
                            )
                            , 0, 100
                    )
                    , $ex->getMessage()
            );

            $status = false;
            $msg = 'Error occurred :- ' . $ex->getMessage();
        }

        $formatted_errs = $this->formatAddressErrors($errors_arr, $prefix_string);

        $result_arr = array(
            'success' => $status,
            'msg' => $msg,
            'errors' => $formatted_errs
        );

        return $result_arr;
    }

    /**
     * Formats the errors in a way that can be used to higlight form elements in the form.
     * This particular function is called from the validateAddress() function from CoreFunctions.php
     *
     * @param array $errors_arr (Mandatory)
     * @param string $prefix_string (Mandatory) Eg:- '[person][address]'    * 
     *
     * @return array
     * @throw n/a
     *
     */
    public function formatAddressErrors($errors_arr, $prefix_string = NULL) {
        $tmp_arr1 = array();

        foreach ($errors_arr as $k => $elem) {
            $name = $prefix_string === NULL ? '[' . $k . ']' : $prefix_string . '[' . $k . ']';
            $tmp_arr1[$k] = array(
                'name' => $name,
                'message' => $elem
            );
        }

        return $tmp_arr1;
    }

    /**
     * Encodes a string.
     *
     * @param string $str (Mandatory)
     *
     * @return string
     * @throw n/a
     *
     */
    public function eservEncode($str) {
        return str_replace(array('+', '/'), array('-', '_'), base64_encode($str));
    }

    /**
     * Decodes a string.
     *
     * @param string $str (Mandatory)
     *
     * @return string
     * @throw n/a
     *
     */
    public function eservDecode($str) {
        return base64_decode(str_replace(array('-', '_'), array('+', '/'), $str));
    }

    /*
     *  Url: http://codepad.org/UL8k4aYK
     */

    public function randomPassword() {
        // Samir: Removed some charachtars as text fields don't accept them in forms
        $alphabet = "_-abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    /* random password rewrite  craeted by mohd afeef 10/4/2017*/
            function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
            }
    /**
     * Clear the symfony cache
     *
     * @param String $env
     *
     * @return n/a
     * @throw n/a
     */
    public function clearSymfonyCache($env, $folder = false, $delete_folder = true) {
        try {
            $ds = DIRECTORY_SEPARATOR;
            $dir = $this->CachePath . $ds . $env . ($folder ? '/' . $folder : '');
            $this->unlinkRecursive($dir, $delete_folder);
        } catch (\Exception $e) {
            throw new \Exception('Exception occurred' . $e->getMessage(), 500);
        }
    }

    /**
     * Recursively delete a directory
     *
     * @param string $dir Directory name
     * @param boolean $deleteRootToo Delete specified top-level directory as well
     */
    public function unlinkRecursive($dir, $deleteRootToo = true) {
        if (!$dh = @opendir($dir)) {
            return;
        }
        while (false !== ($obj = readdir($dh))) {
            if ($obj == '.' || $obj == '..') {
                continue;
            }

            if (!@unlink($dir . '/' . $obj)) {
                self::unlinkRecursive($dir . '/' . $obj, true);
            }
        }

        closedir($dh);

        if ($deleteRootToo) {
            @rmdir($dir);
        }

        return;
    }

    /**
     * Gets the full url for current host.
     * 
     * @return full host url
     * @throw n/a
     *
     */
    public function getFullHost() {
        $request = $this->Container->get('request');
        return $request->getScheme() . '://' . $request->getHttpHost();
    }

    /**
     * Returns all MTLESERVView cookie names.
     * 
     * @return Array
     * 
     * @throw n/a
     *
     */
    public function getAllMTLESERVViewCookieNames() {
        $request = $this->Container->get('request');
        $all_cookies = $request->cookies->all();
        $mtl_eserv_cookie_names = array();

        $regex = "/MTLESERVView/";

        foreach ($all_cookies as $k => $v) {
            if (preg_match($regex, $k)) {
                $mtl_eserv_cookie_names[] = $k;
            }
        }

        return $mtl_eserv_cookie_names;
    }

    /**
     * Creates a file in the system.
     * 
     * @param String $content (Mandatory)
     * @param Array $options 
     * 
     * @return Array
     * 
     * @throw \Exception
     *
     */
    public function createFile($content, $options = array()) {
        $status = false;
        $message = '';
        $url = null;

        if (!is_null($content)) {
            try {
                $user_id = $this->Container->get('security.token_storage')->getToken()->getUser()->getId();
                $tmp_folder = '_TEMP_';

                $file_name = (isset($options['file_name']) ? $options['file_name'] : md5(rand(0, 9)));
                $extension = (isset($options['extension']) ? $options['extension'] : 'tmp');
                $folder_name = (isset($options['folder_name']) ? $options['folder_name'] : $tmp_folder);
                $fullHost = (isset($options['full_host']) ? $options['full_host'] : null);

                $full_path = $this->Container->get('kernel')->getRootDir() . '/../web/tmp/' . $folder_name . '/' . $user_id . '/';

                $date = new \DateTime();
                $file_name_a = $file_name . '-' . $date->getTimestamp() . '.' . $extension;
                $file_with_path = $full_path . $file_name_a;

                $download_url = $this->Container->get('kernel')->getRootDir() . '/../web/tmp/' . $folder_name . '/' . $user_id . '/' . $file_name_a;

                if (array_key_exists('full_host', $options) && $options['full_host'] == true) {
                    $base_url = $this->Container->get('router')->getContext()->getBaseUrl();
                    $download_url = $this->getFullHost() . $base_url . '/../tmp/' . $folder_name . '/' . $user_id . '/' . $file_name_a;
                }

                if (!file_exists($full_path)) {
                    mkdir($full_path, 0777, true);
                }
                $save_file = file_put_contents($file_with_path, $content);

                if ($save_file) {
                    $message = 'File successfully created!';
                    $url = $download_url;
                    $status = true;
                } else {
                    $message = 'File creation failed!';
                    $status = false;
                }
            } catch (\Exception $e) {
                $status = false;
                $message = 'Exception occurred :- ' . $e->getMessage();
            }
        } else {
            $message = 'Content cannot be blank.';
        }

        return array(
            'success' => $status,
            'msg' => $message,
            'url' => $url
        );
    }

    //http://stackoverflow.com/questions/1993721/how-to-convert-camelcase-to-camel-case
    public function from_camel_case($input) {
        preg_match_all('!([a-z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * Convert strings with underscores into CamelCase
     *
     * @param    string    $string    The string to convert
     * @param    bool    $first_char_caps    camelCase or CamelCase
     * @return    string    The converted string
     * 
     * More - http://www.phpro.org/examples/Underscore-To-Camel-Case.html
     */
    function underscoreToCamelCase($string, $first_char_caps = false) {
        if ($first_char_caps == true) {
            $string[0] = strtoupper($string[0]);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $string);
    }

    public function getESERVSystemConfig($code, $default = null) {
        $value = $default;

        if ($this->Container->hasParameter($code)) {
            $value = $this->Container->getParameter($code)['value'];
        }

        return $value;
    }

    public function stripNINumber($niNumber) {
        $pattern = '/-| |_/';
        $niNumber = preg_replace($pattern, '', $niNumber);
        return $niNumber;
    }

    /**
     * Checks whether the environment is a development environment or not.()     *
     *
     * @return Boolean 
     * @throw n/a
     *
     */
    public function isDevEnvironment() {
        if ($this->Container->hasParameter('app_dev_environments')) {
            $dev_array = $this->Container->getParameter('app_dev_environments');
        } else {
            $dev_array = array('dev', 'mtl', 'mtl_oracle1', 'mtl_oracle2');
        }

        $current_env = $this->Container->get('kernel')->getEnvironment();
        $result = false;

        if (in_array($current_env, $dev_array)) {
            $result = true;
        }

        return $result;
    }

    public function getFormChangedData($form, $originalData, $requestData) {
        $changedData = array();
        foreach ($originalData as $key => $value) {
            if (array_key_exists($key, $requestData)) {
                if ($requestData[$key] != $value) {
                    $changedData[$key] = array(
                        //$this->Container->get('eserv_translation_services')->eservCustomTranslator($form[$key]->getConfig()->getOption("label")), $value, $requestData[$key]
                        $this->Container->get('translator')->trans($form[$key]->getConfig()->getOption("label")), $value, $requestData[$key]
                    );
                }
            }
        }
        return $changedData;
    }

    public function addFormFieldLabels($form, $formData, $emptyRecord = false) {
        $newData = array();
        foreach ($formData as $key => $value) {
            if (($emptyRecord == false && $value != '') || ($emptyRecord == true)) {
                $newData[$key] = array(
                    $this->Container->get('eserv_translation_services')->eservCustomTranslator($form[$key]->getConfig()->getOption("label")), $value
//                     $this->Container->get('translator')->trans($form[$key]->getConfig()->getOption("label")), $value
                );
            }
        }
        return $newData;
    }

    function getValueFromArrayOfObject($key, $array) {
        $result = array();
        if (is_array($array)) {
            foreach ($array as $k1 => $v1) {
                if ($k1 === $key) {
                    $result = $v1;
                    break;
                } else {
                    if (is_array($v1)) {
                        foreach ($v1 as $k2 => $v2) {
                            if ($k2 === $key) {
                                $result = $v2;
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function getNewApplicationId($session_name, $restart = false) {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();

        if ($restart) {
            $this->removeSessionVariable($session_name);
        }

        $application_id = uniqid();
        $session->set($session_name, $application_id);
        return $application_id;
    }

    public function getCurrentApplicationId($session_name) {
        $request = $this->Request;
        $session = $request->getSession();
        $app_id = $session->get($session_name);
        return $app_id;
    }

    public function removeSessionVariable($sessionVariable) {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $session->remove($sessionVariable);
    }

    public function checkApplicationExists($application_name, $entity_manager = false, $step = null, $is_thank_you_page = false, $app_id = false) {
        if (!$app_id) {
            $application_id = $this->getCurrentApplicationId($application_name);
            $check = $this->EntityManager->getRepository('ESERVMAINWizardBundle:WzControl')
                    ->findOneBy(array('applicationId' => $application_id));
        } else {
            $check = $this->EntityManager->getRepository('ESERVMAINWizardBundle:WzControl')
                    ->findOneBy(array('applicationId' => $app_id));
        }


        if (!$check) {
            throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Application is not valid!');
        }

//        if (null !== $check->getDateCompleted() && !$is_thank_you_page) {
//            throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Application has already been submitted!');
//        }

        if (!is_null($step)) {
            $completed = $this->checkPreviousStepCompleted($this->EntityManager, $check->getId(), $step);

            if (!$completed) {
                throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException();
            }
        }
    }

    /**
     * Return true if previous step is completed & flase otherwise.
     */
    private function checkPreviousStepCompleted($entity_manager, $wz_ctrl_id, $current_step) {
        $status = true;

        if ($current_step > 1) {
            $previous_step = $current_step - 1;

            $entity_data = $entity_manager->getRepository('ESERVMAINWizardBundle:WzPage')
                    ->findOneBy(array(
                'wzControl' => $wz_ctrl_id,
                'pageNo' => $previous_step
            ));
            $previous_step_completed = $entity_data ? $entity_data->getCompleted() : null;

            if ($previous_step_completed == 'Y') {
                $status = true;
            } else {
                $status = false;
            }
        }

        return $status;
    }

    public function replaceBasedOnValues($val, $col_type) {
        $typedParam = '';
        switch ($col_type) {
            case 'VARCHAR2' : $typedParam = "'$val'";
                break;
            case 'NUMBER' : $typedParam = "$val";
                break;
            case 'DATE' : $typedParam = "'$val'";
                break;
            case 'LIKE' : $typedParam = "$val";
                break;
            default: $typedParam = "'$val'";
                break;
        }

        return $typedParam;
    }
    
    public function formatValueBasedOnClass($value, $cssClass){
        $result = $value;
        $cssClassLower = strtolower($cssClass);
        $classes = explode(' ', $cssClassLower);
        foreach ($classes as $k1 => $class){
            switch ($class) {
                case 'amount':
                    if(is_numeric($value)){
                       $result = number_format((float)$value, 2, '.', ',');
                    } else{
                        $result = '0.00';
                    }
                    break;
                case 'upper':
                    $result = strtoupper($value);
                    break;
                case 'lower':
                    $result = strtolower($value);
                    break;
                default:
                    $result = $value;
                    break;
            }
        } 
        return $result;
    }
    
    public function customFormInvalidMessage($errors_array)
    {
        $output = '';
        
        $tmp = '<ul>';
        foreach($errors_array as $k => $v){
          $tmp .= '<li>'.(array_key_exists('message', $v) ? (is_array($v['message']) ? json_encode($v['message']) : $v['message']) : json_encode($v)).'</li>';
          $tmp = str_replace('{', ' ', str_replace('}', ' ', $tmp));
          $tmp = str_replace('"', ' ', $tmp);
        }
        $tmp .= '</ul>';
        $output = "Form is invalid. Please check the errors below. <br/></br> $tmp";
        
        return $output;
    }
    
}
