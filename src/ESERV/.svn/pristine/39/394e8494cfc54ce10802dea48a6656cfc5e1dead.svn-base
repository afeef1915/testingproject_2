<?php

namespace ESERV\MAIN\ContactBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\CoreFunctions;

class ContactBundleOrganisationService extends Controller {

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

    public function checkReferenceExists($refNo, $fos_group_name = false) {
        $return = array(
            'exists' => false,
            'contact_id' => null,
            'has_group' => false
        );

        $org_cid = $this->em->createQueryBuilder()
                ->select('c.id AS id')
                ->from('ESERVMAINContactBundle:Organisation', 'org')
                ->leftJoin('org.contact', 'c')
                ->where('org.referenceNo = :ref')
                ->setParameter('ref', $refNo)
                ->getQuery()
                ->getArrayResult()
        ;

        if (count($org_cid) > 0) {
            if ($fos_group_name) {
                $_user = $this->em->createQueryBuilder()
                        ->select('c.id AS id')
                        ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                        ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                        ->leftJoin('ESERVMAINContactBundle:Organisation', 'org', 'WITH', 'org.contact = c.id')
                        ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                        ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                        ->andWhere('org.referenceNo = :ref')
                        ->setParameter('ref', $refNo)
                        ->getQuery()
                        ->getArrayResult()
                ;

                if (count($_user) > 0) {
                    $_user_with_group = $this->em->createQueryBuilder()
                            ->select('c.id AS id')
                            ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
                            ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
                            ->leftJoin('ESERVMAINContactBundle:Organisation', 'org', 'WITH', 'org.contact = c.id')
                            ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
                            ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
                            ->leftJoin('ESERVMAINSecurityBundle:Group', 'g', 'WITH', 'g.id = ug.group')
                            ->where('g.name = :fos_group')
                            ->setParameter('fos_group', $fos_group_name)
                            ->andWhere('org.referenceNo = :ref')
                            ->setParameter('ref', $refNo)
                            ->getQuery()
                            ->getArrayResult()
                    ;

                    if (count($_user_with_group) > 0) {
                        $return = array(
                            'exists' => true,
                            'contact_id' => $org_cid[0]['id'],
                            'has_group' => true
                        );
                    } else {
                        $return = array(
                            'exists' => true,
                            'contact_id' => $org_cid[0]['id'],
                            'has_group' => false
                        );
                    }
                } else {
                    $return = array(
                        'exists' => true,
                        'contact_id' => $org_cid[0]['id'],
                        'has_group' => false
                    );
                }
            } else {
                if (count($org_cid) > 0) {
                    $return = array(
                        'exists' => true,
                        'contact_id' => $org_cid[0]['id'],
                        'has_group' => false
                    );
                }
            }
        }

        return $return;
    }

//    public function checkNiNumberExists($nino, $fos_group_name = false) {
//
//        $return = array(
//            'exists' => false,
//            'contact_id' => null,
//            'has_group' => false
//        );
//
//        $person_cid = $this->em->createQueryBuilder()
//                ->select('c.id AS id')
//                ->from('ESERVMAINContactBundle:Person', 'p')
//                ->leftJoin('p.contact', 'c')
//                ->where('p.niNumber = :nino')
//                ->setParameter('nino', $nino)
//                ->getQuery()
//                ->getArrayResult()
//        ;
//
//        if (count($person_cid) > 0) {
//            if ($fos_group_name) {
//                $_user = $this->em->createQueryBuilder()
//                        ->select('c.id AS id, u.id AS fos_user_id')
//                        ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
//                        ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
//                        ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
//                        ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
//                        ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
//                        ->andWhere('p.niNumber = :nino')
//                        ->setParameter('nino', $nino)
//                        ->getQuery()
//                        ->getArrayResult()
//                ;
//
//                if (count($_user) > 0) {
//                    $_user_with_group = $this->em->createQueryBuilder()
//                            ->select('c.id AS id, u.id AS fos_user_id')
//                            ->from('ESERVMAINProfileBundle:MmUserSetting', 'mm')
//                            ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'mm.contact = c.id')
//                            ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = c.id')
//                            ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH', 'mm.fosUser = u.id')
//                            ->leftJoin('ESERVMAINSecurityBundle:ESERVUserGroup', 'ug', 'WITH', 'u.id = ug.userId')
//                            ->leftJoin('ESERVMAINSecurityBundle:Group', 'g', 'WITH', 'g.id = ug.group')
//                            ->where('g.name = :fos_group')
//                            ->setParameter('fos_group', $fos_group_name)
//                            ->andWhere('p.niNumber = :nino')
//                            ->setParameter('nino', $nino)
//                            ->getQuery()
//                            ->getArrayResult()
//                    ;
//
//                    if (count($_user_with_group) > 0) {
//                        $return = array(
//                            'exists' => true,
//                            'contact_id' => $person_cid[0]['id'],
//                            'has_group' => true
//                        );
//                    } else {
//                        $return = array(
//                            'exists' => true,
//                            'contact_id' => $person_cid[0]['id'],
//                            'has_group' => false
//                        );
//                    }
//                } else {
//                    $return = array(
//                        'exists' => true,
//                        'contact_id' => $person_cid[0]['id'],
//                        'has_group' => false
//                    );
//                }
//            } else {
//                if (count($person_cid) > 0) {
//                    $return = array(
//                        'exists' => true,
//                        'contact_id' => $person_cid[0]['id'],
//                        'has_group' => false
//                    );
//                }
//            }
//        }
//
//        return $return;
//    }

    public function getUserEligible($contact_id) {

        $c_m_status = $this->em->createQueryBuilder()
                ->select('c.id AS id, sc.code AS contact_status_code, m.id AS members_id, sc1.code AS member_status_code')
                ->from('ESERVMAINMembershipBundle:Member', 'm')
                ->leftJoin('ESERVMAINMembershipBundle:MemberStatus', 'ms', 'WITH', 'ms.id = m.memberStatus')
                ->leftJoin('ESERVMAINSystemConfigBundle:SystemCode', 'sc1', 'WITH', 'sc1.id = ms.statusType')
                ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'WITH', 'c.id = m.contact')
                ->leftJoin('ESERVMAINContactBundle:ContactStatus', 'cs', 'WITH', 'cs.id = c.contactStatus')
                ->leftJoin('ESERVMAINSystemConfigBundle:SystemCode', 'sc', 'WITH', 'sc.id = cs.statusType')
                ->where('c.id = :contact_id')
                ->setParameter('contact_id', $contact_id)
                ->getQuery()
                ->getArrayResult()
        ;

        $status = false;

        if (count($c_m_status) > 0) {
            $rec = $c_m_status[0];
            if (isset($rec['contact_status_code']) && isset($rec['member_status_code'])) {
                if ($rec['contact_status_code'] == \ESERV\MAIN\Services\AppConstants::SC_STATUS_TYPE_ACTIVE_CODE && $rec['member_status_code'] == \ESERV\MAIN\Services\AppConstants::SC_STATUS_TYPE_ACTIVE_CODE) {
                    $status = true;
                }
            }
        }

        return true;
    }

}
