<?php

namespace ESERV\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EservUser extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('username', 'text', array(
                    'label' => 'Username',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('email', 'text', array(
                    'label' => 'Email',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Email(),
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('password', 'password', array(
                    'label' => 'Password',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('save', 'submit')
                ->setMethod('POST');
    }

    public function getName() {
        return 'new_eserv_user';
    }

}
