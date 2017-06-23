<?php

namespace ESERV\MAIN\SystemConfigBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class MtlColourServices extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }

    public function ListMtlColour($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVMAINSystemConfigBundle:MtlColour', $alias);
      
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Mtl Colour found-- Function "ListMtlColour"'
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
