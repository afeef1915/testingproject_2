<?php

namespace ESERV\MAIN\ContactBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESERV\MAIN\Services\CoreFunctions;

class ContactBundleContactStatusService extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }

    public function listContactStatus($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVMAINContactBundle:EservVContactStatus', $alias);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Subject found-- Function "listContactStatus"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function existsContactStatus($contactStatusCode, $excludedId = 0) {
        $qb = $this->em->createQueryBuilder();
        $qb->select('cs')
                ->from('ESERVMAINContactBundle:EservVContactStatus', 'cs')
                ->where('cs.code = :code')
                ->setParameter('code', $contactStatusCode)
        ;
        if ($excludedId > 0) {
            $qb->andWhere('cs.id not in (:id)')
                    ->setParameter('id', $excludedId)
            ;
        }

        $result = $qb->getQuery()->getArrayResult();

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
