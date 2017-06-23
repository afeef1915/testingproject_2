<?php

namespace ESERV\MAIN\ProductBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;

class ESERVTransactionServices extends Controller
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

    public function createTransaction($data, Request $request)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->em;

        try {
            $em->getConnection()->beginTransaction();
            
            $transaction = new \ESERV\MAIN\ProductBundle\Entity\Transaction();
            $transaction->setContact($data['transaction']['contact']);
            $transaction->setCredit($data['transaction']['credit']);
            $transaction->setDebit($data['transaction']['debit']);
            $transaction->setTransactionOrigin($data['transaction']['transaction_origin']);
            $transaction->setPaymentMethod($data['transaction']['payment_method']);
            
            if(array_key_exists('date_processed', $data['transaction'])){
                $transaction->setDateProcessed($data['transaction']['date_processed']);
            }
            if(array_key_exists('comments', $data['transaction'])){
                $transaction->setComments($data['transaction']['comments']);
            }
            
            $em->persist($transaction);
            $em->flush();
            
            $transaction_detail = new \ESERV\MAIN\ProductBundle\Entity\TransactionDetail();
            $transaction_detail->setTransaction($transaction);
            $transaction_detail->setLineNo($data['transaction_detail']['line_no']);
            $transaction_detail->setFund($data['transaction_detail']['fund']);
            $transaction_detail->setCredit($data['transaction_detail']['credit']);
            $transaction_detail->setDebit($data['transaction_detail']['debit']);
            $transaction_detail->setTransactionType($data['transaction_detail']['transaction_type']);
            $transaction_detail->setPeriodStartDate($data['transaction_detail']['period_start_date']);
            $transaction_detail->setPeriodEndDate($data['transaction_detail']['period_end_date']);
            
            if(array_key_exists('entity_name', $data['transaction_detail'])){
                $transaction_detail->setEntityName($data['transaction_detail']['entity_name']);
            }
            if(array_key_exists('entity_id', $data['transaction_detail'])){
                $transaction_detail->setEntityId($data['transaction_detail']['entity_id']);
            }
            if(array_key_exists('workplace', $data['transaction_detail'])){
                $transaction_detail->setWorkplace($data['transaction_detail']['workplace']);
            }
            
            $em->persist($transaction_detail);
            $em->flush();
            $em->commit();
            $status = true;
            $message = 'Transaction has been successfully completed.';
            
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();            
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
       
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }        
    }
       
}
