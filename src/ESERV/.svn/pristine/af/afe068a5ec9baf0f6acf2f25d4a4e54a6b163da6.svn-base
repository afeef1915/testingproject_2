<?php

namespace ESERV\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManager;

class Contact extends AbstractType
{

    protected $clientTableMap;
    protected $clientFields;
    protected $entityManager;

    public function __construct(EntityManager $entity_manager)
    {
        $this->clientTableMap = $entity_manager->getRepository('ESERVTestBundle:ClientTableMap')
                ->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $this->clientFields = $entity_manager->getRepository('ESERVTestBundle:ClientField')
                ->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $this->entityManager = $entity_manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('first_name', 'text', array(
                    'label' => 'First Name',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('last_name', 'text', array(
                    'label' => 'Last Name',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('initials', 'text', array(
                    'label' => 'Initials',
                    'required' => false,
                    'attr' => array('class' => 'form-control',
                    )
                ))
//                ->add('display_name', 'text', array(
//                  'label' => 'Display Name',
//                  'attr' => array('class' => 'form-control')
//                ))
//                ->add('status_date', 'datetime')
//                ->add('cd_contact_type_id', 'entity', array(                    
//                    'class' => 'CORE\TestBundle\Entity\CdContactType',
//                    'property'  => 'id',
//                    'label' => 'Contact Type ID',
//                    'attr' => array('class' => 'form-control')
//                ))
//                ->add('cd_contact_status_id', 'entity', array(                    
//                    'class' => 'CORE\TestBundle\Entity\CdContactStatus',
//                    'property'  => 'id',
//                    'label' => 'Contact Status ID',
//                    'attr' => array('class' => 'form-control')
//                ))
                ->add('addressLine1', 'text', array(
                    'label' => 'Address Line 1',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('addressLine2', 'text', array(
                    'label' => 'Address Line 2',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('addressLine3', 'text', array(
                    'label' => 'Address Line 3',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('town', 'text', array(
                    'label' => 'Town',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('postcode', 'text', array(
                    'label' => 'Post Code',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('county', 'text', array(
                    'label' => 'County',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('phone', 'text', array(
                    'label' => 'Phone',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('website', 'text', array(
                    'label' => 'Website',
                    'attr' => array('class' => 'form-control')
        ));

        $client_table_id_array = array();

        if ($this->clientTableMap) {
            foreach ($this->clientTableMap as $f) {
                if ($f->getClientEntity()->getId() === 1) {
                    $client_table_id_array[] = $f->getClientTable()->getId();
                }

                $builder->add('cd_contact_status_id', '', array(                    
                    'class' => '',
                    'property'  => 'id',
                    'label' => 'Contact Status ID',
                    'attr' => array('class' => 'form-control')
                ));
            }
        }

        $result = $this->entityManager->createQueryBuilder();
        $client_table_name_array = $result->select('p.name')
                ->from('ESERVTestBundle:ClientTable', 'p')
                ->where('p.id IN (:id)')                
                ->setParameter('id', $client_table_id_array)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);        

//        print_r($client_table_name_array);
//        die;
        
        $builder->add('county', 'text', array(
                    'label' => 'County',
                    'attr' => array('class' => 'form-control')
                ));


        $builder->add('save', 'submit', array(
                    'attr' => array('class' => 'btn btn-primary')
                ))
                ->add('reset', 'reset', array(
                    'attr' => array('class' => 'btn btn-default')
                ))
                ->setMethod('POST');
    }

    public function getName()
    {
        return 'contact';
    }

}
