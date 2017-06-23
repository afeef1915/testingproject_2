<?php

namespace ESERV\MAIN\AdministrationBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EservVUserRepository extends EntityRepository
{     
    const REPOSITORY_NAME = 'EservVUserRepository';

    public function getByFosUserId($fos_user_id) {
        $result = $this->getEntityManager()->createQueryBuilder();
        #$data = $result->select('e.id AS id')
        $data = $result->select('e')
                       ->from('ESERVMAINAdministrationBundle:EservVUser', 'e')
                       ->where('e.fosUserId = :user_id')
                       ->setParameter('user_id', $fos_user_id)
                       ->getQuery()
                       ->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);        
        
        return $data;
    } #getByFosUserId end
    
//    public function getByActivity($activity_id_arr) {
//        $data_arr = array();
//
//        try {
//            if (count($activity_id_arr) > 0) {
//                $result = $this->getEntityManager()->createQueryBuilder();
//                $data_arr = $result->select('at.id AS id')
//                        ->from('ESERVMAINActivityBundle:ActivityTarget', 'at')
//                        ->where('at.activity IN (:act_ids)')
//                        ->setParameter('act_ids', array_values($activity_id_arr))                        
//                        ->getQuery()
//                        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
//            }
//        } catch (\Exception $ex) {
//            $data_arr = array();
//        }
//
//        return $data_arr;
//    } #getByActivity end    
    
