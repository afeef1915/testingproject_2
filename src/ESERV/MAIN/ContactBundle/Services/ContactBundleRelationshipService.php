<?php

namespace ESERV\MAIN\ContactBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\CoreFunctions;

class ContactBundleRelationshipService extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }

    public function getWPContactIdsFromEMPContactId($EmployerContactId) {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('cB.id')
                ->from('ESERVMAINContactBundle:Relationship', 'r')
                ->leftJoin('r.contactA', 'cA')
                ->leftJoin('r.contactB', 'cB')
                ->leftJoin('r.relationshipType', 'rt')
                ->leftJoin('rt.contactTypeA', 'rtcA')
                ->leftJoin('rt.contactTypeB', 'rtcB')
                ->where('rtcA.code = :orgcode')
                ->andWhere('rtcB.code = :orgcode')
                ->setParameter('orgcode', \ESERV\MAIN\Services\AppConstants::CT_ORGANISATION)
                ->leftJoin('rt.contactSubtypeListA', 'cslA')
                ->andWhere('cslA.code = :cslAcode')
                ->setParameter('cslAcode', \ESERV\MAIN\Services\AppConstants::CSL_EMPLOYER)
                ->leftJoin('rt.contactSubtypeListB', 'cslB')
                ->andWhere('cslB.code = :cslBcode')
                ->setParameter('cslBcode', \ESERV\MAIN\Services\AppConstants::CSL_WORKPLACE)
                ->andWhere('cA.id = :caid')
                ->setParameter('caid', $EmployerContactId)
                ->orderBy('cB.displayName', 'ASC')
        ;
        $wp_contact_id_array = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');

        return $wp_contact_id_array;
    }

    public function getContactsRelationship($contacts_data) {

        $status = false;
        $msg = '';
        $wp_contact_id_array = false;

        try {

            $qb = $this->em->createQueryBuilder();
            $q = $qb->select('r', 'rt')
                    ->from('ESERVMAINContactBundle:Relationship', 'r')
                    ->leftJoin('r.relationshipType', 'rt')
                    ->where('r.contactA = :contact_id_a')
                    ->andWhere('r.contactB = :contact_id_b')
                    ->andWhere('rt.nameAB = :name_a_b')
                    ->andWhere('rt.nameBA = :name_b_a')
                    ->setParameter('contact_id_a', $contacts_data['contact_id_a'])
                    ->setParameter('contact_id_b', $contacts_data['contact_id_b'])
                    ->setParameter('name_a_b', $contacts_data['name_a_b'])
                    ->setParameter('name_b_a', $contacts_data['name_b_a'])
            ;
            $wp_contact_id_array = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');

            if (count($wp_contact_id_array) > 0) {
                $status = true;
                $msg = 'Relationship(s) found!';
            } else {
                $status = false;
                $msg = 'No Relationship was found!';
            }
        } catch (\Exception $e) {
            $status = false;
            $msg = $e->getMessage();
        }

        return array(
            'success' => $status,
            'msg' => $msg,
            'relationship' => $wp_contact_id_array
        );
    }

    public function listRelationships($contacts, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $contact_a = $contacts['contact_a'];
        $contact_b = $contacts['contact_b'];

        $result = $qb->select($alias)
                ->from('ESERVMAINContactBundle:EservVRelationship', $alias);

        if (!is_null($contact_a)) {
            $qb->andWhere($alias . '.contactIdA = :contact_id_a')
                    ->setParameter('contact_id_a', $contact_a);
        }

        if (!is_null($contact_b)) {
            $qb->andWhere($alias . '.contactIdB = :contact_id_b')
                    ->setParameter('contact_id_b', $contact_b);
        }

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Relationship found-- Function "listContactStatus"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function createRecord($conatcts, $type_id) {
        $em = $this->em;

        $relationship_type = $em->getReference('ESERV\MAIN\ContactBundle\Entity\RelationshipType', $type_id);

        $contact_a = $em->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $conatcts['contact_a_id']);
        $contact_b = $em->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $conatcts['contact_b_id']);

        $rel_exist = $em->getRepository('ESERVMAINContactBundle:Relationship')
                ->findOneBy(array(
            'relationship_type_id' => $type_id,
            'contact_id_a' => $conatcts['contact_a_id'],
            'contact_id_b' => $conatcts['contact_b_id'],
        ));

        if (!$rel_exist) {
            $relationship = new \ESERV\MAIN\ContactBundle\Entity\Relationship();
            $relationship->setRelationshipType($relationship_type);
            $relationship->setContactA($contact_a);
            $relationship->setContactB($contact_b);

            $em->persist($relationship);
            $em->flush();
        }
    }

}
