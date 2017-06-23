<?php

namespace ESERV\MAIN\DocumentBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class DocShareFunction extends Controller {

    private $em;
    private $c;
    private $coreFunctions;
    private $securityFunctions;
    private $log;

    public function __construct(EntityManager $Em, Container $C) {
        $this->em = $Em;
        $this->c = $C;
        $this->coreFunctions = $this->c->get('core_function_services');
        $this->securityFunctions = $this->c->has('security_services') ? $this->c->get('security_services') : null;
        $this->log = $this->c->get('logger');
    }
    
    /**
     * Name: overrideDocumentMasterAccess
     * Parameters:
     *   $access_type
     *     - either (V)iew acess, (U)update access or (S)ign Off access
     *   $fos_group doctrine object of fos_group
     *   $document_code
     *   $route_code
     *   $value
     */
    public function overrideDocumentMasterAccess(
        $access_type
       ,$fos_group
       ,$document_code
       ,$route_code
       ,$value
       ,$active_term
       ,$master_value
    ) {
/* Logic provided by Ishwar 30/04/2015
View access:
Teacher: This is totally based on the PDA_VIEW_ACCESS column.
External Mentor: This is totally based on the PDA_VIEW_ACCESS column. 
OTHERS: This is totally based on the PDA_VIEW_ACCESS column.

Update access:
Teacher: (teacher should have active induction record and induction route either GEN or GENSTS) or induction route is STS.  
  Clarified logic with Ishwar (15/11/2016) - logic is in wwv_online_documents.get_document_access
  If the teacher's induction route is (GEN or GENSTS and the teacher has an active induction term record) or (the induction route is STS) use the value in contact_doc_access.update_access else update access is not allowed
External Mentor: based on the PDA_UPDATE_ACCESS if induction route is STS.
                 Otherwise if document code starting with GTCW then N.
                 if document code not starting with GTCW then based on the PDA_UPDATE_ACCESS.
School based mentor:  Based on the PDA_UPDATE_ACCESS.
OTHERS: Based on the PDA_UPDATE_ACCESS.

Sign off access:
Teacher: based on PDA_SIGN_OFF access
External Mentor: based on the PDA_SIGN_OFF_ACCESS if induction route is STS.
                 Otherwise if document code starting with GTCW then N.
if document code not starting with GTCW then based on the the PDA_SIGN_OFF_ACCESS.
School based mentor:  if induction route is STS and document code starting with GTCW then N otherwise based on the PDA_SIGN_OFF_ACCESS.

OTHERS: Based on the PDA_SIGN_OFF_ACCESS.

Logic for external mentors - Log 9044035 (see uploaded document on 13/01/2016)
When level 3 users are accessing the online Induction Profile for their mentees, if the registered teachers Induction route is recorded as short term supply the 
level 3 user should have edit, view and sign off access to the following documents GTCW 1, 2, 3, 4 and 5. 
This will also apply if a teachers Induction route is amended at any point during the Induction period from GEN or GENSTS to STS. If there is a change in status 
and the document has already been signed off then the Level 3 user should have view only access to the document.

NB
The logic provided 13/01/2016 (for external mentors) agrees with the logic provided by Ishwar - the data in document_master_access for GTCW1\2\3\4\5 for external mentors is Y
For the SQL below the view_access, update_access and sign_off_access is 'Y'
select view_access, update_access, sign_off_access
from document_master_access a, document_master m
where m.id = a.document_master_id
and substr(m.code, 1, 4) = 'GTCW' 
and substr(m.code, 5, 1) in ('1','2','3','4','5') 
and a.fos_group_id = 8

Logic for external mentors and school based mentors - Log 9044559 (comment on 07/04/2016)
The sign off access rules are - 
 - If induction route is General/GEN then School Based Mentor can sign off GTCW1/2/3/4/5/6 and External Mentor cannot. 
 - If induction route is STS then External Mentor signs of GTCW1/2/3/4/5/6 as teacher does not have a school based mentor in that instance. 
 - If induction route is General and Short Term Supply/GENSTS then School Based Mentor signs off GTCW1/2/3/4/5/6 and not the External Mentor.
*/        
        $return_value = $value;
        
        try {
            switch ($fos_group->getName()) {
                case \ESERV\MAIN\Services\AppConstants::FOS_GROUP_REGISTERED_PRACTITIONER:
                    $return_value = $this->registeredPractitonerAccess($access_type, $document_code, $route_code, $value, $active_term, $master_value);
                    break;
                case \ESERV\MAIN\Services\AppConstants::FOS_GROUP_SCHOOL_BASED_INDUCTION_MENTORS:
                    $return_value = $this->schoolBasedMentorAccess($access_type, $document_code, $route_code, $value, $master_value);
                    break;
                case \ESERV\MAIN\Services\AppConstants::FOS_GROUP_EXTERNAL_MENTORS:
                    $return_value = $this->externalMentorAccess($access_type, $document_code, $route_code, $value, $master_value);
                    break;
                case \ESERV\MAIN\Services\AppConstants::FOS_GROUP_LA_APPROPRIATE_BODY:
                case \ESERV\MAIN\Services\AppConstants::FOS_GROUP_LA_CONSORTIUM:
                    #$return_value = $value;
                    $return_value = $master_value;
                    break;
                default:
                    #$return_value = $value;
                    $return_value = $master_value;
            }
        } catch (\Exception $e) {
            $return_value = 'E';
        }
        
        return $return_value;
    } #overrideDocumentMasterAccess
    
