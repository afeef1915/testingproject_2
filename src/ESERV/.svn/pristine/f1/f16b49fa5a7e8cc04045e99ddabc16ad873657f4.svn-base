<?php

namespace ESERV\MAIN\MembershipBundle\Form\Teacher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MemberRateType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contRateMaster', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\MembershipBundle\Entity\ContRateMaster', 
                            'property'=>'name',
                            'label' => 'Fee Payable Category',
                            'empty_value' => ' -- Please Select -- ',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')                                                                                
                                        ->leftJoin('u.membershipOrg','mo')
                                        ->where('mo.code = :cd')
                                        ->setParameter('cd', \ESERV\MAIN\Services\AppConstants::MEMBERSHIP_ORG_REG);
                            }
            ))
            ->add('paymentMethod', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod', 
                            'property'=>'name',
                            'label' => 'Fee Payment Method',
                            'empty_value' => ' -- Please Select -- ',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')                                                                                
                                        ;
                            }
            ))
            ->add('fund', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\SystemConfigBundle\Entity\Fund', 
                            'property'=>'id',
                            'label' => '',                            
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')                                                                                
                                        ->where('u.code = :cd')
                                        ->setParameter('cd', \ESERV\MAIN\Services\AppConstants::FD_SUBSCRIPTION)
                                ;
                            }
            ))
            ->add('frequency', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\SystemConfigBundle\Entity\Frequency', 
                            'property'=>'id',
                            'label' => '',                            
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')                                                                                
                                        ->where('u.code = :cd')
                                        ->setParameter('cd', \ESERV\MAIN\Services\AppConstants::FY_ANNUAL)
                                ;
                            }
            ))
            ->add('member', new MemberType(), 
                    array(
                        'contact_status' => $options['contact_status'],
                        'contact_status_date' => $options['contact_status_date']                        
                    )
            )
           ->add('status', 'entity', 
                        array(
                            'class' => 'ESERV\MAIN\ContactBundle\Entity\ContactStatus', 
                            'property' => 'name',
                            'label' => 'Member Status',                            
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')
                                        ->leftJoin('u.contactType', 'ct')
                                        ->where('ct.name = :name')
                                        ->setParameter('name', 'Person')
                                        ->andWhere('u.code NOT IN (:codes)')
                                        ->setParameter('codes', array('L', 'C', 'D'))
                                ;
                            },
                            'mapped' => false,
                            'data' => $options['contact_status_code']    
            ))     
            ->add('save', 'submit', array('label' => 'Early Payment'))
            ->setMethod('POST')                     
//            ->add('startDate')
//            ->add('endDate')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
//            ->add('member')
            
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\MembershipBundle\Entity\MemberRate',
            'contact_status' => '',
            'contact_status_date' => new \DateTime(),            
            'contact_status_code' => '',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_membershipbundle_memberrate';
    }
}
