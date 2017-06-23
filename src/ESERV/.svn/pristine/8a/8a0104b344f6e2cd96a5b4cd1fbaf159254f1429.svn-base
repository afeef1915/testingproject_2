<?php

namespace ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientTableType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank(),  
                        new \Symfony\Component\Validator\Constraints\Length(array(
                            'max' => 15
                        ))
                    ),
                    'label' => 'Table Name'
            ))
            ->add('title', 'text', array(
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
            ))
            ->add('description', 'textarea', array(
                    'label' => 'Description',
                    'attr' => array('cols' => '5', 'rows' => '5'),
            ))    
            ->add('entity_id', 'choice', array(                    
                'choices' => array(1 => 'Person', 2 => 'Organisation'),
                'empty_value' => '-- Please Select--',
                'label' => 'Main Entity',
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\NotBlank()
                )
            ))
            ->add('sub_entity_id', 'choice', array(                    
                'choices' => array(
                    'all' => 'All', 3 => 'Workplace', 4 => 'Employer', 5 => 'Establishment', 6 => 'Teacher',
                    7 => 'Mentor', 8 => 'Individual'
                ),
                'empty_value' => ' -- Please Select --',
                'multiple' => true,
                'label' => 'Sub Entity',
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\NotBlank()
                )
            ))
            ->add('save', 'submit', array(
                'attr' => array('class' => 'btn btn-primary')
            ))
            ->add('reset', 'reset', array(
                'attr' => array('class' => 'btn btn-default')
            ))
            ->setMethod('POST')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientTable'
//        ));
//    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'client_table';
    }
}
