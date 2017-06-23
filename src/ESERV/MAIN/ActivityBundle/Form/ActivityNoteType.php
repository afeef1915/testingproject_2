<?php

namespace ESERV\MAIN\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ESERV\MAIN\CommunicationsBundle\Form\DataTransformer\ActivityCategoryToNumberTransformer;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class ActivityNoteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
//        $entityManager = $options['em'];
//        $transformer = new StatusToNumberTransformer($entityManager);

//        $params = $options['params'];
//        $status = $params['status'];

        $builder
            ->add('entityId', 'hidden')
            ->add('entityName', 'hidden')
            ->add('shortDescription', 'text', array(
                    'required' => true,
                    'label' => 'Short Description'
            ))
            ->add('activitySource', 'entity', array(
                    'class' => 'ESERVMAINApplicationCodeBundle:ApplicationCode',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('ac', 'act')
                                ->leftJoin('ac.applicationCodeType', 'act')
                                ->where('act.code = :act ')
                                ->setParameter('act', \ESERV\MAIN\Services\AppConstants::AC_ACTIVITY_SOURCE)
                        ;
                    },
                    'property' => 'name',
                    'label' => 'Method of Contact',
                    'empty_value' => '-- Please Select --',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
            ))                            
            ->add('longDescription', 'textarea', array(
                    'label' => 'Long Description',
                    'attr' => array(
                        'rows' => '10'
                    )
            ))

//            ->add('statusDateTime', 'date', array(                    
//                    'label' => 'Start Date',
//                    'widget'=>'single_text',                   
//                    'required' => false,
//                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
//                    'eserv_extra_validation' => array(
//                        'date' => array(
//                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
//                        )
//                    ),
//                    'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\Date(),
//                    ),
//            ))
                #->add('showAlert', 'mtlcheckbox', array())
                ->add('showAlert', 'checkbox', array(
                    'required' => false,
                    'label' => 'Show Alert'
                ))
                ->add('status', 'entity', array('class' => 'ESERVMAINSystemConfigBundle:SystemCode', 'property' => 'name', 
                    'label' => 'Status',                           'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('sc', 'sct')
                                ->leftJoin('sc.systemCodeType', 'sct')
                                ->where('sct.code = :sct ')
                                ->setParameter('sct', \ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE)
                        ;
                    },
                    ))

                ->add('save', 'submit')
                ->setMethod('POST')
//            ->add('updatedAt')
//            ->add('updatedBy')
        ;     
                    
        // set show_alert to 'Y' if ticked, and to 'N' if not on submit
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $note = $event->getData();
            $form = $event->getForm();

            if (!$note) {
                return;
            }
            // Check whether show alert is ticked or not                                           
            if (1 == $note->getShowAlert()) {
                $note->setShowAlert('Y');
                $event->setData($note);
            } else {
                $note->setShowAlert('N');
                $event->setData($note);
            }
        });
        $builder->addEventListener(FormEvents::PRE_SET_DATA , function (FormEvent $event) {
            $note = $event->getData();
            $form = $event->getForm();

            if (!$note) {
                return;
            }
            // Check whether show alert is ticked or not                                           
            if ('Y' == $note->getShowAlert()) {
                $note->setShowAlert(true);
                $event->setData($note);
            } else {
                $note->setShowAlert(false);
                $event->setData($note);
            }
        });

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ActivityBundle\Entity\Activity',
            'params' => array(),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_activitybundle_activity';
    }

}
