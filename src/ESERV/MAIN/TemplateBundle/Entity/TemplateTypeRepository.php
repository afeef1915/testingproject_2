<?php

namespace ESERV\MAIN\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TemplateTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TemplateTypeRepository extends EntityRepository {

    private function getType($type_name) {
        $type_name = strtoupper($type_name);

        $query = $this->createQueryBuilder('s')
                #->where('s.name = :type_name')
                ->where('Upper(s.name) = :type_name')
                ->setParameter('type_name', $type_name)
                ->getQuery();

        $result = $query->getOneOrNullResult();
        return $result;
    }

    public function getEmail() {
        return self::getType(\ESERV\MAIN\Services\AppConstants::TT_Email);
    }

}
