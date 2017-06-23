<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class VMyLogsType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                //  ->add('job_no')
                //  ->add('customer')
//                ->add('customer', 'entity', array(
//                    'label' => 'Customer',
//                    'required' => true,
//                    'empty_value' => ' -- Choose an option -- ',
//                    'class' => 'WEBLOGSMAINMTLMyemailBundle:VWwvCustomers',
//                    'property' => 'name',
////                'query_builder' => function(EntityRepository $er) {
////                    return $er->createQueryBuilder('fg')
////                            ->orderBy('fg.customerId', 'ASC')
////                    ;
////                },
//                ))
                 ->add('customer', 'choice', array(
                    'label' => 'Customer',
                    'required' => true,
                        //'mapped' => false,
                ))
                ->add('customer_log_id', 'text', array(
                    'label' => 'Customer Log Id',
                    'required' => false,
                ))
                //->add('customer_log_id')
                ->add('category', 'choice', array(
                    'label' => 'Log Category',
                    'required' => true,
                        //'mapped' => false,
                ))
                ->add('attention_of', 'choice', array(
                    'label' => 'Attention Of',
                    'required' => true,
                        //'mapped' => false,
                ))
                // ->add('task')
                ->add('task', 'choice', array(
                    'label' => 'Log Task',
                    'required' => true,
                        //'mapped' => false,
                ))
                ->add('requested_by', 'text', array(
                    'label' => 'Requested By',
                    'required' => false,
                        //'mapped' => false,
                ))
                //  ->add('category')
