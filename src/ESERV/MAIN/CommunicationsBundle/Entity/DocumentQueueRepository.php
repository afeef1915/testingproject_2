<?php
            
/*
    This file has been generated using MTL ESERV:BUILD command. Contact Anjana on anjana@millertech.co.uk for more
    information. Thanks.
*/

namespace ESERV\MAIN\CommunicationsBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DocumentQueueRepository extends EntityRepository
{
    const REPOSITORY_NAME = 'DocumentQueueRepository';
    
    public function deleteDocumentQueueByActivityId(
        $activity_id_arr
       ,$insert_mtl_error = TRUE
    ) {    
        try {
            if (count($activity_id_arr) > 0) {
                $del = $this->getEntityManager()
                            ->createQueryBuilder()
                            ->delete('ESERVMAINCommunicationsBundle:DocumentQueue', 'dq')
                            ->where('dq.activity IN (:activity_ids)')
                            ->setParameter('activity_ids', array_values($activity_id_arr))
                            ->getQuery();
                $del->execute();
            }
            
            $success = TRUE;
            $message = NULL;            
        } catch (\Exception $ex) {
            $function = 'deleteDocumentQueueByActivityId';
            
            if ($insert_mtl_error === TRUE) { 
                $message = sprintf(
                               '$activity_id_arr: array(%s), Exception: %s'
                              ,implode(',', $activity_id_arr)
                              ,$ex->getMessage()
                           );
                $this->c->get('db_core_function_services')
                        ->insertMtlError(
                              ($function . '(' . self::REPOSITORY_NAME. ')')
                             ,$message
                          );
            } else {
                $message = sprintf(
                               $function . 
                               ' $activity_id_arr: array(%s) (%s), ' . 
                               'Exception: %s'
                              ,implode(',', $activity_id_arr)
                              ,self::REPOSITORY_NAME
                              ,$ex->getMessage()
                           );
            }
            $success = FALSE;
        }
        $result_arr = array(
            'success' => $success,
            'msg' => $message
        );        
        
        return $result_arr;
    } #deleteDocumentQueueByActivityId end
    
    public function createDocumentQueue(
        $em
       ,$activity
       ,$date_requested
    ) {
        $document_queue = new \ESERV\MAIN\CommunicationsBundle\Entity\DocumentQueue();
        if (!($activity instanceof \ESERV\MAIN\ActivityBundle\Entity\Activity)) {
            $activity = $em->getReference('ESERV\MAIN\ActivityBundle\Entity\Activity', $activity);                        
        }
        $document_queue->setActivity($activity);
        if (is_null($date_requested)) {
            $date_requested = new \DateTime();
        }
        $document_queue->setDateRequested($date_requested);        
        $em->persist($document_queue);
        $em->flush();

        return $document_queue;
    } #createDocumentQueue end    
}