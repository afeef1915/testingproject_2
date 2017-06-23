<?php
namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\EntityRepository;
use ESERV\MAIN\Services\AppConstants;

class EservVOutstandingEmailRepository extends EntityRepository
{   
    const REPOSITORY_NAME = 'EservVOutstandingEmailRepository';
    
    public function getAll() {
        $result = $this->createQueryBuilder('l')
                      ->getQuery()
                      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);        

        return $result;
    }
    
    public function getById($id, $col = 'ALL') {
        if ($col === 'ALL') {
            $select_col = 'e';
        } else {
            if (is_array($col)) {
                $col_arr = $col;
            } else {
                $col_arr = array($col);
            }
            $select_col = '';
            foreach($col_arr as $key => $value) {
              $select_col = $select_col . 'e.' . $value . ',';
            }
            $select_col = rtrim($select_col, ',');            
        }
        $result = $this->createQueryBuilder('e')
                       ->select($select_col)
                       ->where('e.id = :id_in')
                       ->setParameter('id_in', $id)
                       ->getQuery()
                       ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);                    

        return $result;
    }

}