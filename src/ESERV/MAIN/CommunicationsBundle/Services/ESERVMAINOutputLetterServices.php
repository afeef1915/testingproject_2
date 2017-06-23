<?php

namespace ESERV\MAIN\CommunicationsBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINOutputLetterServices extends Controller {

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

    //list Output letters
    public function ListOutputLetters($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $loggedInUserId = $this->c->get('security_services')->getFosUserId();
        $result = $qb->select($alias)
                ->from('ESERVMAINCommunicationsBundle:EservVOutputLetter', $alias)
                ->where($alias . '.fosUserId = :uId')
                ->setParameter('uId', $loggedInUserId)
        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No output letter found-- Function "ListOutputLetters"'
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
