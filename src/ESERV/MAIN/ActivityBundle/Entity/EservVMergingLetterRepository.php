<?php
namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\EntityRepository;
use ESERV\MAIN\Services\AppConstants;

class EservVMergingLetterRepository extends EntityRepository
{   
    const REPOSITORY_NAME = 'EservVMergingLetterRepository';
    
    public function getAll($code = NULL, $user_id = NULL) {
        $result = $this->createQueryBuilder('l')
                      ->getQuery()
                      ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);        

        return $result;
    }
    
    public function getById($id, $col = 'ALL') {
        if ($col === 'ALL') {
            $select_col = 'l';
        } else {
            if (is_array($col)) {
                $col_arr = $col;
            } else {
                $col_arr = array($col);
            }
            $select_col = '';
            foreach($col_arr as $key => $value) {
              $select_col = $select_col . 'l.' . $value . ',';
            }
            $select_col = rtrim($select_col, ',');            
        }
        $result = $this->createQueryBuilder('l')
                       ->select($select_col)
                       ->where('l.id = :id_in')
                       ->setParameter('id_in', $id)
                       ->getQuery()
                       ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);                    

        return $result;
    }
}