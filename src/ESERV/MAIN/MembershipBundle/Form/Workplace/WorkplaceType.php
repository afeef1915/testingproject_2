<?php

namespace ESERV\MAIN\MembershipBundle\Form\Workplace;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;

class WorkplaceType extends AbstractType {

    public $em;
    public $client_table_name_array;
    protected $show_client_fields;
               
    public function __construct(EntityManager $em, $ctna, $show_client_fields = true) {
        $this->em = $em;
        $this->client_table_name_array = $ctna;

        $this->show_client_fields = $show_client_fields;
    }

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
                ->add('denom', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 
                            'property'=>'name',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')
                                        ->leftJoin('u.applicationCodeType','act')
                                        ->where('act.code = :emt')
                                        ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_DENOMINATION_TYPE);
                            },
                            'empty_value' => ' -- Please Select -- ',
                            'label' => 'Denomination',
                            'required' => false           
                ))
                ->add('type', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 
                            'property'=>'name',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')
                                        ->leftJoin('u.applicationCodeType','act')
                                        ->where('act.code = :emt')
                                        ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_WORKPLACE_TYPE);
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
//                            'required' => false,
//                                     
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
//                ->add('relationship', 'choice', array(
//                    'choices' => $this->getEmployers(),
//                    'label' => 'Employer',
//                    'empty_value' => ' -- Please Select -- ',
//                    'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\NotBlank()
//                    )
//                ))
                ->add('relationship', 'autocomplete', array(
                    'required' => true, 
                    'label' => 'Employer',
                    'eserv_autocomplete_options' => array(
                        'url' => $options['ac_urls']['employer_ac']
                    ),
                ))                    
                ->add('dateOpened', 'date', array(
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date(),
//                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    ),
                    'required' => false
                ))
                ->add('dateClosed', 'date', array(
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date(),
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    ),
                    'required' => false
                ))
            ;

        if ($this->show_client_fields) {
            $tables = $this->client_table_name_array;

            foreach ($tables as $key => $value) {
                $location = $value['location'];                
                $builder->add($value['name'], new $location());
            }
        }
        
        $alt_languages = $options['alt_languages'];
        foreach($alt_languages as $alt_language){             
             $builder->add($alt_language, 'text', array('mapped' => false, 'required' => false));
        }  
        
        $builder
                ->add('save', 'submit')
                ->setMethod('POST')
        ;
        
        $builder->addEventListener(FormEvents::POST_SUBMIT, function($event) {           
            $form = $event->getForm();
            $dateOpened = $form->get('dateOpened')->getData();
            $dateClosed= $form->get('dateClosed')->getData();
            $fields_array = array();

            if (!empty($dateOpened) && !empty($dateClosed) && ($dateOpened > $dateClosed)) {
                $fields_array['dateClosed'] = 'Date closed date must be greater than Date opened date.';
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
            // 'data_class' => 'ESERV\MAIN\MembershipBundle\Entity\Employer',
            'alt_languages' => array(),
            'ac_urls' => array()
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_membershipbundle_workplace';
    }

    public function getEmployers() {
        $result1 = $this->em->createQueryBuilder();
        $org_names = $result1->select('c.id, o.name')
                ->from('ESERVMAINMembershipBundle:Employer', 'p')
                ->leftJoin('p.organisation', 'o')
                ->leftJoin('o.contact', 'c')
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $new_array = array();
        foreach ($org_names as $a) {
            $new_array[$a['id']] = $a['name'];
        }
        return $new_array;
    }

}
