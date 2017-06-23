<?php

namespace ESERV\MAIN\AdministrationBundle\Form\AltLanguage;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class AddAltLangType extends AbstractType 
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('name', 'textarea', array(
                    'label' => 'Text',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('altName', 'textarea', array(
                    'label' => 'Alternative Text',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                ))
                
                ->add('save', 'submit')
                ->setMethod('POST');  
        
                    
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
           $data = $event->getData();
           $form = $event->getForm();          

           if(null !== $data['altLanguage'] && null !== $data['altLanguage']->getId()){
               $form->add('altLanguage', 'text', array(
                    'label' => 'Language',
                    'data' => $data['altLanguage']->getLanguage()->getName(),
                    'required' => false,
                    'mapped' => false
                ));
           }else{
               $form->add('altLanguage', 'entity', array(
                    'class' => 'ESERV\MAIN\HelpersBundle\Entity\AltLanguage',
                    'label' => 'Language',
                    'property' => 'language.name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ;
                    },
                    'empty_value' => ' -- Please Select -- ',
                    'required' => true
                ));
           }
           
        });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {        
        $resolver->setDefaults(array(
        ));
    }
    
    public function getName() 
    {
        return 'new_admin_alt_lang';
    }

}
