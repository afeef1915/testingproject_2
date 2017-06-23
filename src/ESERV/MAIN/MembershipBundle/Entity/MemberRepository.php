<?php

/*
  This file has been generated using MTL ESERV:BUILD command. Contact Anjana on anjana@millertech.co.uk for more
  information. Thanks.
 */

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ActivityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MemberRepository extends EntityRepository {

    public function getMemberIdByContactAndMemberType($contactId, $memberOrgCode) {
        $member = $this->createQueryBuilder('m')
                ->select('m.id')
                ->leftJoin('m.membershipOrg', 'mo')
                ->where('m.contact = :c')
                ->setParameter('c', $contactId)
                ->andWhere('mo.code = :cd')
                ->setParameter('cd', $memberOrgCode)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        ;
        if (count($member) > 0) {
            return $member[0]['id'];
        } else {
            return 0;
        }
    }
    
    public function getMemberByContactAndMemberType($contactId, $memberOrgCode) {
        $memberId  = $this->getMemberIdByContactAndMemberType($contactId, $memberOrgCode);
        if ($memberId > 0) {
            return $this->getEntityManager()->getRepository('ESERVMAINMembershipBundle:Member')->find($memberId);
        } else {
            return null;
        }
    }

}