    public function registeredPractitonerAccess(
        $access_type
       ,$document_code
       ,$route_code
       ,$value
       ,$active_term
       ,$master_value
    ) {
        $return_value = $value;
        $has_active_term = FALSE;
        
        try {
            switch ($access_type) {
                case \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::VIEW_ACCESS:
                    #$return_value = $value; #use whatever value is in contact_doc_access.view_access
                    $return_value = $master_value; #use whatever value is in document_master_access.update_access
                    break;
                case \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::UPDATE_ACCESS:
                    /* Incorrect logic as per wwv_online_documents.get_document_access
                    #Should have (an active induction record and induction route either GEN or GENSTS) or induction route is STS
                    if ($route_code === \ESERV\MAIN\Services\AppConstants::ACT_INDUCTION_ROUTE_SHORT_TERM) {
                        $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::YES;
                    } else if (
                               $route_code === \ESERV\MAIN\Services\AppConstants::AC_IND_ROUTE_GENERAL ||
                               $route_code === \ESERV\MAIN\Services\AppConstants::AC_IND_ROUTE_GENERAL_AND_SHORT_TERM
                              ) {
                        if ($active_term == 'Y' || $active_term == 'N') {
                            $has_active_term = ($active_term == 'Y') ? TRUE : FALSE;
                        } else {
                            if ($active_term instanceof \ESERV\MAIN\ContactBundle\Entity\Contact) {
                                $term = $this->em
                                             ->getRepository('GTCWGTCWBundle:GtcwMemIndTerm')
                                             ->getActiveTermForContact($active_term);
                                if ($term instanceof \GTCW\GTCWBundle\Entity\GtcwMemIndTerm) {
                                    $has_active_term = TRUE;
                                }
                            }
                        }
                        if ($has_active_term) {
                            $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::YES;
                        } else {
                            $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::NO;
                        }
                    } else {
                        $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::NO;
                    }
                    */
                    //if the induction route is STS we are not concerned with the induction term (so set it to TRUE)
                    if ($route_code === \ESERV\MAIN\Services\AppConstants::ACT_INDUCTION_ROUTE_SHORT_TERM) {
                        $has_active_term = TRUE;
                    } else {
                        if ($active_term == 'Y' || $active_term == 'N') {
                            $has_active_term = ($active_term == 'Y') ? TRUE : FALSE;
                        } else {
                            if ($active_term instanceof \ESERV\MAIN\ContactBundle\Entity\Contact) {
                                $term = $this->em
                                             ->getRepository('GTCWGTCWBundle:GtcwMemIndTerm')
                                             ->getActiveTermForContact($active_term);
                                if ($term instanceof \GTCW\GTCWBundle\Entity\GtcwMemIndTerm) {
                                    $has_active_term = TRUE;
                                }
                            }
                        }                        
                    }
                    if ($has_active_term) {
                        #$return_value = $value; #use whatever value is in contact_doc_access.update_access                        
                        $return_value = $master_value; #use whatever value is in document_master_access.update_access
                    } else {
                        $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::NO;
                    }                    
                    break;
                case \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::SIGN_OFF_ACCESS:
                    #$return_value = $value; #use whatever value is in contact_doc_access.sign_off_access
                    $return_value = $master_value; #use whatever value is in document_master_access.update_access
                    break;
            }
        } catch (\Exception $e) {
            $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::EXCEPTION;
        }        
        
        return $return_value;
    } #registeredPractitonerAccess
    
