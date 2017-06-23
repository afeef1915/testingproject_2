<?php

namespace ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINAdminClientServices extends Controller {

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
    public function ListClientEntityAndSubEntity($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb1 = $this->em->createQueryBuilder();
        $qb2 = $this->em->createQueryBuilder();

        $result1 = $qb1->select("$alias.id","$alias.entityName")
                        ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientEntity', $alias)
                        ->where("$alias.subEntityName IS NULL")
                ;
        
        $result2 = $qb2->select("$alias.id","$alias.entityName","$alias.subEntityName")
                        ->from('ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientEntity', $alias)
                        ->where("$alias.subEntityName IS NOT NULL")
                ;

        if (!$result1) {
            throw $this->createNotFoundException(
                    'No Client Entity found-- Function "ListClientEntityAndSubEntity"'
            );
        } else {
            if (!$query_only) {
                $array1 = $this->coreFunction->GetOutputFormat($result1->getQuery(), $type);
                $array2 = $this->coreFunction->GetOutputFormat($result2->getQuery(), $type);
                $new_array = array();
               
                foreach($array1 as $key1 => $value1){    
                    $label = $value1['entityName'];
                    $items = array();
                    foreach($array2 as $key2 => $value2){
                        if($value1['entityName'] === $value2['entityName']){    
                            $items[$value2['id']] = array('subEntityId' => $value2['id'], 'subEntityName' => $value2['subEntityName']);                            
                        }
                    } 
                    $new_array[$value1['id']] = array(
                        'id' => $value1['id'],
                        'label' => $label,
                        'items' => $items
                    );
                }
                
                return $new_array;
            } else {
                return $result1;
            }
        }
    }
}
