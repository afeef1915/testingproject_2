<?php

namespace ESERV\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Address extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                
        $builder->add('addressLine1', 'text', array(                                        
                    'label' => 'Address Line 1',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('addressLine2', 'text', array(                                        
                    'label' => 'Address Line 2',
                    'attr' => array('class' => 'form-control'),
                    'required' => false
                ))
                ->add('addressLine3', 'text', array(                                        
                    'label' => 'Address Line 3',
                    'attr' => array('class' => 'form-control'),
                    'required' => false
                ))
                ->add('town', 'text', array(                                        
                    'label' => 'Town',
                    'attr' => array('class' => 'form-control'),
                    'required' => false
                ))
                ->add('postcode', 'text', array(                                        
                    'label' => 'Postcode',
                    'attr' => array('class' => 'form-control'),
                    'required' => false
                ))
                ->add('county', 'text', array(                                        
                    'label' => 'County',
                    'attr' => array('class' => 'form-control'),
                    'required' => false
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
        return 'address';
    }

}
