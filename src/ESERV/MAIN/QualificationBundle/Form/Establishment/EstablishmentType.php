<?php

namespace ESERV\MAIN\QualificationBundle\Form\Establishment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;

class EstablishmentType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('code', 'text', array(                                            
                        'constraints' => array(
                            new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('name', 'text', array(
                        'label' => 'English name',
                        'constraints' => array(
                            new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))            
                ->add('type', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 
                            'property'=>'name',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')
                                        ->leftJoin('u.applicationCodeType','act')
                                        ->where('act.code = :emt')
                                        ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_QUTYPE)
                                        ->orderBy('u.name', 'ASC');
                            },
                            'empty_value' => ' -- Please Select -- ',
                            'constraints' => array(
                                new \Symfony\Component\Validator\Constraints\NotBlank()
                            )            
                ))                
                ->add('address1', 'text', array(                                            
                        'constraints' => array(
                            new \Symfony\Component\Validator\Constraints\NotBlank()
                        )
                ))
                ->add('address2', 'text', array(
                    'required' => false
                ))
                ->add('address3', 'text', array(
                    'required' => false
                ))
                ->add('town', 'text', array(                                            
                        'constraints' => array(
                            new \Symfony\Component\Validator\Constraints\NotBlank()
                        )
                ))
                ->add('county', 'text', array(
                    'required' => false
                ))
                ->add('postcode', 'text', array(
                    'required' => true,
                    'eserv_extra_validation' => array(
                        'lettercase' => 'upper',
                        'regexp' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP,
                            'error_msg' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP_ERROR,
                        )
                    ),                    
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank(),
                        new \Symfony\Component\Validator\Constraints\Regex(array(
                            'pattern' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP,
                            'match' => true,
                            'message' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP_ERROR,
                        ))),
                ))
//                ->add('phoneType', 'entity', 
//                        array(
//                            'class'=>'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 
//                            'property'=>'name',
//                            'query_builder' => function(EntityRepository $er) {
//                                return $er->createQueryBuilder('u')
//                                        ->leftJoin('u.applicationCodeType','act')
//                                        ->where('act.code = :emt')
//                                        ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE);
//                            },
//                            'empty_value' => ' -- Please Select -- ',
//                            'required' => false
//                ))                                     
                ->add('phoneNumber', 'text', array(
                    'required' => false,
//                    'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\Type(array('type' => 'numeric'))
//                    )
                ))
                ->add('webAddress', 'text', array(
                    'required' => false,
                    'eserv_extra_validation' => array(
                        'regexp' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP,
                            'error_msg' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP_ERROR,
                        )
                    ),                    
                    'constraints' => array(
                        //new \Symfony\Component\Validator\Constraints\Url(),
                        new \Symfony\Component\Validator\Constraints\Regex(array(
                            'pattern' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP,
                            'match' => true,
                            'message' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP_ERROR,
                        ))),
                ))
                ->add('dateOpened', 'date', array(
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date(),
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    )
                ));

        $tables = $options['client_table_array'];

        foreach ($tables as $key => $value) {
            $location = $value['location'];                
            $builder->add($value['name'], new $location());
        }
        
        $alt_languages = $options['alt_languages'];
        foreach($alt_languages as $alt_language){             
             $builder->add($alt_language, 'text', array('mapped' => false, 'required' => false));
        }  
        

        $builder
                ->add('save', 'submit')
                ->setMethod('POST')
        ;
        
//        $builder->addEventListener(FormEvents::SUBMIT, function($event) {           
//            $data = $event->getData();
//
//            $phoneType = $data['phoneType'];
//            $phoneNumber = $data['phoneNumber'];
//            
//            $fields_array = array();
//
//            if (!empty($phoneNumber) && is_null($phoneType)) {
//                $fields_array['phoneType'] = 'Please select the phone type';
//            }
//
//            foreach ($fields_array as $field => $error_msg) {
//                $err = array(
//                    $field => $error_msg
//                );
//                $event->getForm()->get($field)->addError(new \Symfony\Component\Form\FormError($err));
//            }
//        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
 
      public function setDefaultOptions(OptionsResolverInterface $resolver)
      {
      $resolver->setDefaults(array(
         //'data_class' => 'ESERV\MAIN\QualificationBundle\Entity\Establishment',
           'alt_languages' => array(),
           'client_table_array' => array()
      ));
      }


    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_contactbundle_establishment';
    }

}