//    public function updateActivityById(
//        $activity_id_arr
//       ,$status_date_time = NULL
//       ,$status_id = NULL
//    ) {
//        if (count($activity_id_arr) > 0) {
//            $qb = $this->getEntityManager()->createQueryBuilder();
//            $upd = $qb->update('ESERVMAINActivityBundle:Activity', 'a');
//            if (!(is_null($status_date_time))) {
//                $upd->set('a.statusDateTime', $qb->expr()->literal($status_date_time));                    
//            }
//            if (!(is_null($status_id))) {
//                $upd->set('a.status', $status_id);
//            }
//            $upd->where('a.id IN (:ids)')
//                ->setParameter('ids', array_values($activity_id_arr))
//                ->getQuery()
//                ->execute();            
//        }
//        
//        return TRUE;
//    } #updateActivityById end
//    
//    public function deleteActivityById(
//        $activity_id_arr
//       ,$insert_mtl_error = TRUE
//    ) {    
//        try {
//            if (count($activity_id_arr) > 0) {
//                $del = $this->getEntityManager()
//                            ->createQueryBuilder()
//                            ->delete('ESERVMAINActivityBundle:Activity', 'a')
//                            ->where('a.id IN (:ids)')
//                            ->setParameter('ids', array_values($activity_id_arr))
//                            ->getQuery();
//                $del->execute();
//            }
//            
//            $success = TRUE;
//            $message = NULL;            
//        } catch (\Exception $ex) {
//            $function = 'deleteActivityById';
//            
//            if ($insert_mtl_error === TRUE) { 
//                $message = sprintf(
//                               '$activity_id_arr: array(%s), Exception: %s'
//                              ,implode(',', $activity_id_arr)
//                              ,$ex->getMessage()
//                           );
//                $this->c->get('db_core_function_services')
//                        ->insertMtlError(
//                              ($function . '(' . self::REPOSITORY_NAME. ')')
//                             ,$message
//                          );
//            } else {
//                $message = sprintf(
//                               $function . 
//                               ' $activity_id_arr: array(%s) (%s), ' . 
//                               'Exception: %s'
//                              ,implode(',', $activity_id_arr)
//                              ,self::REPOSITORY_NAME
//                              ,$ex->getMessage()
//                           );
//            }
//            $success = FALSE;
//        }
//        $result_arr = array(
//            'success' => $success,
//            'msg' => $message
//        );        
//        
//        return $result_arr;
//    } #deleteActivityJobById end
//
//    public function createActivity(
//        $em            
//       ,$activity_category
//       ,$status_id
//       ,$status_date_time = NULL
//       ,$entity_id
//       ,$entity_name            
//       ,$short_description = NULL
//       ,$template_version = NULL
//       ,$activity_date_time = NULL       
//       ,$priority_id = NULL
//       ,$parent_id = NULL
//       ,$long_description = NULL
//       ,$advice_given = NULL
//       ,$is_deleted = 0
//       ,$reissue = 'N'
//       ,$activity_set = NULL
//       ,$activity_sub_category = NULL
//       ,$show_alert = 'N'
//       ,$is_reminder = NULL
//       ,$no_of_reminders = NULL
//       ,$first_reminder_days = NULL
//       ,$subsequent_reminder_days = NULL
//       ,$comm_title = NULL
//       ,$comm_first_name = NULL
//       ,$comm_last_name = NULL
//       ,$comm_phone_no = NULL
//       ,$comm_email = NULL
//       ,$activity_source = NULL
//    ) {
//        $curr_date_time = new \DateTime();
//        $activity = new \ESERV\MAIN\ActivityBundle\Entity\Activity();
//        if ($activity_category instanceof \ESERV\MAIN\ActivityBundle\Entity\ActivityCategory) {
//            $activity->setActivityCategory($activity_category);
//        } else {
//            $act_cat = $em->getReference('ESERV\MAIN\ActivityBundle\Entity\ActivityCategory', $activity_category);            
//            $activity->setActivityCategory($act_cat);
//        }
//        if ($status_id instanceof \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode) {
//            $activity->setStatus($status_id);
//        } else {
//            $system_code = $em->getReference('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode', $status_id);            
//            $activity->setStatus($system_code);
//        }
//        $activity->setStatusDateTime(is_null($status_date_time) ? $curr_date_time : $status_date_time);
//        $activity->setEntityId($entity_id);
//        $activity->setEntityName($entity_name);       
//        if (!(is_null($priority_id))) {
//            $activity->setPriorityId($priority_id);
//        }
//        if (!(is_null($parent_id))) {
//            $activity->setParentId($parent_id);
//        }
//        if (!(is_null($short_description))) {
//            $activity->setShortDescription($short_description);
//        }
//        if (!(is_null($activity_date_time))) {
//            $activity->setActivityDateTime($activity_date_time);
//        }
//        if (!(is_null($long_description))) {
//            $activity->setLongDescription($long_description);
//        }
//        if (!(is_null($advice_given))) {
//            $activity->setAdviceGiven($advice_given);
//        }       
//        $activity->setIsDeleted($is_deleted);
//        $activity->setReissue($reissue);
//        if (!(is_null($activity_set))) {
//            if ($activity_set instanceof \ESERV\MAIN\ActivityBundle\Entity\ActivitySet) {
//                $activity->setActivitySet($activity_set);
//            } else {
//                $act_set = $em->getReference('ESERV\MAIN\ActivityBundle\Entity\ActivitySet', $activity_set);
//                $activity->setActivitySet($act_set);
//            }
//        }
//        if (!(is_null($activity_sub_category))) {
//            if ($activity_sub_category instanceof \ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory) {
//                $activity->setActivitySubCategory($activity_sub_category);
//            } else {
//                $act_sub_cat = $em->getReference('ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory', $activity_sub_category);
//                $activity->setActivitySubCategory($system_code);
//            }
//        }
//        $activity->setShowAlert($show_alert);
//        if (!(is_null($is_reminder))) {
//            $activity->setIsReminder($is_reminder);
//        }
//        if (!(is_null($no_of_reminders))) {
//            $activity->setNoOfReminders($no_of_reminders);
//        }
//        if (!(is_null($first_reminder_days))) {
//            $activity->setFirstReminderDays($first_reminder_days);
//        }
//        if (!(is_null($subsequent_reminder_days))) {
//            $activity->setSubsequentReminderDays($subsequent_reminder_days);
//        }
//        if (!(is_null($comm_title))) {
//            if ($comm_title instanceof ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode) {
//                $activity->setCommTitle($comm_title);
//            } else {
//                $title_code = $em->getReference('ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', $comm_title);
//                $activity->setCommTitle($title_code);
//            }
//        }
//        if (!(is_null($comm_first_name))) {
//            $activity->setCommFirstName($comm_first_name);   
//        }
//        if (!(is_null($comm_last_name))) {
//            $activity->setCommLastName($comm_last_name);   
//        }
//        if (!(is_null($comm_phone_no))) {
//            $activity->setCommPhoneNo($comm_phone_no);   
//        }
//        if (!(is_null($comm_email))) {
//            $activity->setCommEmail($comm_email);   
//        }
//        if (!(is_null($template_version))) {
//            if ($template_version instanceof \ESERV\MAIN\TemplateBundle\Entity\TemplateVersion) {
//                $activity->setTemplateVersion($template_version);
//            } else {
//                $temp_ver = $em->getReference('ESERV\MAIN\TemplateBundle\Entity\TemplateVersion', $template_version);            
//                $activity->setTemplateVersion($temp_ver);
//            }
//        }
//        if (!(is_null($activity_source))) {
//            if ($activity_source instanceof \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode) {
//                $activity->setActivitySource($activity_source);
//            } else {
//                $app_code = $em->getReference('ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', $activity_source);
//                $activity->setActivitySource($app_code);
//            }
//        }
//        $em->persist($activity);
//        $em->flush();
//        
//        return $activity;
//    } #createActivity end
    
}
