<?php

namespace ESERV\MAIN\CommunicationsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ESERV\MAIN\CommunicationsBundle\Form\DataTransformer\ActivityCategoryToNumberTransformer;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class NoteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        // this assumes that the entity manager was passed in as an option
        $entityManager = $options['em'];
        $transformer = new ActivityCategoryToNumberTransformer($entityManager);

        $builder
                ->add('entityId', 'hidden')
                ->add('entityName', 'hidden')
                ->add('shortDescription', 'text', array(
                    'required' => true
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
                    'required' => true,
                    'attr' => array(
                        'rows' => '10'
                    )
                ))
                ->add(
                        $builder->create('activityCategory', 'hidden')
                        ->addModelTransformer($transformer)
                )
                ->add('showAlert', 'checkbox', array(
                    'required' => false
                ))
                ->add('commsQ', 'hidden', array(
                    'required' => false,
                    'data' => $options['commsSql'],
                    'mapped' => false
                ))
                ->add('save', 'submit')
                ->setMethod('POST');

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

        // Get Activity complete status    
        $activity_complete_status = $entityManager->getRepository('ESERVMAINSystemConfigBundle:SystemCode')
                ->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_COMPLETE_CODE);
        // Setting activity 'status' to complete by default for note
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use($activity_complete_status) {
            $note = $event->getData();
            $note->setStatus($activity_complete_status);
            $event->setData($note);
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                    'data_class' => 'ESERV\MAIN\CommunicationsBundle\Entity\Note',
                    'commsSql' => ''
                ))
                ->setRequired(array(
                    'em',
                ))
                ->setAllowedTypes(array(
                    'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_communicationsbundle_note';
    }

}
