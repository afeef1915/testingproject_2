<?php

namespace ESERV\MAIN\ContactBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\CoreFunctions;

class ContactBundlePersonService extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $c = null) {
        $this->em = $em;
        $this->c = $c;
        if (!is_null($c)) {
            $this->coreFunction = $this->c->get('core_function_services');
        }
    }

    public function checkReferenceExists($refNo, $email, $fos_group_name = false) {
        $return = array(
            'exists' => false,
            'contact_id' => null,
            'has_group' => false
        );

        $person_cid = $this->em->createQueryBuilder()
                ->select('c.id AS id')
                ->from('ESERVMAINContactBundle:Person', 'p')
                ->leftJoin('p.contact', 'c')
                ->leftJoin('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e', 'WITH', 'e.contact = p.contact')
                ->where('p.referenceNo = :ref')
                ->setParameter('ref', $refNo)
                ->andWhere('e.emailAddress = :email')
                ->setParameter('email', $email)
                ->andWhere('e.primaryRecord = :primaryRecord')
                ->setParameter('primaryRecord', 'Y')
                ->getQuery()
                ->getArrayResult()
        ;

        if (count($person_cid) > 0) {
            if ($fos_group_name) {
                $_user = $this->em->createQueryBuilder()
                        ->select('c.id AS id')
                        ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                        ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                        ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
                        ->leftJoin('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e', 'WITH', 'e.contact = p.contact')
                        ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                        ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                        ->andWhere('p.referenceNo = :ref')
                        ->setParameter('ref', $refNo)
                        ->andWhere('e.emailAddress = :email')
                        ->setParameter('email', $email)
                        ->andWhere('e.primaryRecord = :primaryRecord')
                        ->setParameter('primaryRecord', 'Y')
                        ->getQuery()
                        ->getArrayResult()
                ;

                if (count($_user) > 0) {
                    $_user_with_group = $this->em->createQueryBuilder()
                            ->select('c.id AS id')
                            ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                            ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                            ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
                            ->leftJoin('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e', 'WITH', 'e.contact = p.contact')
                            ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                            ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                            ->leftJoin('ESERVMAINSecurityBundle:Group', 'g', 'WITH', 'g.id = ug.group')
                            ->where('g.name = :fos_group')
                            ->setParameter('fos_group', $fos_group_name)
                            ->andWhere('p.referenceNo = :ref')
                            ->setParameter('ref', $refNo)
                            ->andWhere('e.emailAddress = :email')
                            ->setParameter('email', $email)
                            ->andWhere('e.primaryRecord = :primaryRecord')
                            ->setParameter('primaryRecord', 'Y')
                            ->getQuery()
                            ->getArrayResult()
                    ;

                    if (count($_user_with_group) > 0) {
                        $return = array(
                            'exists' => true,
                            'contact_id' => $person_cid[0]['id'],
                            'has_group' => true
                        );
                    } else {
                        $return = array(
                            'exists' => true,
                            'contact_id' => $person_cid[0]['id'],
                            'has_group' => false
                        );
                    }
                } else {
                    $return = array(
                        'exists' => true,
                        'contact_id' => $person_cid[0]['id'],
                        'has_group' => false
                    );
                }
            } else {
                if (count($person_cid) > 0) {
                    $return = array(
                        'exists' => true,
                        'contact_id' => $person_cid[0]['id'],
                        'has_group' => false
                    );
                }
            }
        }

        return $return;
    }

    public function checkNiNumberExists($nino, $email, $fos_group_name = false) {

        $return = array(
            'exists' => false,
            'contact_id' => null,
            'has_group' => false
        );

        $person_cid = $this->em->createQueryBuilder()
                ->select('c.id AS id')
                ->from('ESERVMAINContactBundle:Person', 'p')
                ->leftJoin('p.contact', 'c')
                ->leftJoin('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e', 'WITH', 'e.contact = p.contact')
                ->where('p.niNumber = :nino')
                ->setParameter('nino', $nino)
                ->andWhere('e.emailAddress = :email')
                ->setParameter('email', $email)
                ->andWhere('e.primaryRecord = :primaryRecord')
                ->setParameter('primaryRecord', 'Y')
                ->getQuery()
                ->getArrayResult()
        ;

        if (count($person_cid) > 0) {
            if ($fos_group_name) {
                $_user = $this->em->createQueryBuilder()
                        ->select('c.id AS id')
                        ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                        ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                        ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
                        ->leftJoin('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e', 'WITH', 'e.contact = p.contact')
                        ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                        ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                        ->andWhere('p.niNumber = :nino')
                        ->setParameter('nino', $nino)
                        ->andWhere('e.emailAddress = :email')
                        ->setParameter('email', $email)
                        ->andWhere('e.primaryRecord = :primaryRecord')
                        ->setParameter('primaryRecord', 'Y')
                        ->getQuery()
                        ->getArrayResult()
                ;

                if (count($_user) > 0) {
                    $_user_with_group = $this->em->createQueryBuilder()
                            ->select('c.id AS id')
                            ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                            ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                            ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
                            ->leftJoin('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e', 'WITH', 'e.contact = p.contact')
                            ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                            ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                            ->leftJoin('ESERVMAINSecurityBundle:Group', 'g', 'WITH', 'g.id = ug.group')
                            ->where('g.name = :fos_group')
                            ->setParameter('fos_group', $fos_group_name)
                            ->andWhere('p.niNumber = :nino')
                            ->setParameter('nino', $nino)
                            ->andWhere('e.emailAddress = :email')
                            ->setParameter('email', $email)
                            ->andWhere('e.primaryRecord = :primaryRecord')
                            ->setParameter('primaryRecord', 'Y')
                            ->getQuery()
                            ->getArrayResult()
                    ;

                    if (count($_user_with_group) > 0) {
                        $return = array(
                            'exists' => true,
                            'contact_id' => $person_cid[0]['id'],
                            'has_group' => true
                        );
                    } else {
                        $return = array(
                            'exists' => true,
                            'contact_id' => $person_cid[0]['id'],
                            'has_group' => false
                        );
                    }
                } else {
                    $return = array(
                        'exists' => true,
                        'contact_id' => $person_cid[0]['id'],
                        'has_group' => false
                    );
                }
            } else {
                if (count($person_cid) > 0) {
                    $return = array(
                        'exists' => true,
                        'contact_id' => $person_cid[0]['id'],
                        'has_group' => false
                    );
                }
            }
        }

        return $return;
    }
    
    public function isDuplicateNiNumber($niNumber, $contactId = null){
        $status = false;
        $qry = $this->em->createQueryBuilder()
                ->select('p')
                ->from('ESERVMAINContactBundle:Person', 'p')
                ->leftJoin('p.contact', 'c')
                ->where('p.niNumber = :nino')
                ->setParameter('nino', $niNumber)
        ;
        if($contactId){
            $qry->andWhere('c.id != :cId')
                ->setParameter('cId', $contactId)
            ;
        }
        $result = $qry->getQuery()->getOneOrNullResult();
        if(count($result) > 0){
            $status = true;
            $msg= 'NI Number '.$niNumber.' is asigned to '. $result->getFirstName() .' '. $result->getLastName(). '.';
        } else {
            $msg= 'NI Number '.$niNumber.' is not duplicate.';
        }
        return array(
            'status' => $status,
            'msg'=> $msg,
        );
    }
    
    public function getUserEligible($contactId, $fosGroupName) {
        $qb = $this->em->createQueryBuilder();
        $qb->select('c.id AS id, sc.code AS contact_status_code, m.id AS members_id, sc1.code AS member_status_code')
                ->from('ESERVMAINMembershipBundle:Member', 'm')
                ->leftJoin('ESERVMAINMembershipBundle:MemberStatus', 'ms', 'WITH', 'ms.id = m.memberStatus')
                ->leftJoin('ESERVMAINMembershipBundle:MembershipOrg', 'mo', 'WITH', 'mo.id = m.membershipOrg')
                ->leftJoin('ESERVMAINSystemConfigBundle:SystemCode', 'sc1', 'WITH', 'sc1.id = ms.statusType')
                ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'c.id = m.contact')
                ->leftJoin('ESERVMAINContactBundle:ContactStatus', 'cs', 'WITH', 'cs.id = c.contactStatus')
                ->leftJoin('ESERVMAINSystemConfigBundle:SystemCode', 'sc', 'WITH', 'sc.id = cs.statusType')
                ->where('c.id = :cid')
                ->setParameter('cid', $contactId)
                ->andWhere('sc.code = :cscd')
                ->setParameter('cscd', \ESERV\MAIN\Services\AppConstants::SC_STATUS_TYPE_ACTIVE_CODE)
                ->andWhere('sc1.code = :mscd')
                ->setParameter('mscd', \ESERV\MAIN\Services\AppConstants::SC_STATUS_TYPE_ACTIVE_CODE)
        ;
//        if ($fosGroupName == \ESERV\MAIN\Services\AppConstants::FOS_GROUP_REGISTERED_FURTHER_EDUCATION_TEACHER) {
//            $qb->andWhere('mo.code = :mocd')
//                    ->setParameter('mocd', \ESERV\MAIN\Services\AppConstants::MEMBERSHIP_ORG_FE)
//            ;
//        } else {
//            $qb->andWhere('mo.code = :mocd')
//                    ->setParameter('mocd', \ESERV\MAIN\Services\AppConstants::MEMBERSHIP_ORG_REG)
//            ;
//        }
        $result = $qb->getQuery()
                ->getArrayResult();
        
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
