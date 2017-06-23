<?php

namespace ESERV\MAIN\ContactBundle\Form\Teacher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class EmailType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)            
    {        
        $required = false; 
        if (array_key_exists('enable_required_fields',$options)) {
            if ($options['enable_required_fields'] == true) {
                $required = true;
            }
        }
        $builder
            ->add('emailType', 'entity', array(   
                    'empty_value' => ' -- Please Select -- ',
                    'required' => $required,
                    'class' => 'ESERVMAINApplicationCodeBundle:ApplicationCode',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                    ->leftJoin('u.applicationCodeType', 'act')
                                    //->where('u.code = :uc ')
                                    //->setParameter('uc', \ESERV\MAIN\Services\AppConstants::AC_PERSONAL_EMAIL)
                                    ->andWhere('act.code = :atc')
                                    ->setParameter('atc', \ESERV\MAIN\Services\AppConstants::ACT_EMAIL_ADDRESS_TYPE)
                                    ;
                    },
                ))
            ->add('primaryRecord', 'checkbox', array(
                    'label' => 'Primary',
                    'required' => false,
                )) 
            ->add('emailAddress', 'text', array(
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Email(),
                    ),
                    'eserv_extra_validation' => array(
                        'email' => 'email'                        
                    ), 
                    'required' => $required,
            ))
            ->add('save', 'submit')
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email',
            'enable_required_fields'=>false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_components_contactdetailsbundle_email';
    }
}
