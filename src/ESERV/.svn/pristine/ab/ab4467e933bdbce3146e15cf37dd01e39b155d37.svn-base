<?php

namespace ESERV\TestBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVTestBundleEmployerServices extends Controller {

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

    //list centre cases
    public function ListEmployers($is_closed, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        
        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVEmployer', $alias);
        
        if (isset($is_closed) && $is_closed == 'Y') {            

        } else {
//            die('B - '. $date_closed);
            $qb->andWhere($alias . '.dateClosed IS NULL');
        }
//        echo $result->getQuery()->getSQL();die;
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Employers found-- Function "ListEmployers"'
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
