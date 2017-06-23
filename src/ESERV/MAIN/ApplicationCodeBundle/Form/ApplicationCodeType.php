<?php

namespace ESERV\MAIN\ApplicationCodeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ApplicationCodeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('name', 'text')            
            ->add('dateOpened', 'date', array(
                'widget'=>'single_text', 
                'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\Date(),
                    new \Symfony\Component\Validator\Constraints\NotBlank(),
                ),
                'eserv_extra_validation' => array(
                    'date' => array(
                        'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                    )
                )
            ))
            ->add('dateClosed', 'date', array(
                'required' => false, 
                'widget'=>'single_text', 
                'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\Date()
                ),
                'eserv_extra_validation' => array(
                    'date' => array(
                        'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                    )
                )
            ))               
            ->add('applicationCodeType', 'entity', array(
                'class'=>'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCodeType', 
                'property'=>'name',
                'data' => $options['applicationCodeType']
            ))                              
        ;
        
        $alt_languages = $options['alt_languages'];
        foreach($alt_languages as $alt_language){             
             $builder->add($alt_language, 'text', array('mapped' => false, 'required' => false));
        }           
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
             $application_code = $event->getData();             
             $form = $event->getForm();

             // check if the Application Code object is "new"
             // If no data is passed to the form, the data is "null".
             // This should be considered a new "Application Code"
             if (!$application_code || null === $application_code->getId()) {                                 
                 $form->add('code', 'text');
             }
         });
         
         $builder->add('save', 'submit')
            ->setMethod('POST');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode',
            'alt_languages' => array(),
            'applicationCodeType' => ''
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_applicationcodebundle_applicationcode';
    }
}
