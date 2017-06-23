<?php

namespace WEBLOGS\MAIN\Services\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\Container;

/**
 * Description of ESERVListeners
 *
 * @author MTL Web Development Team
 */
class WEBLOGSListener {

    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    private function getInitials($firstName) {
        $array = explode(' ', trim($firstName));
        $initials = '';

        foreach ($array as $i => $k) {
            $initials .= substr($k, 0, 1);
        }

        return $initials;
    }

    public function preUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();
//        var_dump($entityManager->getUnitOfWork()->getEntityChangeSet($entity));        die;
//        $log = $this->container->get('logger');

        $user_id = null;
        $security_context = $this->container->get('security.context');

        if ($security_context->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user_id = $security_context->getToken()->getUser()->getId();
        }
        if ($entity instanceof \ESERV\MAIN\SecurityBundle\Entity\User) {
            
        } else {
            if ($entity instanceof \ESERV\MAIN\ContactBundle\Entity\Person) {
                if (
                        ($args->hasChangedField('firstName')) ||
                        ($args->hasChangedField('middleName')) ||
                        ($args->hasChangedField('lastName'))
                ) {
                    $initials = $this->getInitials($entity->getFirstName());
//                    $initials =  $this->container
//                                      ->get('db_core_function_services')
//                                      ->person_initials(
//                                            $entity->getFirstName()
//                                           ,$entity->getMiddleName()
//                                           ,$entity->getLastName()
//                                        );                    
                    $entity->setInitials($initials);
                    if ($args->hasChangedField('lastName')) {
                        $last_name_search = $this->container
                                ->get('db_core_function_services')
                                ->mtl_word_translate(
                                $entity->getLastName()
                        );
                        $entity->setLastNameSearch($last_name_search);
                    }
                }
                if (method_exists($entity, 'getNiNumber') && method_exists($entity, 'setNiNumber')) {
                    $ni_num = trim($entity->getNiNumber());
                    if ($ni_num != '') {
                        $newNi = $this->container->get('core_function_services')->stripNINumber($entity->getNiNumber());
                        $entity->setNiNumber($newNi);
                    }
                }
            }
            if (method_exists($entity, 'setUpdatedBy')) {
                $entity->setUpdatedBy($user_id);
            }
            if (method_exists($entity, 'setUpdatedAt')) {
                $entity->setUpdatedAt(new \DateTime('now'));
            }
//Attempt made here (without success) to update the contact_doc_access data
//when the gtcw_mem_ind_route.ind_route_id is changed
//Could not get this too work as the entity manager could not be separated -
//whenever a flush was done it saved the gtcw_mem_ind_route record
//without the change to gtcw_mem_ind_route.ind_route_id
//This is now done in GTCW\GTCWBundle\Services\GTCWGTCWBundleServices\updateGtcwMemIndRoute
//            if ($entity instanceof \GTCW\GTCWBundle\Entity\GtcwMemIndRoute) {
//                if ($args->hasChangedField('indRoute')) {
//                    $contact = $entity->getContact();
//                    $route_code = $entity->getIndRoute()->getCode();
//                    $con_doc_upd = $this->container
//                                        ->get('doc_share_function_services')
//                                        ->updateContactDocAccess(
//                                              $contact
//                                             ,$route_code
//                                        );
//                }
//            } #if ($entity instanceof \GTCW\GTCWBundle\Entity\GtcwMemIndRoute)
        }
    }

#preUpdate end

    public function postUpdate(LifecycleEventArgs $args) {
        $entityManager = $args->getEntityManager();
        $entity = $args->getEntity();
        $entityName = $entityManager->getClassMetadata(get_class($entity))->getTableName();

        $request = $this->container->get('request');
        $request_array = $request->request->all();
        $keys_tmp = array_keys($request_array);

        $keys_array = array();
        foreach ($keys_tmp as $key) {
            if (preg_match('/^eserv_history_editable_(.*)/i', $key)) {
                $keys_array[] = $key;
            }
        }

        if (count($keys_array) > 0) {
            foreach ($keys_array as $hist) {
                $field_name_arr = explode('_', $hist);
                $field_name = end($field_name_arr);
                $column_name = $entityManager->getClassMetadata(get_class($entity))
                        ->getColumnName($field_name);
                $field_name_method = 'set' .
                        strtoupper(substr($field_name, 0, 1)) .
                        substr($field_name, 1);

                if (method_exists($entity, $field_name_method)) {
                    $history = new \ESERV\MAIN\HistoryBundle\Entity\History();
                    $history->setEntityId($entity->getId());
                    $history->setNewValue($request_array[$hist]['new_value']);
                    $history->setOldValue($request_array[$hist]['old_value']);
                    $history->setReason($request_array[$hist]['reason']);
                    $history->setFieldName($column_name);
                    $history->setEntityName($entityName);
                    $entityManager->persist($history);
                    $entityManager->flush($history);
                }
            }
        }
    }

#postUpdate end

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $user_id = null;
        $security_context = $this->container->get('security.context');

        if ($security_context->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user_id = $security_context->getToken()->getUser()->getId();
        }
        if ($entity instanceof \ESERV\MAIN\SecurityBundle\Entity\User) {
            
        } else {
            if ($entity instanceof \ESERV\MAIN\ContactBundle\Entity\Person) {
                $initials = $this->getInitials($entity->getFirstName());
//                $initials =  $this->container
//                                  ->get('db_core_function_services')
//                                  ->person_initials(
//                                        $entity->getFirstName()
//                                       ,$entity->getMiddleName()
//                                       ,$entity->getLastName()
//                                    );                    
                $entity->setInitials($initials);
                $last_name_search = $this->container
                        ->get('db_core_function_services')
                        ->mtl_word_translate(
                        $entity->getLastName()
                );
                $entity->setLastNameSearch($last_name_search);
            }
            if (method_exists($entity, 'setCreatedBy')) {
                $entity->setCreatedBy($user_id);
            }
            if (method_exists($entity, 'setCreatedAt')) {
                $createdAt = null;
                if (method_exists($entity, 'getCreatedAt')) {
                    $createdAt = $entity->getCreatedAt();
                }
                if (!$createdAt) {
                    $entity->setCreatedAt(new \DateTime('now'));
                }
            }
        }
    }

    public function preRemove(LifecycleEventArgs $args) {
        
    }

}
