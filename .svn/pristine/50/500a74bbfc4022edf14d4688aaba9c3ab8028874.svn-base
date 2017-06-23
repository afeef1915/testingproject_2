<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityRepository;
use WEBLOGS\CORE\Services\WEBLOGSConstants;
use Symfony\Component\Validator\Constraints\Date;

class NewResponseType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
                ->add('job_no', 'text', array(
                    'label' => 'Job No',
                    'required' => false,
                ))
                ->add('customer', 'entity', array(
                    'label' => 'Customer',
                    'required' => false,
                    'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyemailBundle:VWwvCustomers',
                    'property' => 'name',
                    
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
                ->add('customer_log_id', 'text', array(
                    'label' => 'Customer Log Id',
                    'required' => false,
                ))
                //->add('customer_log_id')
                ->add('category', 'choice', array(
                    'label' => 'Log Category',
                    'required' => false,
                    'choices' => $options['category']
                        //'empty_value' => ' ',
                        //'mapped' => false,
                        
                ))
                ->add('attention_of', 'choice', array(
                    'label' => 'Attention Of',
                    'required' => false,
                    'choices' => $options['attentionOf'],
                    'attr' => array(
                        'class' => 'attention_of_edit'
                    )
                        //'mapped' => false,
                ))
                ->add('task_description', 'choice', array(
                    'label' => 'Log Task',
                    'required' => false,
                    'choices' => $options['taskDescription']
                        //'empty_value' => ' ',
//                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:CustomerTasks',
//                    'property' => 'ctk_name',
//                     'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->where('fg.ctk_customer_id=:ctk_customer_id')
//                            ->setParameter('ctk_customer_id', 'PCSW')
//
//                    ;
                        // },
                        //'mapped' => false,
                ))
//                ->add('requested', 'datetime', array(
//                    'widget' => 'single_text',
//                    'label' => 'Date Requested',
//                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                    'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\Date(),
////                        new \Symfony\Component\Validator\Constraints\NotBlank()
//                    ),
//                    'eserv_extra_validation' => array(
//                        'date' => array(
//                            'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                        )
//                    ),
//                    'required' => false
//                ))
               ->add('requested', 'datetime', array(
                    'label' => 'Date Requested',
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
              
                ->add('date_completed', 'datetime', array(
                    'label' => 'DATE COMPLETED',
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
//                ->add('date_completed', 'datetime', array(
//
//                    'widget' => 'single_text',
//
//                    'label' => 'DATE COMPLETED',
//                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//
//                    'required' => false
//                )) 
//                ->add('date_completed', 'datetime', array(
//                    'widget' => 'single_text',
//                    'label' => 'Date Completed',
//                   
////                     'format' => WEBLOGSConstants::DATEPICKER_DATE_FORMAT,
//                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                    // 'dateCompleted' => new \Date(),
//                    'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\Date(),
////                        new \Symfony\Component\Validator\Constraints\NotBlank()
//                    ),
//                    'eserv_extra_validation' => array(
//                        'date' => array(
//                             'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                        )
//                    ),
//                    'required' => false
//                ))
                ->add('priority', 'entity', array(
                    'label' => 'Priority',
                    'required' => true,
                    //'empty_value' => ' -- Choose an option -- ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VWwvPriorityLevel',
                    'property' => 'DESCRIPTION',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('fg')
                                ->orderBy('fg.PRIORITY_ORDER', 'DESC')
                        ;
                    },
                ))
                ->add('title', 'text', array(
                    'label' => 'Brief Description',
                    'required' => false,
                ))
                ->add('brief_description', 'textarea', array(
                    'label' => 'Description',
                    'required' => false,
                ))
                ->add('mtl_status', 'entity', array(
                    'label' => 'MTL Status',
                    'required' => false,
                    //'empty_value' => '',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VWwvLogAction',
                    'property' => 'DESCRIPTION',
                        //'mapped' => false,
                ))
                ->add('developer_status', 'entity', array(
                    'label' => 'Log Status',
                    'required' => false,
                    //'empty_value' => '',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:LogClientStatus',
                    'property' => 'DESCRIPTION',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('fg')
//                            ->orderBy('fg.customerId', 'ASC')
//                    ;
//                },
                ))
                ->add('assigned_to', 'entity', array(
                    'label' => 'Contact/AssignedTo',
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
                ->add('chargeable', 'choice', array(
                    'label' => 'Chargeable',
                    'required' => false,
                    'choices' => array(
                        'Y' => "Yes",
                        'N' => "No",
                    ),
                        //'mapped' => false,
                ))
                ->add('mlo_quote_id', 'text', array(
                    'label' => 'Quote Id',
                    'required' => false,
                        //'mapped' => false,
                ))
                ->add('completed_by', 'entity', array(
                    'label' => 'Completed By',
                    'required' => false,
                    'empty_value' => ' ',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VPersons',
                    'property' => 'fullname',
                        //           'mapping'=>false,
                ))
                ->add('dev_status', 'entity', array(
                    'label' => 'Developer Status',
                    'required' => false,
                    'empty_value' => '',
                    'class' => 'WEBLOGSMAINMTLMyLogsBundle:VWwvLogAction',
                    'property' => 'DESCRIPTION',
                        //   'mapping'=>false,
                ))
                ->add('requested_by', 'text', array(
                    'label' => 'Requested By',
                    'required' => false,
                        //'mapped' => false,
                ))
                ->add('dueby', 'datetime', array(
                    'widget' => 'single_text',
                    'label' => 'Due By',
                    
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,                    
                    
              
//                    //'format' => WEBLOGSConstants::DATEPICKER_DATE_FORMAT,
//                    //'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                    'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\Date(),
////                        new \Symfony\Component\Validator\Constraints\NotBlank()
//                    ),
//                    'eserv_extra_validation' => array(
//                        'date' => array(
//                            'format' => \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                        )
//                    ),
                    'required' => false
                ))
                ->add('save', 'submit')
                ->setMethod('POST')
                ->getForm()
        ;
//        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
//            $data = $event->getData();
//            $form = $event->getForm();
////            if ($form->has('category')) {
////                $form->remove('category');
////            }
////
////            $form->add('category', 'choice', array(
////                'choices' => array($data['category'] => 'Whatever'),
////            ));
////
////            if ($form->has('attention_of')) {
////                $form->remove('attention_of');
////            }
////
////            $form->add('attention_of', 'choice', array(
////                'choices' => array($data['attention_of'] => 'Whatever'),
////            ));
////
////            if ($form->has('task')) {
////                $form->remove('task');
////            }
////
////            $form->add('task', 'choice', array(
////                'choices' => array($data['task'] => 'Whatever'),
////            ));
//        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'taskDescription' => array(),
            'attentionOf' => array(),
            'category' => array()
                //'dateCompleted'=>array()
                //     'data_class' => 'WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\VMyLogs'
        ));
    }

    /**
     * @return string
     */
    public function getName() {

         return 'weblogs_main_mtl_mylogsbundle_newresponsetype';

    }

}
