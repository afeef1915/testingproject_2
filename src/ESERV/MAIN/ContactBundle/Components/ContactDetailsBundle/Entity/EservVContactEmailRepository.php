<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EservVContactEmailRepository extends EntityRepository
{

    public function getPrimaryByContactId($contact_id, $col = 'ALL')
    {
        $query = $this->createQueryBuilder('e');
        if ($col === 'ALL') {
            if (is_array($contact_id)) {
                $query = $this->createQueryBuilder('e')
                        ->where('e.contactId IN (:con_id)')
                        ->setParameter('con_id', array_values($contact_id))
                        ->andWhere('e.primaryRecord = :prim_rec')
                        ->setParameter('prim_rec', 'Y')
                        ->getQuery();
                $result = $query->getResult();
            } else {
                $query = $this->createQueryBuilder('e')
                        ->where('e.contactId = :con_id')
                        ->setParameter('con_id', $contact_id)
                        ->andWhere('e.primaryRecord = :prim_rec')
                        ->setParameter('prim_rec', 'Y')
                        ->getQuery();
                $result = $query->getOneOrNullResult();
            }
        } else {
            if (is_array($col)) {
                $col_arr = $col;
            } else {
                $col_arr = array($col);
            }
            $select_col = '';
            foreach ($col_arr as $key => $value) {
                $select_col = $select_col . 'e.' . $value . ',';
            }
            $select_col = rtrim($select_col, ',');
            if (is_array($contact_id)) {
                $query = $this->createQueryBuilder('e')
                        ->select($select_col)
                        ->where('e.contactId IN (:con_id)')
                        ->setParameter('con_id', array_values($contact_id))
                        ->andWhere('e.primaryRecord = :prim_rec')
                        ->setParameter('prim_rec', 'Y')
                        ->getQuery();
                $result = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            } else {
                $query = $this->createQueryBuilder('e')
                        ->select($select_col)
                        ->where('e.contactId = :con_id')
                        ->setParameter('con_id', $contact_id)
                        ->andWhere('e.primaryRecord = :prim_rec')
                        ->setParameter('prim_rec', 'Y')
                        ->getQuery();
                $result = $query->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            }
        }

        return $result;
    }

#getPrimaryByContactId end   

    public function getNoEmailAddress($sub_query)
    {

        $qb = $this->getEntityManager()->createQueryBuilder();
        $sql = $qb->select('e.contactDisplayName, e.emailAddress, e.referenceNo, e.firstName, e.lastName')
                ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail', 'e')
                ->where('e.applicationCodeCode IS NULL') #will be null if the person does not have a primary email address
                ->andWhere('e.primaryRecord = :prim_rec')
                ->setParameter('prim_rec', 'Y')
                ->andWhere($qb->expr()->in('e.contactId', $sub_query))
                ->orderBy('e.lastName, e.firstName')
                ->getQuery();
        $result = $sql->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $result;
    }

#getNoEmailAddress end

    public function getDataBySubQuery($sub_query, $cols = 'ALL')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $sql = $qb->select('e')
                ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail', 'e')
                ->where('e.primaryRecord = :prim_rec')
                ->setParameter('prim_rec', 'Y')
                ->andWhere($qb->expr()->in('e.contactId', $sub_query))
                ->orderBy('e.lastName, e.firstName')
                ->getQuery();
        $result = $sql->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $result;
    }

    public function getNoEmailAddressForList($sub_query, $no_email, $cols = 'ALL', $extras = false, $count_only = false)
    {

        $qb = $this->getEntityManager()->createQueryBuilder();
        if ($count_only) {
            $sql = $qb->select('COUNT(e.referenceNo)');
        } else {
            $sql = $qb->select($cols);
        }
        $sql = $sql->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail', 'e');

        if ('Y' == $no_email) {
            $sql = $sql->where('e.applicationCodeCode IS NULL');
        }

        $sql = $sql->andWhere('e.primaryRecord = :prim_rec')
                ->setParameter('prim_rec', 'Y')
                ->andWhere($qb->expr()->in('e.contactId', $sub_query))
        ;

        if ($extras) {

            if (!empty($extras['term'])) {
                $or = $sql->expr()->orx();

                foreach ($cols as $key => $col) {
                    $or->add($sql->expr()->like("$col", ':val_' . $key));
                    $sql->setParameter('val_' . $key, '%' . $extras['term'] . '%');
                }

                $sql->andWhere($or);
            }
            if ($count_only) {
                return $sql->getQuery()
                        ->getSingleScalarResult();
            }
            if ((isset($extras['sortCol']) && '' != $extras['sortCol']) && !empty($extras['sortDir'])) {
                $sql->orderBy($cols[$extras['sortCol']], $extras['sortDir']);
            }

            $sql->setMaxResults($extras['limit']);
            $sql->setFirstResult($extras['offset']);
        }
        $result = $sql->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $result;
    }

}
