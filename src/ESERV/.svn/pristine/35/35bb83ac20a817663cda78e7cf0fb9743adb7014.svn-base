<?php

namespace ESERV\MAIN\ExternalBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\AppConstants;

class ExternalBundleService extends Controller
{

    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
        $this->dbCore = $this->c->get('db_core_function_services');
    }

    public function executeProcedure($process_data)
    {
        $type = $process_data['queued_db_process']['type'];
        
        switch($type){
            case 'IMPORT_FILES': 
                echo 'Successfully came here';die;
                break;
            case 'EXPORT_FILES': 
                
                break;
            case 'SEND_EMAILS': 
                
                break;
            case 'MERGE_LETTER':
                $func_call = $this->MERGE_LETTER($process_data);
                $msg = $func_call['msg'];
                $status = $func_call['status'];
                $extra_params = $func_call['extra_params'];                
                break;
            default:
                echo 'Unsupported procedure type';
        }

        $result = array(
            'status' => TRUE,
            'msg' => ''
        );
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($result));
        return $response;
    }

    public function MERGE_LETTER($data)
    {
//        $this->dbCore->logit('MERGE_LETTER start');
        $status = false;
        $msg = '';
        $extra_params = '';
        
        $qdb_id = $data['queued_db_process']['id'];
        
        $comm_services = new \ESERV\MAIN\CommunicationsBundle\Services\ESERVMAINCommunicationsProcesses($this->em, $this->c);        ;
        $type = $data['queued_db_process']['type'];
        switch ($type) {
            case AppConstants::ESERV_MERGE_LETTER:
//$this->dbCore->logit('MERGE_LETTER ' . AppConstants::ESERV_MERGE_LETTER);
                $id = $data['queued_db_process_vars']['id']['field_value'];
                $result_arr = $comm_services->MergeLetters($id);
                break;                
            case AppConstants::ESERV_OP_DOC_LET_GROUPS:
//$this->dbCore->logit('MERGE_LETTER ' . AppConstants::ESERV_OP_DOC_LET_GROUPS);                
                $result_arr = $comm_services->MergeLetter($data['queued_db_process_vars']['documentJobId']['field_value']);
                break;
            default:
                $result_arr['success'] = FALSE;
                $result_arr['msg'] = sprintf('Unknown type (%s)', $type);
        }
        
        $status = $result_arr['success'];
        $msg = $result_arr['msg'];

        $result = array(
            'status' => $status,
            'msg' => $msg,
            'extra_params' => $extra_params
        );
        
        return $result;
    }
    
    public function SEND_EMAIL($data)
    {
        $status = false;
        $msg = '';
        $extra_params = '';
        
        $qdb_id = $data['queued_db_process']['id'];
        
        $comm_services = new \ESERV\MAIN\CommunicationsBundle\Services\ESERVMAINCommunicationsProcesses($this->em, $this->c);
        $id = $data['queued_db_process_vars']['id']['field_value'];
        $result_arr = $comm_services->SendEmailProcess($id);
        $status = $result_arr['success'];
        $msg = $result_arr['msg'];

        $result = array(
            'status' => $status,
            'msg' => $msg,
            'extra_params' => $extra_params
        );
        
        return $result;
    }
}
