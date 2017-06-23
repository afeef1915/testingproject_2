<?php

namespace ESERV\MAIN\HelpersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ESERVMAINHelpersBundle:Default:index.html.twig', array('name' => $name));
    }

    public function postcodeLookupAction(Request $request) {
        if (isset($request)) {

            $method = 'POST';

            $afd_params = $this->container->getParameter('afd');

            $action = $afd_params['url'] . $afd_params['functions']['postcode_lookup'];

            $postcode = $request->query->get('postcode');

            $required_fields = array(
                'action' => $action,
                'serial' => $afd_params['serial'],
                'password' => $afd_params['password'],
                'postcode' => $postcode,
                'token' => time(),
            );
            
            $options = array();
            
            if (isset($afd_params['proxy'])) {
                $options['proxy']['port'] = $afd_params['proxy']['port'];
                $options['proxy']['ip'] = $afd_params['proxy']['ip'];
            }

            $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields, false, $options);

            header("Content-Type: application/xml; charset=utf-8");

            echo $result;
            die;
        } else {
            die('You cannot access this page directly!');
        }
    }

    public function postcodeAddressDetailsAction(Request $request) {
        if (isset($request)) {

            $method = 'GET';

            $afd_params = $this->container->getParameter('afd');

            $action = $afd_params['url'] . $afd_params['functions']['address_lookup'];

            $postcode = $request->query->get('postcode');
            $postKey = $request->query->get('postkey');

            $required_fields = array(
                'action' => $action,
                'serial' => $afd_params['serial'],
                'password' => $afd_params['password'],
                'postcode' => $postcode,
                'postkey' => $postKey,
                'token' => time(),
            );
            
            $options = array();
            
            if (isset($afd_params['proxy'])) {
                $options['proxy']['port'] = $afd_params['proxy']['port'];
                $options['proxy']['ip'] = $afd_params['proxy']['ip'];
            }

            $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields, false, $options);

            header("Content-Type: application/xml; charset=utf-8");

            echo $result;
            die;
        } else {
            die('You cannot access this page directly!');
        }
    }

    public function validateBankAccountAction(Request $request) {

        if (isset($request)) {

            $method = 'POST';

            $bank_name = '';
            $items = '';
            $error = 'An error has occurred';
            $status = false;

            $afd_params = $this->container->getParameter('afd');

            $action = $afd_params['url'] . $afd_params['functions']['bank_validate_account'];

            $ac_name = $request->get('ac_name');
            $ac_no = $request->get('ac_no');
            $ac_sc = $request->get('ac_sc');

            if (($ac_name !== '') && ($ac_no !== '') && ($ac_sc !== '')) {
                $required_fields = array(
                    'action' => $action,
                    'serial' => $afd_params['serial'],
                    'password' => $afd_params['password'],
                    'sortcode' => $ac_sc,
                    'accountnumber' => $ac_no,
                    'token' => time(),
                );

                $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields);

                $xml = simplexml_load_string($result);

                $json = json_encode($xml);
                $array = json_decode($json, TRUE);

                $account_valid = $array['Validation']['Result'] === '0' ? true : false;

                if ($account_valid) {

                    $action = $afd_params['url'] . $afd_params['functions']['bank_search'];

                    $required_fields = array(
                        'action' => $action,
                        'serial' => $afd_params['serial'],
                        'password' => $afd_params['password'],
                        'sortcode' => $ac_sc,
                        'token' => time(),
                    );

                    $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields);

                    $xml = simplexml_load_string($result);

                    $json = json_encode($xml);
                    $array = json_decode($json, TRUE);

                    if (isset($array['BankListItem'][0]) && is_array($array['BankListItem'][0])) {
                        $items = array();
                        foreach ($array['BankListItem'] as $key => $value) {
                            $items[$value['RecordNo']] = $this->get('bank_helper')->cleanBankName($value['Bank'], $ac_sc);
                        }
                        $status = false;
                        $error = 'Duplicate!';
                    } else {
                        $BankListItem = $array['BankListItem'];
                        $Bank = $BankListItem['Bank'];
                        $RecordNo = $BankListItem['RecordNo'];

                        $action = $afd_params['url'] . $afd_params['functions']['bank_lookup'];

                        $required_fields = array(
                            'action' => $action,
                            'serial' => $afd_params['serial'],
                            'password' => $afd_params['password'],
                            'bankrecord' => $RecordNo,
                            'token' => time(),
                        );

                        $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields);

                        $xml = simplexml_load_string($result);

                        $json = json_encode($xml);
                        $array = json_decode($json, TRUE);

                        $this->saveToJolPage3($array, $request);

                        $BACSAllowedDirectDebits = $array['BankDetails']['BACSAllowedDirectDebits'];

                        if ($BACSAllowedDirectDebits === '1') {
                            $status = true;
                            $bank_name = $this->get('bank_helper')->cleanBankName($Bank, $ac_sc);
                        } else {
                            $status = false;
                            $bank_name = '';
                        }
                    }

                    $the_result = array(
                        'success' => $status,
                        'bank_name' => $bank_name,
                        'items' => $items,
                        'error' => $error
                    );
                    if ($status) {
                        $the_result['error'] = 'Account does not allow Direct Debit';
                    }
                } else {
                    $the_result = array(
                        'success' => false,
                        'error' => 'Invalid Account'
                    );
                }
            } else {
                $the_result = array(
                    'success' => false,
                    'error' => 'Incorrect Details'
                );
            }

            $response = new Response(json_encode($the_result));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } else {
            die('You cannot access this page directly!');
        }
    }

    protected function getBottmlineUKAddresses(Request $request, $array = false) {
        $method = 'GET';

        $bottom_line_params = $this->container->getParameter('bottom_line');

        $action = $bottom_line_params['url'] . $bottom_line_params['functions']['getukaddresses'];

        $result_only = $request->get('result_only');

        $HouseNameOrNumber = $request->get('HouseNameOrNumber');
        $Street1 = $request->get('Street1', null);
        $Street2 = $request->get('Street2', null);
        $District = $request->get('District', null);
        $Town = $request->get('Town', null);
        $County = $request->get('County', null);
        $Postcode = $request->get('Postcode', null);

        $required_fields = array(
            'apikey' => $bottom_line_params['key'],
            'HouseNameOrNumber' => $HouseNameOrNumber,
            'Street1' => $Street1,
            'Street2' => $Street2,
            'District' => $District,
            'Town' => $Town,
            'County' => $County,
            'Postcode' => $Postcode,
        );

        $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields, true);

        if ($array) {
            return json_decode($result);
        } else {
            return $result;
        }
    }

    protected function bottmlineValidateUKBankAccount(Request $request, $array = false) {
        $method = 'GET';

        $bottom_line_params = $this->container->getParameter('bottom_line');

        $action = $bottom_line_params['url'] . $bottom_line_params['functions']['validateukbankaccount'];

        $required_fields = array(
            'apikey' => $bottom_line_params['key'],
            'sortCode' => $request->get('sortCode', null),
            'accountNumber' => $request->get('accountNumber', null),
        );

        $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields, true);

        if ($array) {
            return json_decode($result);
        } else {
            return $result;
        }
    }

    public function getUKAddressesAction(Request $request) {
        if (isset($request)) {
            $result = $this->getBottmlineUKAddresses($request);

            header("Content-Type: application/json");

            echo $result;
            die;
        } else {
            die('You cannot access this page directly!');
        }
    }

    public function validateUKBankAccountAction(Request $request) {
        if (isset($request)) {
            $result = $this->bottmlineValidateUKBankAccount($request);

            header("Content-Type: application/json");

            echo $result;
            die;
        } else {
            die('You cannot access this page directly!');
        }
    }

    public function validateUKBankAccountAndAddressAction(Request $request) {
        if (isset($request)) {
            $bank_result = $this->bottmlineValidateUKBankAccount($request, true);
            $address_result = $this->getBottmlineUKAddresses($request, true);

            $result = array(
                'bank_result' => $bank_result,
                'address_result' => $address_result,
            );

            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            die('You cannot access this page directly!');
        }
    }

    public function verifyUKAccountOwnershipWithAddressesAction(Request $request) {
        if (isset($request)) {

            $status = false;
            $message = 'No Match!';
            $codes = array(
                'address' => '',
                'bank' => '',
            );

            $method = 'GET';

            $bottom_line_params = $this->container->getParameter('bottom_line');

            $action = $bottom_line_params['url'] . $bottom_line_params['functions']['verifyukaccountownershipwithaddresses'];

            $add_result = $this->getBottmlineUKAddresses($request, true);

            if (isset($add_result[0]) && !is_null($add_result[0]->AddressKey)) {
                $codes['address'] = 'OK';
                $bank_result = $this->bottmlineValidateUKBankAccount($request, true);

                if ($bank_result->Valid) {

                    $codes['bank'] = 'OK';

                    $sortCode = $request->get('sortCode');
                    $accountNumber = $request->get('accountNumber');
                    $title = $request->get('title');
                    $forename = $request->get('forename');
                    $middlename = $request->get('middlename');
                    $surname = $request->get('surname');
                    $dob = $request->get('dob');

                    $currentAddress_arr = array(
                        'HouseNumberOrName' => $add_result[0]->HouseNumberOrName,
                        'Street1' => $add_result[0]->Street1,
                        'Street2' => $add_result[0]->Street2,
                        'District' => $add_result[0]->District,
                        'Town' => $add_result[0]->Town,
                        'County' => $add_result[0]->County,
                        'Postcode' => $add_result[0]->Postcode,
                    );

                    $required_fields = array(
                        'apikey' => $bottom_line_params['key'],
                        'sortCode' => $sortCode,
                        'accountNumber' => $accountNumber,
                        'title' => $title,
                        'forename' => $forename,
                        'middlename' => $middlename,
                        'surname' => $surname,
                        'dob' => $dob,
                        'CurrentAddress' => (json_encode($currentAddress_arr)),
                        'previousAddress' => '',
                    );

                    $result = $this->container->get('core_function_services')->getCurlContents($action, $method, $required_fields, true);

                    $obj = json_decode($result);

                    $codes = $obj;

                    if ($obj->CurrentAddress->SortCodeDataStatus == 9 && $obj->CurrentAddress->AccountNumberDataStatus == 9 && $obj->CurrentAddress->RecommendedStatus == 6) {
                        $status = true;
                        $message = 'Successfull';
                    }
                }
            }

            $the_result = array(
                'success' => $status,
                'error' => $message,
                'codes' => $codes
            );

            if ($request->isXmlHttpRequest()) {
                $response = new Response(json_encode($the_result));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            } else {
                die('You cannot access this page directly!');
            }
        } else {
            die('You cannot access this page directly!');
        }
    }

}
