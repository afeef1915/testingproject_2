<?php

namespace ESERV\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientFieldForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('client_table_id', 'entity', array(
                    'class' => 'ESERV\ClientBundle\Entity\ClientTable',
                    'property' => 'name',
                    'label' => 'Custom Group Name',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('title', 'text', array(
                    'label' => 'Title',                    
                    'attr' => array('class' => 'form-control')
                ))
                ->add('field_name', 'text', array(
                    'label' => 'Custom Field Name',                    
                    'attr' => array('class' => 'form-control')
                ))
                ->add('field_type', 'choice', array(
                    'choices' => array('VARCHAR' => 'Text', 'INT' => 'Number', 'DATETIME' => 'Date / Time'),                   
                    'label' => 'Field Type',
                ))
                ->add('field_size', 'text', array(                   
                    'label' => 'Field Size',
                ))
                ->add('not_null', 'choice', array(
                    'choices' => array('Y' => 'Yes', 'N' => 'No'),                    
                    'label' => 'Required?',
                ))
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn btn-primary')
                ))
                ->add('reset', 'reset', array(
                    'attr' => array('class' => 'btn btn-default')
                ))
                ->setMethod('POST');
    }

    public function getName()
    {
        return 'client_field';
    }

}
