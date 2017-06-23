<?php

namespace ESERV\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditContact extends AbstractType
{

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
                  'attr' => array('class' => 'form-control')
                ))                
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn btn-primary'),
                    'label' => 'Update'
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
