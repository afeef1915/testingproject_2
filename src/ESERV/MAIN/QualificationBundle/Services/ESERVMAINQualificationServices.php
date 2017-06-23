<?php

namespace ESERV\MAIN\QualificationBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINQualificationServices extends Controller {

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
    }

    //list Qualifications
    public function ListQualifications($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVMAINQualificationBundle:Qualification', $alias);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Qualification found-- Function "ListQualifications"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
}
