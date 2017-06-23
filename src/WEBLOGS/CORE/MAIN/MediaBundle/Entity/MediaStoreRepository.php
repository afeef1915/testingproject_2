<?php

namespace WEBLOGS\CORE\MAIN\MediaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MediaStoreRepository extends EntityRepository
{   
    const REPOSITORY_NAME = 'MediaStoreRepository';

    public function updateById(
        $media_store_id_arr
       ,$entity_id = NULL
       ,$entity_name = NULL
    ) {
        $count_id = count($media_store_id_arr); #print(sprintf('$media_store_id_arr(%s), $entity_id: %s, $entity_name: %s', implode(',', $media_store_id_arr), $entity_id, $entity_name));
        if ($count_id > 0) {
            $qb = $this->getEntityManager()->createQueryBuilder();
            $upd = $qb->update('MERLINORACOREMAINMediaBundle:MediaStore', 'ms');
            if (!(is_null($entity_id))) {
                $upd->set('ms.entityId', $entity_id);
            }
            if (!(is_null($entity_name))) {
                #$upd->set('ms.entityName', $entity_name); #not sure why this is not working (Guy)
                #$upd->set('ms.entityName', $qb->expr()->eq('ms.entityName', "'" . $entity_name . "'")); 
                $upd->set('ms.entityName', "'" . $entity_name . "'"); #in the end had to add quotes to make it a string (Guy)
            }            
            if ($count_id == 1) {
                $upd->where('ms.id = :ids')
                    ->setParameter('ids', array_values($media_store_id_arr));                
            } else {
                $upd->where('ms.id IN (:ids)')
                    ->setParameter('ids', array_values($media_store_id_arr));
            }
            $upd->getQuery()->execute();
        }
        
        return TRUE;
    } #updateById end

    public function getByEntityIdAndEntityName($entity_id, $entity_name) {
        $query = $this->createQueryBuilder('ms')
                      ->where('ms.entityId = :EntityId')
                      ->setParameter('EntityId', $entity_id)
                      ->andWhere('ms.entityName = :EntityName')
                      ->setParameter('EntityName', $entity_name)
                      ->getQuery();
//        print($query->getDQL()); die;
        $result = $query->execute();
        
        return $result;
    } #getByEntityIdAndEntityName end
    
    public function getById($id) {
        if (is_array($id)) {
            $query = $this->createQueryBuilder('ms')
                          ->where('ms.id IN (:media_store_id)')
                          ->setParameter('media_store_id', array_values($id))
                          ->getQuery();            
        } else {
            $query = $this->createQueryBuilder('ms')
                          ->where('ms.id = :media_store_id')
                          ->setParameter('media_store_id', $id)
                          ->getQuery();            
        }
//        print($query->getDQL()); die;
        $result = $query->execute();
        
        return $result;
    } #getById
    
    public function deleteMediaStoreById(
        $media_store_id_arr
       ,$insert_mtl_error = TRUE
    ) {    
        try {
            if (count($media_store_id_arr) > 0) {
                $del = $this->getEntityManager()
                            ->createQueryBuilder()
                            ->delete('MERLINORACOREMAINMediaBundle:MediaStore', 'a')
                            ->where('a.id IN (:ids)')
                            ->setParameter('ids', array_values($media_store_id_arr))
                            ->getQuery();
                $del->execute();
            }            
            $success = TRUE;
            $message = NULL;            
        } catch (\Exception $ex) {
            $function = 'deleteMediaStoreById';
            
            if ($insert_mtl_error === TRUE) { 
                $message = sprintf(
                               '$activity_id_arr: array(%s), Exception: %s'
                              ,implode(',', $media_store_id_arr)
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
                               ' deleteMediaStoreById: array(%s) (%s), ' . 
                               'Exception: %s'
                              ,implode(',', $media_store_id_arr)
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
    } #deleteMediaStoreById end
}