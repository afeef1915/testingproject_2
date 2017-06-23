<?php

namespace Security\UserBundle\Form\Activation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;

class PassConfActType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder
                ->add('password', 'password', array(
                    'label' => 'PASSWORD_LBL',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                    'required' => true
                ))        
                ->add('newPassword', 'password', array(
                    'label' => 'NEW_PASSWORD_LBL',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank(),
                        new \Symfony\Component\Validator\Constraints\Length(array(
                            'min' => 6,
                        ))
                    )
                ))
                ->add('confirmNewPassword', 'password', array(
                    'label' => 'VERIFICATION_PASS_LBL',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank(),
                        new \Symfony\Component\Validator\Constraints\Length(array(
                            'min' => 6,
                                ))
                    )
                ))
                ->add('save', 'submit', array(
                    'label' => 'C_SUBMIT_BT'
                ))
                ->setMethod('POST')
                ->getForm()
        ;  
        
        $builder->addEventListener(FormEvents::SUBMIT, function($event) {           
            $data = $event->getData();            
            $fields_array = array();
            
            $password = $data['password'];
            
            $newPassword = $data['newPassword'];
            $confirmNewPassword = $data['confirmNewPassword'];

            $fields_array = array();

            if (($newPassword != '' && $confirmNewPassword != '' ) && ($newPassword == $confirmNewPassword)) {
                //do nothing
            } else {
                $fields_array['confirmNewPassword'] = 'Confirm password does not match with the password or is empty.';
            }

            if ($newPassword == $password) {
                $fields_array['newPassword'] = 'Password cannot be same as the temporary password.';
            }
            
            foreach ($fields_array as $field => $error_msg) {
                $err = array(
                    $field => $error_msg
                );
                $event->getForm()->get($field)->addError(new \Symfony\Component\Form\FormError($err));
            }
        });
        
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'security_pass_act_conf';
    }

}
