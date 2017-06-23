<?php

namespace WEBLOGS\MAIN\MTL\ShowUsersBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

//name of the class shoule be same as the 'name' in the $data array in above 'myDataTableDataAction' function
class ShowUsersBundleServices extends Controller {

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    //EntityManager and Container will be injected automatically, so you don't need to worry about passing these parameters
    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
    }

    //name of the following function shoule be same as the 'function_name' in the $data array in above 'myDataTableDataAction' function
    //$type needs to be 'doctrine' and $query_only needs to be 'false' all the time. $alias can be anything
    public function ListMyUsers($type = 'doctrine', $alias = 'p', $query_only = false) 
    {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('WEBLOGSMAINMTLShowUsersBundle:VShowusers', $alias); //We are getting data from the 'person' table
       
        //$query=$result->getQuery();
      //$sql=$query->getSQL();
      //print_r($sql);
      //die;
        if (!$result) { 
            throw $this->createNotFoundException(
                    'No Persons found -- Function "ListShowUsers"'  //We are throwing an exception if there are no results
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type); //Returning the results as a doctrine object
            } else {
                return $result; //Returning the query in case you need to debug the SQL. You need to set $query_only to true
            }
        }
    }
}
