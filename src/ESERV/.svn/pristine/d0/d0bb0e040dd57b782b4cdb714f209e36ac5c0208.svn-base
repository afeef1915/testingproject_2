<?php

namespace ESERV\MAIN\AdministrationBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class AdministrationBundleAltLangService extends Controller {

    private $em;
    private $c;
    private $coreFunction;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }
    
    //list Alternative language app texts
    public function ListAltLangAppTexts($alt_lang_id = null, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVMAINAdministrationBundle:EservVAltLangAppText', $alias);

        if(!is_null($alt_lang_id)){
               $qb->where($alias.'.altLanguageId = :altLanguageIdEservParam')
                  ->setParameter('altLanguageIdEservParam', $alt_lang_id)
               ;
        }        
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Text found-- Function "ListAltLangAppTexts"'
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
