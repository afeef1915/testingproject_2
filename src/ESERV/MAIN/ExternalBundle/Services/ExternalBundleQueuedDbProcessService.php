<?php

namespace ESERV\MAIN\ExternalBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ExternalBundleQueuedDbProcessService extends Controller
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
    
    public function getUnprocessedItems( $options = array(
                'items_per_batch' => null,
                'maximum_attempts' => null,
                'qdb_type_like' => 'ESERV_' ,
    //            'qdb_type_not_like' => null
            ))            
    {   
        $items_per_batch = is_null($options['items_per_batch']) ? $this->c->getParameter('items_per_batch') : $options['items_per_batch'];
        $maximum_attempts = is_null($options['maximum_attempts']) ? $this->c->getParameter('maximum_attempts') : $options['maximum_attempts'];
        
        $qb1 = $this->em->createQueryBuilder();
        $result1 = $qb1->select('p.id')
                ->from('ESERVMAINExternalBundle:QueuedDbProcess', 'p')
                ->where('p.processed <> :processed')
                ->setParameter('processed', 'Y')
                ->andWhere('p.attempts <= :attempts')
                ->setParameter('attempts', $maximum_attempts);
        
//                if(!is_null($options['qdb_type_not_like'])){
//                    $val = $options['qdb_type_not_like']; 
//                    $qb->andWhere($alias.'.type NOT LIKE :qdb_type')
//                     ->setParameter('qdb_type', "%$val%"); 
//                }
                if($options['qdb_type_like'] && !is_null($options['qdb_type_like'])){
                    $val = $options['qdb_type_like'];
                    $size = strlen($val);
                    $qb1->andWhere($qb1->expr()->eq($qb1->expr()->substring('p.type', 1, $size), ':qdb_type'))
                        ->setParameter('qdb_type', $val); 
                } 
        
        $qb1->orderBy('p.id', 'ASC')
            ->setMaxResults($items_per_batch)
            ->getQuery();
        
        $entity_id1 = $this->coreF->GetOutputFormat($result1->getQuery(), 'array');
        return $entity_id1;
    }
    
    public function increaseAttemptsByOne($id, $em)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';

        try {

            $qdb_process = $this->em->getRepository('ESERVMAINExternalBundle:QueuedDbProcess')
                ->find($id);
            if($qdb_process){
                $attempts = $qdb_process->getAttempts();
                $qdb_process->setAttempts($attempts+1);
                
                $em->persist($qdb_process);

                $status = true;
                $message = 'Success';
            }else{
                $status = false;
                $message = 'Cannot find the record for the given id '.$id; 
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        
        
        return $result;       
    }
    
    public function getInfo($id)
    {
        $qb1 = $this->em->createQueryBuilder();
        $result = $qb1->select('p.name, p.createdBy')
                ->from('ESERVMAINExternalBundle:QueuedDbProcess', 'p')
                ->where('p.id = :id')
                ->setParameter('id', $id)
                ->andWhere('p.createdBy is NOT NULL')
                ->getQuery();
        
        $result1 = $this->coreF->GetOutputFormat($result, 'array');

        $result_arr = array(
          'name' => $result1[0]['name'],
          'createdBy' => $result1[0]['createdBy'],
        );
        
        return $result_arr;
    }
    
    public function getSingleRecord($id)
    {
        $qdb_process = $this->em->getRepository('ESERVMAINExternalBundle:QueuedDbProcess')
                ->find($id);
        if($qdb_process){
            return $qdb_process;            
        }else{
            return '';
        }
    }
    
    public function setProcessedToY($id, $em)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';

        try {

            $qdb_process = $this->em->getRepository('ESERVMAINExternalBundle:QueuedDbProcess')
                ->find($id);
            if($qdb_process){                
                $qdb_process->setProcessed('Y');
                
                $em->persist($qdb_process);

                $status = true;
                $message = 'Success';
            }else{
                $status = false;
                $message = 'Cannot find the record for the given id '.$id; 
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        
        
        return $result;       
    }
    
    public function setProcessedToN($id, $em)
    {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';

        try {

            $qdb_process = $this->em->getRepository('ESERVMAINExternalBundle:QueuedDbProcess')->find($id);
            if ($qdb_process) {
                $qdb_process->setProcessed('N');
                
                $em->persist($qdb_process);

                $status = true;
                $message = 'Success';
            } else {
                $status = false;
                $message = 'Cannot find the record for the given id ' . $id;
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
        }
        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        
        return $result;       
    } #setProcessedToN
            
    public function ListAllQueuedDbRecords($type = 'doctrine', $alias = 'p', $query_only = false, $options = array(
            'items_per_batch' => null,
            'maximum_attempts' => null,
            'qdb_type_like' => 'ESERV_' ,
//            'qdb_type_not_like' => null
          )) 
    {
        $qb = $this->em->createQueryBuilder();
        
        $items_per_batch = is_null($options['items_per_batch']) ? $this->c->getParameter('items_per_batch') : $options['items_per_batch'];
        $maximum_attempts = is_null($options['maximum_attempts']) ? $this->c->getParameter('maximum_attempts') : $options['maximum_attempts'];

        $result = $qb->select($alias.'.queuedDbProcessId',$alias.'.fieldName',$alias.'.fieldValue',
                            $alias.'.queuedDbProcessVarId', $alias.'.fieldParamExt', $alias.'.fieldParamType',
                            $alias.'.fieldParamSize',$alias.'.fosUserId',$alias.'.name',$alias.'.type',
                            $alias.'.description', $alias.'.notificationPriority')
                        ->from('ESERVMAINExternalBundle:EservVQueuedDbProcess', $alias)
//                        ->where($alias.'.processed <> :processed')
//                        ->setParameter('processed', 'Y')
                        ->where($alias.'.processed = :processed')
                        ->setParameter('processed', 'N')
                        ->andWhere($alias.'.createdBy is NOT NULL')
                        ->orderBy($alias.'.queuedDbProcessId', 'ASC')
                        ->andWhere($alias.'.attempts <= :attempts')
                        ->setParameter('attempts', $maximum_attempts);
                
//                if(!is_null($options['qdb_type_not_like'])){
//                    $val = $options['qdb_type_not_like']; 
//                    $qb->andWhere($alias.'.type NOT LIKE :qdb_type')
//                     ->setParameter('qdb_type', "%$val%"); 
//                }
                if($options['qdb_type_like'] && !is_null($options['qdb_type_like'])){
                    $val = $options['qdb_type_like'];
                    $size = strlen($val);
                    $qb->andWhere($qb->expr()->eq($qb->expr()->substring($alias.'.type', 1, $size), ':qdb_type'))
                        ->setParameter('qdb_type', $val); 
                }                    
                
                $qb->orderBy($alias.'.queuedDbProcessId', 'ASC')
                    ->setMaxResults($items_per_batch)
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Help Messages found-- Function "ListQueuedDbRecords"'
            );
        } else {
            if (!$query_only) {
                return $this->coreF->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function formatQueuedDbProcessList($type = 'array', $alias = 'p', $query_only = false, $options = array())
    {
        $default_array = $this->ListAllQueuedDbRecords($type, $alias, $query_only, $options);
        $qdb_ids_array = array();        
        $qdb_process_vars_array = array();
        
        $final_results_array = array();
        
        foreach($default_array as $a){
            array_push($qdb_ids_array, $a['queuedDbProcessId']);
        }
        
        $qdb_ids_array = array_values(array_unique($qdb_ids_array));        
        
        foreach ($qdb_ids_array as $k=>$c){
            $elem = array();
            $qdb_process_array = array();
            foreach($default_array as $a){
                if($c == $a['queuedDbProcessId']){
                    $elem[$a['fieldName']] = array(
                        'id' => $a['queuedDbProcessVarId'],
                        'field_value' => $a['fieldValue'],
                        'field_param_ext' => $a['fieldParamExt'],
                        'field_param_type' => $a['fieldParamType'],
                        'field_param_size' => $a['fieldParamSize']
                    );
                    
                    //following array does not need to be assigned more than once.
                    //because inside this loop following results won't change.
                    //so the following array assignment NEEDS TO BE OPTIMIZED
                    $qdb_process_array = array(
                        'id' => $c,
                        'fos_user_id' => $a['fosUserId'],
                        'name' => $a['name'],
                        'type' => $a['type'],
                        'description' => $a['description'],
                        'notification_priority' => $a['notificationPriority']
                    );
                }
            }                 
            
            //$c is the queued_db_process_id
            $qdb_process_vars_array[$c] = array(
                'queued_db_process' => $qdb_process_array,
                'queued_db_process_vars' => $elem
            );
        }
       
        return $qdb_process_vars_array;
    }
    
    /*
     * Creates a record in the QueuedDbProcess and reocrds (if there's any) in QueuedDbProcessVars.
     * Returns QueuedDbProcessId 
     */
    public function createQueuedDbRecord($data, $process_vars)
    {
        if(is_array($data)){
            $name = $data['name'];
            $description = $data['description'];
            $notif_pri = $data['notif_priority'];
            $type = $data['type'];
            $processed = 'N';
            if (array_key_exists('processed', $data)) {
                $processed = $data['processed'];
            }            
            $queued_db_process = new \ESERV\MAIN\ExternalBundle\Entity\QueuedDbProcess();
//            $queued_db_process->setFosUser($this->c->get('security.context')->getToken()->getUser());
            $queued_db_process->setFosUser($this->c->get('security_services')->getLoggedInUser());
            $queued_db_process->setName($name);
            $queued_db_process->setDescription($description);
            #$queued_db_process->setProcessed('N');
            $queued_db_process->setProcessed($processed);
            $queued_db_process->setAttempts('0');
            $queued_db_process->setType($type);
            $queued_db_process->setNotificationPriority($notif_pri);

            $this->em->persist($queued_db_process);
            $this->em->flush($queued_db_process);

            if(is_array($process_vars) && count($process_vars) > 0){
                
                foreach($process_vars as $k => $v){
                    $queued_db_process_var = new \ESERV\MAIN\ExternalBundle\Entity\QueuedDbProcessVar();
                    $queued_db_process_var->setQueuedDbProcess($queued_db_process);
                    $queued_db_process_var->setFieldName($k);
                    $queued_db_process_var->setFieldValue($v['value']);
                    $queued_db_process_var->setFieldParamExt($v['param_ext']);
                    $queued_db_process_var->setFieldParamType($v['param_type']);
                    $queued_db_process_var->setFieldParamSize($v['param_size']);
                    
                    $this->em->persist($queued_db_process_var);
                    $this->em->flush($queued_db_process_var);
                }
            }
            
            return $queued_db_process->getId();
        }else{
            throw new \Exception('Queued DB Proccess Data needs to be an array', 500);
        }
        
    }
    
    public function checkProcessing($id) {
        $status = false;
        $result = array();
        #$errors_array = array();
        $message = '';
        
        try {
            $qdb_process = $this->em
                                ->getRepository('ESERVMAINExternalBundle:QueuedDbProcess')
                                ->find($id);
            if ($qdb_process) {
                $processed = $qdb_process->getProcessed();
                if ($processed == 'N') {
                    $qdb_process->setProcessed('P');
                    $this->em->persist($qdb_process);
                    $this->em->flush();
                    $status = true;
                    $message = 'Success';
                } else {
                    $status = false;
                    $message = sprintf('Queued DB Process ID (%s) already processed or is being processed', $id);
                }
            } else {
                $status = false;
                $message = sprintf('Cannot find the record for the given Queued DB Process ID %s', $id); 
            }            
        } catch (\Exception $e) {
            $status = false;
            $message = sprintf('Queued DB Process ID (%s) exception: %s', $id, $e->getMessage()); 
        }        
        $result = array(
            'success' => $status,
            'msg' => $message,
            #'errors' => $errors_array,
        );
        
        return $result;               
    } #checkProcessing
    

}
