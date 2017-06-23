<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\CoreFunctions;

class ContactDetailsBundleService extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }
    
    public function ListAddressesByContactId($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        if(is_array($params)){
            $contact_id = $params['contact_id'];
        } else {
            $contact_id = $params;
        }
        $result = $qb->select($alias)
                        ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVAddress', $alias)
                        ->where($alias.'.contactId = :contact_id')
                        ->setParameter('contact_id', $contact_id);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Addresses found for contact id: ' . $contact_id . ' -- Function "ListAddressByContactId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }  
   
    public function ListAddressesWithHistByContactId($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $onlyHistoryRecord = false;
        if(is_array($params)){
            $contactId = $params['contact_id'];
            $historyRecord = (array_key_exists('history_record', $params) && $params['history_record']== 'Y') ? 'Y' : 'N';
            $onlyHistoryRecord = (array_key_exists('only_history_record', $params) && $params['only_history_record'] == true ) ? true : false;
        } else {
            $contactId = $params;
            $historyRecord = 'N';
        }        
        if($onlyHistoryRecord){
            $historyRecord = 'Y';
        }

        $result = $qb->select($alias)
                        ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVAddressWithHist', $alias)
                        ->where($alias.'.contactId = :id')
                        ->setParameter('id',$contactId)
                       ; 
        if ($historyRecord == 'N') {
             $qb->andWhere($alias.'.historyRecord = :hrec')
                    ->setParameter('hrec', $historyRecord)
                    ;
        } 
        
        if ($onlyHistoryRecord) {
            $qb->andWhere($alias.'.historyRecord = :hrec')
                    ->setParameter('hrec', 'Y')
                    ->orderBy($alias . '.endDate', 'desc')
                ;
        } else {
            $qb->orderBy($alias . '.primaryRecord', 'desc')
                ->addOrderBy($alias . '.startDate', 'desc')
                ;
        }
        if (!$result) {
             if ($historyRecord == 'Y'){
                    throw $this->createNotFoundException(
                        'No Addresses (including history) are found for contact id: ' . $contactId . ' -- Function "ListAddressWithHistByContactId"'
                );
             }else if ($historyRecord == 'N'){
                    throw $this->createNotFoundException(
                        'No Addresses (excluding history) are found for contact id: ' . $contactId . ' -- Function "ListAddressWithHistByContactId"'
                );
             }
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListEmailsByContactId($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $onlyHistoryRecord = false;
        if(is_array($params)){
            $contactId = $params['contact_id'];
            $historyRecord = (array_key_exists('history_record', $params) && $params['history_record']== 'Y') ? 'Y' : 'N';
            $onlyHistoryRecord = (array_key_exists('only_history_record', $params) && $params['only_history_record'] == true ) ? true : false;
        } else {
            $contactId = $params;
            $historyRecord = 'N';
        }
        if($onlyHistoryRecord){
            $historyRecord = 'Y';
        }
        $classMetaData = $this->em->getClassMetadata('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVEmail');        
        if($historyRecord == 'Y'){
            $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_email_hist' ));
        }else{                  
            $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_email' ));
        }
        $result = $qb->select($alias)
                        ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVEmail', $alias)
                        ->where($alias.'.contactId = :contact_id')
                        ->setParameter('contact_id', $contactId)
                ;
        if($onlyHistoryRecord){
            $qb->andWhere($alias . '.historyRecord = :histRec')
                    ->setParameter('histRec', 'Y')
                    ->orderBy($alias . '.createdAt', 'desc')
                ;
        } else {
            if($historyRecord == 'Y'){
                $qb->orderBy($alias . '.createdAt', 'desc')
                ;
            }
            else {
                $qb->orderBy($alias . '.primaryRecord', 'desc')
                    ->addOrderBy($alias . '.createdAt', 'desc')
                ;
            }
        }

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Emails found for contact id: ' . $contactId . ' -- Function "ListEmailsByContactId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListPhonesByContactId($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $onlyHistoryRecord = false;
        if(is_array($params)){
            $contactId = $params['contact_id'];
            $historyRecord = (array_key_exists('history_record', $params) && $params['history_record']== 'Y') ? 'Y' : 'N';
            $onlyHistoryRecord = (array_key_exists('only_history_record', $params) && $params['only_history_record'] == true ) ? true : false;
        } else {
            $contactId = $params;
            $historyRecord = 'N';
        }
        if($onlyHistoryRecord){
            $historyRecord = 'Y';
        }
        
        $classMetaData = $this->em->getClassMetadata('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVPhone');        
        if($historyRecord == 'Y'){
            $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_phone_hist' ));
        }else{                  
            $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_phone' ));
        }
        $result = $qb->select($alias)
                    ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVPhone', $alias)
                    ->where($alias.'.contactId = :contact_id')
                    ->setParameter('contact_id', $contactId)
                ;
        if ($onlyHistoryRecord) {
             $qb->andWhere($alias . '.historyRecord = :histRec')
                    ->setParameter('histRec', 'Y')
                    ->orderBy($alias . '.createdAt', 'desc')
                ;
        } else {
            if($historyRecord == 'Y'){
                $qb->orderBy($alias . '.createdAt', 'desc')
                ;
            }
            else {
                $qb->orderBy($alias . '.primaryRecord', 'desc')
                    ->addOrderBy($alias . '.createdAt', 'desc')
                ;
            }
        }
        
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Phones found for contact id: ' . $contactId . ' -- Function "ListPhonesByContactId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function getDeletedPhoneByMtlDeletedRecordId($mtlDeletedRecordId) {
        $classMetaData = $this->em->getClassMetadata('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVPhone'); 
        $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_phone_hist' ));
        $eservVPhone = $this->em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVPhone')->findOneBy(array(
            'entityId' => $mtlDeletedRecordId,
            'entityName' => 'mtl_deleted_record'
            ));
        $deletedPhone = array();
        if ($eservVPhone) {
            $phoneJson = $eservVPhone->getDeletedRecord();
            $phoneArray = json_decode($phoneJson, true);
            $phoneTypeId = $this->coreFunction->getValueFromArrayOfObject('phone_type', $phoneArray)['id'];
            $phoneType = $phoneTypeId ? $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->find($phoneTypeId) : null;
            $deletedPhone = array(
                'mtlDeletedRecordId' => $mtlDeletedRecordId,
                'phoneTypeId' => $phoneTypeId,
                'phoneTypeName' => $phoneType ? $phoneType->getName() : '',
                'phoneNumber' => $this->coreFunction->getValueFromArrayOfObject('phone_number', $phoneArray),
                'primaryRecord' =>  $this->coreFunction->getValueFromArrayOfObject('primary_record', $phoneArray),
                'deletedAt' => $eservVPhone->getCreatedAt(),
                'deletedByUserName' => $eservVPhone->getCreatedByUserName(),
            );
        }
        return $deletedPhone;
    }
    
    public function getDeletedEmailByMtlDeletedRecordId($mtlDeletedRecordId) {
        $classMetaData = $this->em->getClassMetadata('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVEmail'); 
        $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_email_hist' ));
        $eservVEmail = $this->em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVEmail')->findOneBy(array(
            'entityId' => $mtlDeletedRecordId,
            'entityName' => 'mtl_deleted_record'
        ));
        $deletedEmail = array();
        if ($eservVEmail) {
            $emailJson = $eservVEmail->getDeletedRecord();
            $emailArray = json_decode($emailJson, true);
            $emailTypeId = $this->coreFunction->getValueFromArrayOfObject('email_type', $emailArray)['id'];
            $emailType = $emailTypeId ? $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->find($emailTypeId) : null;
            $deletedEmail = array(
                'mtlDeletedRecordId' => $mtlDeletedRecordId,
                'emailTypeId' => $emailTypeId,
                'emailTypeName' => $emailType ? $emailType->getName() : '',
                'emailAddress' => $this->coreFunction->getValueFromArrayOfObject('email_address', $emailArray),
                'primaryRecord' =>  $this->coreFunction->getValueFromArrayOfObject('primary_record', $emailArray),
                'deletedAt' => $eservVEmail->getCreatedAt(),
                'deletedByUserName' => $eservVEmail->getCreatedByUserName(),
            );
        }
        return $deletedEmail;
    }
    
    public function checkPrimaryEmailExistsByContactId($contact_id)
    {
        $return = array(); 

        $result = $this->em->createQueryBuilder()
                        ->select('e.emailAddress AS emailAddress, c.displayName as displayName')
                        ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e')
                        ->innerJoin('e.contact', 'c')
                        ->where('c.id = :cid')
                        ->setParameter('cid', $contact_id)
                        ->andWhere('e.primaryRecord = :pr')
                        ->setParameter('pr', \ESERV\MAIN\Services\AppConstants::EMAIL_PRIMARY_REOCORD)
                        ->getQuery()
                        ->getArrayResult()        
        ;        
        
        if($result){
            $return = array(
               'exists' => true,
               'email' => $result[0]['emailAddress'],
               'displayName' => $result[0]['displayName']
            );
        }else{
            $return = array(
               'exists' => false,
               'email' => null,
               'displayName' => null
            );
        }        
                
        return $return;
    }

}
