<?php

namespace ESERV\MAIN\MembershipBundle\Form\Member;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MemberStatusType extends AbstractType 
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $initial_mem_status = (array_key_exists('initial_mem_status', $options) ? $options['initial_mem_status'] : null);
        $exclude_mem_statuses = (array_key_exists('exclude_mem_statuses', $options) ? $options['exclude_mem_statuses'] : null);
        $builder->add('status', 'entity', array(
                    'class' => 'ESERV\MAIN\MembershipBundle\Entity\MemberStatus',
                    'property' => 'name',
                    'label' => 'Status',
                    'empty_value' => ' -- Please Select -- ',
                    'query_builder' => function(EntityRepository $er) use ($exclude_mem_statuses){
                        $e = $er->createQueryBuilder('u');
                        
                        if(null !== $exclude_mem_statuses){
                            $e->where('u.code NOT IN (:eservExludeStatusCode)')
                              ->setParameter('eservExludeStatusCode', $exclude_mem_statuses);
                        }
                          
                        return $e;
                                  
                    },
                ))
                ->add('recordHistory', 'checkbox', array(
                    'label' => 'Record History',
                    'required' => false,
                    'data' => true,
                ))
                ->add('registration_date', 'date', array(
                    'widget' => 'single_text',
                    'format' => \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date(),
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    ),
                    'required' => false
                ));
                
        if(\ESERV\MAIN\Services\AppConstants::MEM_STA_INACTIVE_CODE == $initial_mem_status){
            $builder->add('payment_method', 'entity', array(
                    'class' => 'ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod',
                    'required' => true,
                    'property' => 'name',
                    'label' => 'Payment Method',
                    'empty_value' => ' -- Please Select -- ',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u');
                    },
                ));
        }
                    
        $builder->add('save', 'submit')
                ->setMethod('POST')
                ->getForm()
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
//            'data_class' => 'ESERV\MAIN\MembershipBundle\Entity\Member',
            'initial_mem_status' => null,
            'exclude_mem_statuses' => null,
            
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_membership_edit_member_status';
    }

}
