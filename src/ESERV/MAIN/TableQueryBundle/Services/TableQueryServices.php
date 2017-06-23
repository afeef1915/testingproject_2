<?php

namespace ESERV\MAIN\TableQueryBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class TableQueryServices extends Controller 
{
    private $em;
    private $c;
    private $coreFunction;
    private $lineNo = 1;
    private $operatorBefore = false;
    private $parentGroupOperator = false;
    private $numberOfCalls = 1;

    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }

    public function getFieldsByViewId($params = array(), $type = 'array', $alias = 'p', $query_only = false) 
    {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias.'.id', $alias.'.fieldName AS fieldName', $alias.'.name AS name', 'sc.code AS code')
                    ->from('ESERVMAINTableQueryBundle:QueryViewField', $alias)
                    ->innerJoin($alias.'.fieldType', 'sc')
                    ->where($alias.'.queryView = :eservQVId')
                    ->setParameter('eservQVId', $params['query_view_id'])
                    ->andWhere($alias.'.isActive = :eservIsActive')
                    ->setParameter('eservIsActive', 'Y')
                    ->addOrderBy($alias.'.name', 'asc')
        ;
      
        if (!$result) {
            throw $this->createNotFoundException(
                    'No fields found-- Function "getFieldsByViewId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function iterateArray($array, $queryMaster)
    {   
        try{   
            $rules = $array['group']['rules'];            
            $operator = $array['group']['operator'];
//            echo '$this->numberOfCalls - '. $this->numberOfCalls;
            if($this->numberOfCalls === 1){
                $this->numberOfCalls++;
                $this->mainGroupOperator = $operator;
            }
            for($i = 0; $i < count($rules); $i++){
                if(array_key_exists('group', $rules[$i])){ 
                    $this->operatorBefore = $rules[$i]['group']['operator'];
//                    echo 'A - '. $this->operatorBefore;
//                    print_r($rules[$i]);
//                    echo  '<br/>';                    
                    $this->iterateArray($rules[$i], $queryMaster);                        
                }else{
                    if($i == 0) { 
                        $this->operatorBefore = $this->mainGroupOperator;                         
                    } else{
                        $this->operatorBefore = $operator;
                    }
                    if(!array_key_exists($i+1, $rules)){
//                        echo 'B - '.$this->operatorBefore;
//                        print_r($rules[$i]);
//                        echo  '<br/>';                        
                        $openB = false;
                        $closeB = true;                           
                        if(count($rules) == 1){
                            $openB = true;
                        }                        
                        $this->saveRecord($queryMaster, $rules[$i], $this->operatorBefore, $openB, $closeB, $this->lineNo);                            
                    }else{                        
//                        echo 'C - '.$this->operatorBefore;
//                        print_r($rules[$i]);    
//                        echo  '<br/>';
                        $closeB = false;                        
                        if($i == 0) { $openB = true; } else{ $openB = false;}
                        $this->saveRecord($queryMaster, $rules[$i], $this->operatorBefore, $openB, $closeB, $this->lineNo);
                    }                          
                    $this->lineNo++;
                }             
            }            
        }catch(\Exception $e){
            throw $e;           
        }              
    }
    
    public function saveRecord($queryMaster, $v1, $operator, $openBracket, $closeBracket, $lineNo)
    {   
        try{            
            $em = $this->em;
            $queryDetWhere = new \ESERV\MAIN\TableQueryBundle\Entity\QueryDetailWhere();
            $queryDetWhere->setQueryMaster($queryMaster);
            $queryDetWhere->setLineNo($lineNo);   
            $queryDetWhere->setQdetExpression($v1['condition']);
            
            $formattedFieldVal = $this->formatFieldValue($v1['data'], $v1['condition']);
            $queryDetWhere->setQdetValue1($formattedFieldVal);            
            
            if(($v1['condition'] == 'BETWEEN' || $v1['condition'] == 'NOT BETWEEN')
               && array_key_exists('data2', $v1)){
                $formattedFieldVal = $this->formatFieldValue($v1['data2'], $v1['condition']);
                $queryDetWhere->setQdetValue2($formattedFieldVal);
            }
            
            $queryDetWhere->setPromptForValue('N');

            ($lineNo == 1 ? $queryDetWhere->setQdetJoin('WHERE') : $queryDetWhere->setQdetJoin($operator));        
            ($openBracket ? $queryDetWhere->setQdetOpenBracket('(') : '');
            ($closeBracket  ? $queryDetWhere->setQdetCloseBracket(')') : '');        

            $viewField = $em->getRepository('ESERVMAINTableQueryBundle:QueryViewField')->find($v1['field']);
            $queryDetWhere->setQueryViewField($viewField);
            $em->persist($queryDetWhere); 
            $em->flush();   
            
        }catch(\Exception $e){
            throw $e;
        }        
    }
    
    private function formatFieldValue($value, $condition)
    {   
        $formattedVal = '';
        switch($condition)
        {
            case 'IN': 
                $formattedVal = '(\'';
                $formattedVal .= str_replace(',', '\',\'', $value);
                $formattedVal .= '\')';
                break;
            case 'NOT IN': 
                $formattedVal = '(\'';
                $formattedVal .= str_replace(',', '\',\'', $value);
                $formattedVal .= '\')';
                break;            
            case 'IS NULL': 
                $formattedVal = null;                
                break;
            case 'IS NOT NULL': 
                $formattedVal = null;                
                break;
            default: 
                $formattedVal = '\'' . $value. '\'';
        }
        
        return $formattedVal;
    }
}
