<?php

namespace ESERV\MAIN\AdministrationBundle\Form\UserForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class TempPasswordType extends AbstractType 
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('password', 'password', array(
                    'label' => 'Password',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('confirmPassword', 'password', array(
                    'label' => 'Confirm Password',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('save', 'submit')
                ->setMethod('POST');
        
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $password = $data['password'];
            $confPassword = $data['confirmPassword'];
            $fields_array = array();
            
            if ($password != $confPassword) {
                $fields_array['confirmPassword'] = 'This value should match the password.';
            } 


            foreach ($fields_array as $field => $error_msg) {
                $err = array(
                    $field => $error_msg
                );
                $event->getForm()->get($field)->addError(new \Symfony\Component\Form\FormError($err));
            }
        })
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {        
        $resolver->setDefaults(array(
            
        ));
    }
    
    public function getName() 
    {
        return 'user_temp_password';
    }

}
