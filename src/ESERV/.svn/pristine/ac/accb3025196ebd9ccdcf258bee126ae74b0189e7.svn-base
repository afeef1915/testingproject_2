<?php

namespace ESERV\MAIN\MembershipBundle\Form\Subject;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class SubjectType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('code')
                ->add('name')               
                ->add('membershipOrg', 'entity', array('class' => 'ESERV\MAIN\MembershipBundle\Entity\MembershipOrg', 
                    'property' => 'organisation.name',
                    'label' => 'Qual. Type',
                    'query_builder' => function(EntityRepository $er) {
                     return $er->createQueryBuilder('mo')
                             ->leftJoin('mo.organisation', 'o')
                             ->where('mo.code NOT IN (:excludeMorgList)')
                             ->setParameter('excludeMorgList', array(\ESERV\MAIN\Services\AppConstants::MEMBERSHIP_ORG_YSW, \ESERV\MAIN\Services\AppConstants::MEMBERSHIP_ORG_YW))
                             ->orderBy('o.name', 'ASC')
                        ;
                     },)
                )        
                ->add('dateOpened', 'date', array(
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date(),
                        new \Symfony\Component\Validator\Constraints\NotBlank(),
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    )
                ))
                ->add('dateClosed', 'date', array(
                    'required' => false, 
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date()
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    )
                ))               
                ->add('save', 'submit')
                ->setMethod('POST');    
                     
                $alt_languages = $options['alt_languages'];
                foreach($alt_languages as $alt_language){             
                     $builder->add($alt_language, 'text', array('mapped' => false, 'required' => false));
                }   
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\MembershipBundle\Entity\MemberSubject',
            'alt_languages' => array(),   
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_membershipbundle_member_subject';
    }
}
