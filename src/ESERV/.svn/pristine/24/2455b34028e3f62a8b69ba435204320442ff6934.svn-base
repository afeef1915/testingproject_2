<?php

namespace ESERV\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientTableForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                
        $builder->add('group', 'text', array(
                  'label' => 'Custom Group Name',
                  'attr' => array('class' => 'form-control')
                ))
                ->add('title', 'text', array(
                  'label' => 'Custom Title',
                  'attr' => array('class' => 'form-control')
                ))
                ->add('entity_id', 'entity', array(                    
                    'class' => 'ESERV\TestBundle\Entity\ClientEntity',
                    'property'  => 'entityName',
                    'label' => 'Entity Name',
                    'attr' => array('class' => 'form-control')
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
        return 'client_table';
    }

}
