<?php

namespace ESERV\MAIN\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entityId')
            ->add('entityName')
            ->add('priorityId')
            ->add('parentId')
            ->add('shortDescription')
            ->add('activityDateTime', 'date', array(                    
                    'label' => 'Start Date',
                    'widget'=>'single_text',                   
                    'required' => false,
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    ),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date(),
                    ),
            ))
            ->add('statusDateTime', 'date', array(                    
                    'label' => 'Start Date',
                    'widget'=>'single_text',                   
                    'required' => false,
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                        )
                    ),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Date(),
                    ),
            ))
            ->add('longDescription')
            ->add('adviceGiven')
            ->add('isDeleted')
            ->add('reissue')
            ->add('showAlert')
            ->add('isReminder')
            ->add('noOfReminders')
            ->add('firstReminderDays')
            ->add('subsequentReminderDays')
            ->add('commFirstName')
            ->add('commLastName')
            ->add('commPhoneNo')
            ->add('commEmail')
            ->add('save', 'submit')
            ->setMethod('POST')  
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')                
//            ->add('sourceContact') 
//            ->add('activityCategory')
//            ->add('status')
//            ->add('activitySet')
//            ->add('activitySubCategory')
//            ->add('commTitle')
//            ->add('templateVersion')
        ;
        
        #var_dump($params = $options['params']);die;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ActivityBundle\Entity\Activity',
            'params'=>array(),
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_activitybundle_activity';
    }
}