    public function schoolBasedMentorAccess(
        $access_type
       ,$document_code
       ,$route_code
       ,$value
       ,$master_value
    ) {
        $return_value = $value;
        try {
            switch ($access_type) {
                case \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::VIEW_ACCESS:
                    #$return_value = $value;
                    $return_value = $master_value; #use whatever value is in document_master_access.update_access
                    break;                    
                case \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::UPDATE_ACCESS:
                    #$return_value = $value;
                    $return_value = $master_value; #use whatever value is in document_master_access.update_access
                    break;
                case \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::SIGN_OFF_ACCESS:
                    $return_value = $value;
                    $return_value = $master_value; #use whatever value is in document_master_access.update_access
                    if ($route_code === \ESERV\MAIN\Services\AppConstants::ACT_INDUCTION_ROUTE_SHORT_TERM) {
                        $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::NO;
                    } else {
                        if (
                             $document_code === 'GTCW1' || $document_code === 'GTCW1W' ||
                             $document_code === 'GTCW2' || $document_code === 'GTCW2W' ||
                             $document_code === 'GTCW3' || $document_code === 'GTCW3W' ||
                             $document_code === 'GTCW4' || $document_code === 'GTCW4W' ||
                             $document_code === 'GTCW5' || $document_code === 'GTCW5W' ||
                             $document_code === 'GTCW6' || $document_code === 'GTCW6W'                        
                           ) {
                            if (
                                 ($route_code === \ESERV\MAIN\Services\AppConstants::AC_IND_ROUTE_GENERAL) ||
                                 ($route_code === \ESERV\MAIN\Services\AppConstants::AC_IND_ROUTE_GENERAL_AND_SHORT_TERM)
                               ) {
                                $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::YES;
                            }
                        }
                    }
                    break;
            }
        } catch (\Exception $e) {
            $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::EXCEPTION;
        }        
        
        return $return_value;
    } #schoolBasedMentorAccess

    public function externalMentorAccess(
        $access_type
       ,$document_code
       ,$route_code
       ,$value
       ,$master_value
    ) {
        $return_value = $value;
        $document_code_substr = substr($document_code, 0, 5);
        
        try {
            #$return_value = $value;
            $return_value = $master_value; #default the value to whatever is in document_master_access.update_access
            if (
                 ($route_code == \ESERV\MAIN\Services\AppConstants::ACT_INDUCTION_ROUTE_SHORT_TERM)
               ) {
                if (
                     ($document_code_substr == ('GTCW1')) ||
                     ($document_code_substr == ('GTCW2')) ||
                     ($document_code_substr == ('GTCW3')) ||
                     ($document_code_substr == ('GTCW4')) ||
                     ($document_code_substr == ('GTCW5')) ||
                     ($document_code_substr == ('GTCW6'))
                   ) {
                $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::YES;
               }
            } else {
                #$route_code !== \ESERV\MAIN\Services\AppConstants::ACT_INDUCTION_ROUTE_SHORT_TERM
                if ($access_type == \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::VIEW_ACCESS) {
                    #$return_value = $value;
                    $return_value = $master_value; #use whatever value is in document_master_access.update_access
                } else if (
                            ($document_code_substr == ('GTCW1')) ||
                            ($document_code_substr == ('GTCW2')) ||
                            ($document_code_substr == ('GTCW3')) ||
                            ($document_code_substr == ('GTCW4')) ||
                            ($document_code_substr == ('GTCW5')) ||
                            ($document_code_substr == ('GTCW6'))
                          ) {
                    $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::NO;
               }
            }            
        } catch (\Exception $e) {
            $return_value = \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::EXCEPTION;
        }        
        
        return $return_value;
    } #externalMentorAccess     
    
