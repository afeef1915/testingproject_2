<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EservVContactPersonRepository extends EntityRepository
{
    public function getDataBySubQuery($sub_query, $cols = 'ALL', $extras = false, $count_only = false)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        if($count_only){
            $sql = $qb->select('COUNT(e.referenceNo)');
        }else{
            $sql = $qb->select($cols);
        }
        $sql = $sql->from('ESERVMAINContactBundle:EservVContactPerson', 'e')
                ->where($qb->expr()->in('e.id', $sub_query))                
        ;
        
        if ($extras) {
            
            if (!empty($extras['term'])) {
                $or = $sql->expr()->orx();
                
                foreach ($cols as $key => $col) {                    
                    $or->add($sql->expr()->like("$col", ':val_'.$key));
                    $sql->setParameter('val_'.$key, '%'.$extras['term'].'%');
                }

                $sql->andWhere($or);
            }
            if($count_only){
                return $sql->getQuery()
                        ->getSingleScalarResult();
            }
            if((isset($extras['sortCol']) && '' != $extras['sortCol']) && !empty($extras['sortDir'])){               
               $sql->orderBy($cols[$extras['sortCol']], $extras['sortDir']); 
            }
            
            $sql->setMaxResults($extras['limit']);
            $sql->setFirstResult($extras['offset']);
        }
        $result = $sql->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $result;
    }

}
