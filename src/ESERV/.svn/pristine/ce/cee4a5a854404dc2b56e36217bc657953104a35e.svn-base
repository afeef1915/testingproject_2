<?php

namespace ESERV\MAIN\AdministrationBundle\Form\UserForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddUserType extends AbstractType 
{
    private $ac_urls;
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $this->ac_urls = $options['ac_urls'];
        $builder->add('contact', 'autocomplete', array(
                    'mapped' => false,
                    'label' => 'Contact',
                    'eserv_autocomplete_options' => array(
                        'url' => $this->ac_urls['people']
                    ),
                    'required' => true
                ))
                ->add('username', 'text', array(
                    'label' => 'Username',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('password', 'password', array(
                    'label' => 'Password',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('fosGroup', 'entity', array(
                    'class' => 'ESERV\MAIN\SecurityBundle\Entity\Group',
                    'label' => 'Group',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ;
                    },
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('accountType', 'entity', array(
                    'class' => 'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode',
                    'label' => 'Account Type',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.applicationCodeType', 'act')
                                ->where('act.code = :code')
                                ->setParameter('code', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
                                ;
                    },
                    'empty_value' => ' -- Please Select -- ',
                    'required' => false,                    
                ))
                ->add('locked', 'checkbox', array(
                    'label' => 'Locked',
                    'required' => false,
                    'data' => true
                ))
                ->add('enabled', 'checkbox', array(
                    'label' => 'Active',
                    'required' => false,
                ))
                ->add('save', 'submit')
                ->setMethod('POST');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {        
        $resolver->setDefaults(array(
            'ac_urls' => array()
        ));
    }
    
    public function getName() 
    {
        return 'new_admin_user';
    }

}