    public function updateContactDocAccess($contact, $route_code, $act_term = NULL, $exclude_term_id = FALSE) {
        $success = FALSE;
        $msg = '';
        
        try {
//$this->log->info(sprintf('updateContactDocAccess $contact.id %s, $route_code: %s, $act_term: %s, $exclude_term_id: %s', $contact->getId(), $route_code, $act_term, $exclude_term_id ? $exclude_term_id : 'FALSE'));
            if ($act_term == 'Y') {
                $active_term = 'Y';
            } else if ($act_term == 'N') {
                $active_term = 'N';
            } else {
                $term = $this->em
                             ->getRepository('GTCWGTCWBundle:GtcwMemIndTerm')
                             ->getActiveTermForContact($contact, $exclude_term_id);
                if ($term instanceof \GTCW\GTCWBundle\Entity\GtcwMemIndTerm) {
                    $active_term = 'Y';
                } else {
                    $active_term = 'N';
                }                
            }

//$this->log->info(sprintf('updateContactDocAccess $active_term: %s, $exclude_term_id: %s', $active_term, ($exclude_term_id ? $exclude_term_id : 'FALSE')));
            $con_doc_acc_arr = $this->em
                                    ->getRepository('ESERVMAINDocumentBundle:ContactDocAccess')
                                    ->getByContact($contact);
//$this->log->info(sprintf('count($con_doc_acc_arr): %s', count($con_doc_acc_arr)));
            foreach ($con_doc_acc_arr as $con_doc_acc) {
                $msg = '';
                $save_needed = FALSE;
                $view_access = $con_doc_acc->getViewAccess();
                $fos_group = $con_doc_acc->getFosGroup();
                #$doc_code = $con_doc_acc->getContactDoc()->getDocumentMasterVersion()->getCode();
                $doc_mast_ver = $con_doc_acc->getContactDoc()->getDocumentMasterVersion();
                $doc_code = $doc_mast_ver->getCode();
                $document_master = $doc_mast_ver->getDocumentMaster();
                $doc_mast_access = $this->em
                                        ->getRepository('ESERVMAINDocumentBundle:DocumentMasterAccess')
                                        ->getByDocumentMasterAndFosGroup($document_master, $fos_group);
                $view_access_master = $doc_mast_access->getViewAccess();
                $new_va = $this->overrideDocumentMasterAccess(
                                   \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::VIEW_ACCESS
                                  ,$fos_group
                                  ,$doc_code
                                  ,$route_code
                                  ,$view_access
                                  ,$active_term
                                  ,$view_access_master
                          );
                if ($view_access !== $new_va) {
                    $save_needed = TRUE;
                    $con_doc_acc->setViewAccess($new_va);
//$this->log->info(sprintf('View access HAS changed %s vs %s', $view_access, $new_va));
                }
                $update_access = $con_doc_acc->getUpdateAccess();
                $update_access_master = $doc_mast_access->getUpdateAccess();
//$this->log->info(sprintf('Update access for %s (fos_group.id: %s) is %s, document_master.id: %s', $doc_code, $fos_group->getId(), $update_access, $document_master->getId()));
                $new_ua = $this->overrideDocumentMasterAccess(
                                   \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::UPDATE_ACCESS
                                  ,$fos_group
                                  ,$doc_code
                                  ,$route_code
                                  ,$update_access
                                  ,$active_term
                                  ,$update_access_master
                           );
                if ($update_access !== $new_ua) {
                    $save_needed = TRUE;
                    $con_doc_acc->setUpdateAccess($new_ua);
//$this->log->info(sprintf('Update access HAS changed %s vs %s', $update_access, $new_ua));
                }
                $sign_off_access = $con_doc_acc->getSignOffAccess();
                $sign_off_access_master = $doc_mast_access->getSignOffAccess();                
                $new_sa = $this->overrideDocumentMasterAccess(
                                   \ESERV\MAIN\DocumentBundle\Services\ESERVDocumentSharingServices::SIGN_OFF_ACCESS
                                  ,$fos_group
                                  ,$doc_code
                                  ,$route_code
                                  ,$sign_off_access
                                  ,$active_term
                                  ,$sign_off_access_master
                          );
                if ($sign_off_access !== $new_sa) {
                    $save_needed = TRUE;
                    $con_doc_acc->setSignOffAccess($new_sa);
//$this->log->info(sprintf('Sign off access HAS changed %s vs %s', $sign_off_access, $new_sa));
                }
                if ($save_needed) {
                    $this->em->persist($con_doc_acc);
                    $this->em->flush();
                    $msg = 'Changes made';
                } else { $msg = 'No changes'; }
            } #foreach ($con_doc_acc_arr as $con_doc_acc)
            $success = TRUE;
            #$msg = '';
        } catch (\Exception $e) {
            $success = FALSE;
            $msg = $e->getMessage();
        }
        
        return array('success' => $success, 'msg' => $msg);
    } #updateContactDocAccess    
}