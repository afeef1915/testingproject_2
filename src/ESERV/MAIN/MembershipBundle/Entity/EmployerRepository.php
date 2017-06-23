<?php
            
        /*
            This file has been generated using MTL ESERV:BUILD command. Contact Anjana on anjana@millertech.co.uk for more
            information. Thanks.
        */

        namespace ESERV\MAIN\MembershipBundle\Entity;

        use Doctrine\ORM\EntityRepository;
                
        /**
         * ActivityRepository
         *
         * This class was generated by the Doctrine ORM. Add your own custom
         * repository methods below.
         */
        class EmployerRepository extends EntityRepository
        {  
            
            public function getAllEmployers() {                
                $emp_data = $this->createQueryBuilder('e')
                        ->select('c.id', 'e.code', 'o.name')
                        ->leftJoin('e.organisation', 'o')
                        ->leftJoin('o.contact', 'c')
                        ->where('o.dateClosed IS NULL')
                        ->orderBy('o.name', 'ASC')
                        ->addOrderBy('e.code', 'ASC') 
                        ->getQuery()
                        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
                    ;
                $employers = array();                 
                foreach($emp_data as $ed){                     
                    $employers[$ed['id']] = $ed['name'].' ('.$ed['code'].')';
                }
                return $employers;                
            }
            
            public function getLAEmployers() {                
                $emp_data = $this->createQueryBuilder('e')
                        ->select('e.id', 'e.code', 'o.name')                        
                        ->leftJoin('e.organisation', 'o')
                        //->leftJoin('o.contact', 'c')
                        ->leftJoin('e.employerType', 'et')//employerType is actually applicationcode see orm
                        ->where('o.dateClosed IS NULL')
                        ->andWhere('et.code = :act_par')
                        ->setParameter('act_par', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE_LA)
                        ->orderBy('o.name', 'ASC')
                        ->addOrderBy('e.code', 'ASC') 
                        ->getQuery()
                        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);                        
                    ;
                $employers = array();                 
                foreach($emp_data as $ed){                     
                    $employers[$ed['id']] = $ed['name'].' ('.$ed['code'].')';
                }
                return $employers;                
            }  

        }