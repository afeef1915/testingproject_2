<?php

namespace ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientFieldType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('clientTable', 'entity', array(
                    'class' => 'ESERVMAINAdministrationBundleComponentsClientAdministrationBundle:ClientTable',
                    'property' => 'title',
                    'label' => 'Client Group Name',
                    'empty_value' => '-- Please Select --',
                    'attr' => array('class' => 'form-control'),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('title', 'text', array(
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
//            ->add('fieldName')
                ->add('fieldType', 'choice', array(
                    'choices' => array(
                        'VARCHAR' => 'Text',
                        'number' => 'Number',
                        'DATE' => 'Date',
                        'DATETIME' => 'Date / Time',
                        'select' => 'Select',
                        'radio' => 'Radio',
                        'checkbox' => 'Checkbox'
                    ),
                    'label' => 'Field Type',
                    'attr' => array('onchange' => 'populateFields(this.value)'),
                    'empty_value' => '-- Please Select --',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
//            ->add('symfonyFormType')
                ->add('fieldSize', 'integer', array(
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('notNull', 'choice', array(
                    'choices' => array('Y' => 'Yes', 'N' => 'No'),
                    'label' => 'Required?',
                    
                ))
//            ->add('clientTable')
                ->add('form_select_names', 'hidden', array('mapped' => false))
                ->add('form_select_values', 'hidden', array('mapped' => false))
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn btn-primary')
                ))
                ->add('reset', 'reset', array(
                    'attr' => array('class' => 'btn btn-default')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientField'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'client_field';
    }

}
