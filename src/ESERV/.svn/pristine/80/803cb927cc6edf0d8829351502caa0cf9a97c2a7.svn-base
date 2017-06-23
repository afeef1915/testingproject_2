<?php

namespace ESERV\MAIN\ExternalBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\ExternalBundle\Services\MerlinAPIConstants;

class MerlinAPIFunctions {

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

    public function uploadFile($query_params = array()) {
        $status = false;
        $msg = '';
        $error_type = '';
        $errors = array();
        $contents = array();
        $result = array();

        try {
            $msg = 'File successfully uploaded!';
            $status = true;
        } catch (\Exception $ex) {
            $error_type = MerlinAPIConstants::AUDIT_ERROR_TYPE_EXCEPTION_CODE;
            $error = 'Error ' . $ex->getCode() . ': ' . $ex->getMessage();
            $msg = 'An error occurred!';
            array_push($errors, $error);
        }

        $result = array(
            'status' => $status,
            'msg' => $msg,
            'error_type' => $error_type,
            'errors' => $errors,
            'contents' => $contents,
        );

        return $result;
    }

    public function retrieveFile($query_params = array()) {
        $status = false;
        $msg = '';
        $error_type = '';
        $errors = array();
        $contents = array();
        $result = array();

        try {
            $msg = 'File successfully retrieved!';
            $status = true;
        } catch (\Exception $ex) {
            $error_type = MerlinAPIConstants::AUDIT_ERROR_TYPE_EXCEPTION_CODE;
            $error = 'Error ' . $ex->getCode() . ': ' . $ex->getMessage();
            $msg = 'An error occurred!';
            array_push($errors, $error);
        }

        $result = array(
            'status' => $status,
            'msg' => $msg,
            'error_type' => $error_type,
            'errors' => $errors,
            'contents' => $contents,
        );

        return $result;
    }   
}
