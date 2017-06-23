<?php

namespace Security\UserBundle\Form\Activation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResendActType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $lang_choices = array(
            'en' => 'English',
            'cy' => 'Welsh',
        );
        
        $builder->add('language', 'choice', array(
                    'label' => 'Language',
                    'choices' => $lang_choices,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))                
                ->add('save', 'submit', array(
                    'label' => 'Send'
                ))
                ->setMethod('POST')
                ->getForm()
        ;  
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'security_activation_resend_form';
    }

}
