<?php

namespace Security\UserBundle\Form\FosUser;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;

class EditFosUserType extends AbstractType {

    private $security_context;
    private $ac_urls;

    public function __construct(SecurityContext $security_context) {
        $this->security_context = $security_context;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->ac_urls = $options['ac_urls'];

        $builder->add('person', 'autocomplete', array(
                'mapped' => false,
                'label' => 'Person',
                'eserv_autocomplete_options' => array(
                    'url' => $this->ac_urls['persons']
                ),
                'required' => false
            ))
            ->add('username', 'text', array(
                'label' => 'Username',                
                'required' => false
            ))
            ->add('email', 'text', array(
                'label' => 'Email'                
            ))
            ->add('password', 'password', array(
                'label' => 'Password',                
                'required' => false
            ))
            ->add('retypePassword', 'password', array(
                'label' => 'Re-type Password',                
                'required' => false,
            ))
//            ->add('type', 'choice', array(
//                'label' => 'User Type',
//                'empty_value' => ' -- Please Select -- ',
//                'choices' => $user_type_choices,
//                'constraints' => array(
//                    new \Symfony\Component\Validator\Constraints\NotBlank()
//                )
//            ))
            ->add('fosGroup', 'entity', array(
                'label' => 'Type',
                'required' => true,
                'empty_value' => ' -- Choose an option -- ',
                'class' => 'SecurityUserBundle:Group',
                'property' => 'name',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('fg')
                            ->orderBy('fg.name', 'ASC')
                    ;
                },
            ))
            ->add('locked', 'checkbox', array(
                'label' => 'Locked',
                'required' => false,
            ))
            
            ->add('save', 'submit')
            ->setMethod('POST')
            ->getForm()
        ;

        $builder->addEventListener(FormEvents::SUBMIT, function($event) {
            $data = $event->getData();
            $password = $data['password'];
            $username = $data['username'];
            $retypePassword = $data['retypePassword'];
            $fields_array = array();

            if ($password == $username) {
                $fields_array['password'] = 'Password cannot be same as the username';
            }
            if ($password != $retypePassword) {
                $fields_array['retypePassword'] = 'This must match with the password';
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
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'ac_urls' => array()
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'merlin_ora_fos_user_registration_edit';
    }

}
