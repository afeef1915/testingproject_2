<?php

namespace ESERV\MAIN\TemplateBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINTemplateBundleTemplateServices extends Controller 
{

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
    }

    //list Templates
    public function ListTemplates($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVMAINTemplateBundle:EservVTemplate', $alias);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Templates found-- Function "ListTemplates"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    /*
     * Returns all codes from the template table.
     * Optionally, exclude_code parameter will prevent that code from appearing in the results code array.
     */
    public function getTemplateCodes($exclude_code=null)
    {
        $qb = $this->em->createQueryBuilder();
        $codes_array = array();
        $formatted_array = array();

        $codes_query = $qb->select('t.code')
                ->from('ESERVMAINTemplateBundle:Template', 't')                
        ;
        
        if(!is_null($exclude_code)){
            $codes_query->where('t.code != :ex ')
                ->setParameter('ex', $exclude_code);
        }
        
        if (!$codes_query) {
            $codes_array = array();
        } else {
            $codes_array = $this->c->get('core_function_services')->GetOutputFormat($codes_query->getQuery(), 'array');
        }
        
        foreach($codes_array as $k => $v){
            $formatted_array[] = $v['code'];
        }
        
        return $formatted_array;        
        
    }
}