//                ->add('priority', 'text', array(
//                    'label' => 'Priority',
//                    'required' => true,
//                        //'mapped' => false,
//                ))
                ->add('priority', 'entity', array(
                    'label' => 'Priority',
                    'required' => true,
                    'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VWwvPriorityLevel',
                    'property' => 'DESCRIPTION',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
                ->add('status', 'text', array(
                    'label' => 'Log Status',
                    'required' => false,
                        //'mapped' => false,
                ))
                ->add('status', 'entity', array(
                    'label' => 'Log Status',
                    'required' => false,
                    'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:LogClientStatus',
                    'property' => 'DESCRIPTION',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
                ->add('short_description', 'text', array(
                    'label' => 'Brief Description',
                    'required' => true,
                ))
                ->add('task_description', 'textarea', array(
                    'label' => 'Description',
                    'required' => true,
                ))
//                   ->add('assigned_to', 'text', array(
//                'label' => 'Contact/Assigned To',
//                'required' => false,
//            ))
                ->add('assigned_to', 'entity', array(
                    'label' => 'Contact/Assigned To',
                    'required' => false,
                    'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VPersons',
                    'property' => 'fullname',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
                ->add('version_no', 'text', array(
                    'label' => 'Version No',
                    'required' => false,
                        //'mapped' => false,
                ))
//                ->add('completed_by', 'text', array(
//                    'label' => 'COMPLETED BY',
//                    'required' => false,
//                        //           'mapping'=>false,
//                ))
                ->add('completed_by', 'entity', array(
                    'label' => 'Completed By',
                    'required' => false,
                    'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VPersons',
                    'property' => 'fullname',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
//                ->add('CHARGABLE', 'text', array(
//                    'label' => 'Chargeable',
//                    'required' => false,
//                        //    'mapping'=>false,
//                ))
                
                 ->add('CHARGABLE', 
                        'choice', array(
                            'label' => 'Chargeable',
                            'required' => false,
                'choices' => array(
                    'Y' => 'Yes',
                    'N' => 'No'
                )))
//                 ->add('date_completed', 'date', array(
//                'label' => 'DATE COMPLETED',
//                'required' => false,
//             //   'mapping'=>false,
//            ))
//                ->add('date_completed', 'date', array(
//    'widget' => 'single_text',
//    // this is actually the default format for single_text
//    'format' => 'd-M-y',
//                    'html5'   => false,
//                     'required' => false,
//))
//                 ->add('date_completed', 'date', 
//                    array(
//                        'widget'=>'single_text', 
//                        'format'=> 'dd/MM/yyyy',
//                        'label' => 'DATE COMPLETED',  
//                        'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\Date(),
//                    ),
//                        'eserv_extra_validation' => array(
//                            'date' => array(
//                                'format' => 'dd/mm/yy',
//                            )
//                        ),
//                        'required' => false
//            ))
//             ->add('date_completed', 'datetime', array(
//                    'widget' => 'single_text',
//                    'label' => 'DATE COMPLETED',
//                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                    'required' => false
//                )) 
                ->add('date_completed', 'datetime', array(
                    'label' => 'Date Completed',
                    'widget' => 'single_text',
                    'required' => false,
                    'format' => \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date()
                    // new \Symfony\Component\Validator\Constraints\NotBlank(),
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    )
                ))
                
//                ->add('dueby', 'datetime', array(
//                    'widget' => 'single_text',
//                    'label' => 'Dueby',
//                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                    'required' => false
//                )) 
                ->add('dueby', 'date', array(
                    'label' => 'Due By',
                    'widget' => 'single_text',
                    'required' => false,
                    'format' => \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date()
                    // new \Symfony\Component\Validator\Constraints\NotBlank(),
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    )
                ))
//                ->add('dev_status', 'text', array(
//                    'label' => 'Developer Status',
//                    'required' => false,
//                        //   'mapping'=>false,
//                ))
                
                   ->add('dev_status', 'entity', array(
                    'label' => 'Developer Status',
                    'required' => false,
                    'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VWwvLogAction',
                    'property' => 'DESCRIPTION',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
                
                
                
//                 ->add('dev_status', 
//                        'choice', array(
//                            'label' => 'Developer Status',
//                'choices' => array(
//                    0 => 'Published',
//                    1 => 'Draft'
//                )))
                ->add('mlo_quote_id', 'text', array(
                    'label' => 'Quote Id',
                    'required' => false,
                        //   'mapping'=>false,
                ))
//                  ->add('mtl', 'text', array(
//                'label' => 'MTL Status',
//                'required' => false,
//                //'mapped' => false,
//            ))
                ->add('mtl', 'entity', array(
                    'label' => 'MTL Status',
                    'required' => false,
                    'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VWwvLogAction',
                    'property' => 'DESCRIPTION',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
                //      ->add('title')
                //  ->add('attention_of')
                //   ->add('requested_by')
                // ->add('requested')
                //    ->add('priority')
                //  ->add('status')
                //    ->add('mtl')
                //   ->add('updated')
                //  ->add('dueby')
                //  ->add('dev_status')
                //   ->add('assigned_to')
                // ->add('mtl_category')
                // ->add('task_description')
                //     ->add('chargable')
                //   ->add('mlo_quote_id')
                //   ->add('completed_by')
                //  ->add('date_completed')
                ->add('save', 'submit')
                ->setMethod('POST')
                ->getForm()
        ;
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();
            if ($form->has('category')) {
                $form->remove('category');
            }
            
            
            if ($form->has('customer')) {
                $form->remove('customer');
            }

            $form->add('customer', 'choice', array(
                'choices' => array($data['customer'] => 'Whatever'),
            ));

            $form->add('category', 'choice', array(
                'choices' => array($data['category'] => 'Whatever'),
            ));

            if ($form->has('attention_of')) {
                $form->remove('attention_of');
            }

            $form->add('attention_of', 'choice', array(
                'choices' => array($data['attention_of'] => 'Whatever'),
            ));

            if ($form->has('task')) {
                $form->remove('task');
            }

            $form->add('task', 'choice', array(
                'choices' => array($data['task'] => 'Whatever'),
            ));
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                //     'data_class' => 'WEBLOGS\MAIN\COMMON\CommonBundle\Entity\VMyLogs'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'weblogs_main_mtl_mylogsbundle_vmylogs';
    }

}
