<?php

namespace ESERV\MAIN\MembershipBundle\Form\Teacher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MemberType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder
            ->add('memberStatus', 'text', array(
                'mapped' => false,
                'data' => $options['contact_status']
            ))    
            ->add('membershipOrg', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\MembershipBundle\Entity\MembershipOrg', 
                            'property'=>'id',
                            'label' => '',
                            'empty_value' => ' -- Please Select -- ',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')                                        
                                        ->where('u.code = :cd')
                                        ->setParameter('cd', \ESERV\MAIN\Services\AppConstants::MEMBERSHIP_ORG_REG);
                            }
            ))
            ->add('primaryRecord', 'text', array('data' => 'N'))                
            ->add('registrationDate', 'date', 
                    array(
                        'widget'=>'single_text', 
                        'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                        'label' => 'Registration Date',
                        'eserv_extra_validation' => array(
                            'date' => array(
                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                            )
                        ),
            ))    
            ->add('statusDate', 'date', 
                    array(
                        'widget'=>'single_text', 
                        'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                        'label' => '',
                        'data' => $options['contact_status_date']
            ))            
            
//            ->add('membershipNo')
//            ->add('votingCategory')
                
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
//            ->add('contact')
//            ->add('workplace')
//            ->add('branch')    
                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\MembershipBundle\Entity\Member',
            'contact_status' => '',
            'contact_status_date' => new \DateTime()
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_membershipbundle_member';
    }
}
