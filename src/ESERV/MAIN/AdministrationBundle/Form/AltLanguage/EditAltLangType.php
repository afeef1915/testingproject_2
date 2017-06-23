<?php

namespace ESERV\MAIN\AdministrationBundle\Form\AltLanguage;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditAltLangType extends AbstractType 
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('name', 'textarea', array(
                    'label' => 'Text',
                    'attr' => array(
                        'readonly' => 'readonly'
                    ),
                    'constraints' => array(
                    )
                ))
                ->add('altName', 'textarea', array(
                    'label' => 'Alternative Text',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                ))
                ->add('altLanguage', 'text', array(
                    'label' => 'Language',
                ))
                ->add('save', 'submit')
                ->setMethod('POST');  
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {        
        $resolver->setDefaults(array(
        ));
    }
    
    public function getName() 
    {
        return 'new_admin_edit_alt_lang';
    }

}
