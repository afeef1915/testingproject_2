<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ActivitySubCategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActivitySubCategoryRepository extends EntityRepository
{
    
    public function getSubCategoriesByCategoryId($category_id) {
        $sub_cats_arr = array();        
        $query = $this->createQueryBuilder('a')               
                ->where('a.activityCategory = :activity_category_id')                
                ->setParameter('activity_category_id', $category_id)        
                ->getQuery();

        $sub_categories = $query->getResult();
        foreach($sub_categories as $sub_cat){
            $sub_cats_arr[$sub_cat->getId()] = $sub_cat->getDescription();
        }
        return $sub_cats_arr;
    }

}
