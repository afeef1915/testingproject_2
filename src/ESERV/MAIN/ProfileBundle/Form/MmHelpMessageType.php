<?php

namespace ESERV\MAIN\ProfileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class MmHelpMessageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'textarea', array(
                    'label' => 'Description'
            ))
            ->add('code', 'text')
            ->add('isActive', 'checkbox', array(
                    'label' => 'Active ?',
                    'required' => false,
                    'data' => true
            ))
            ->add('moreLink', 'textarea', array(
                'required' => false,
                'eserv_extra_validation' => array(
                        'regexp' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP,
                            'error_msg' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP_ERROR,
                        )
                    ),                    
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Regex(
                                array(
                                    'pattern' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP,
                                    'match' => true,
                                    'message' => \ESERV\MAIN\Services\AppConstants::WEB_ADDRESS_REG_EXP_ERROR,
                                )
                        )),
            ))
            ->add('messageType', 'entity', array(
                    'class' => 'ESERVMAINSystemConfigBundle:SystemCode',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('sc')
                                      ->innerJoin('sc.systemCodeType', 'sct')
                                      ->where('sct.code = :sct_code')
                                      ->setParameter('sct_code', \ESERV\MAIN\Services\AppConstants::SCT_MM_MESSAGE_TYPE)
                                    ;
                    },
                    'property' => 'name',
                    'label' => 'Message Type'
            ))
            ->add('title', 'text', array(
                'required' => true
            ))
            #->add('createdAt')
            #->add('createdAt', 'datetime', array('date_widget' => 'single_text', 'attr' => array('class' => 'display_non')))
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
            ->add('severity', 'entity', array(
                    'class' => 'ESERVMAINSystemConfigBundle:SystemCode',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('sc')
                                      ->innerJoin('sc.systemCodeType', 'sct')
                                      ->where('sct.code = :sct_code')
                                      ->setParameter('sct_code', \ESERV\MAIN\Services\AppConstants::SCT_MM_SEVERITY_TYPE)
                                    ;
                    },
                    'property'=>'name',
            ))
            ->add('save', 'submit')
            ->setMethod('POST')    
        ;
        
        // set show_alert to 'Y' if ticked, and to 'N' if not 
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $help_message = $event->getData();
                $form = $event->getForm();

                if (!$help_message) {
                    return;
                }
                // Check whether show alert is ticked or not                                           
                if(  1 == $help_message->getIsActive()){
                    $help_message->setIsActive('Y');
                    $event->setData($help_message);
                } else {                         
                    $help_message->setIsActive('N');
                    $event->setData($help_message);
                }
            });
            
        // set show_alert to 'Y' if ticked, and to 'N' if not 
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $help_message = $event->getData();
            $form = $event->getForm();

            if (!$help_message) {
                return;
            }

             // check if the Help Message object is "not new" then transform
             // 'Y' to true and 'N' to false for the form type
             if ($help_message || null !== $help_message->getId()) {                                 
                 if($help_message->getIsActive() == 'Y'){
                     $help_message->setIsActive(true);
                      $event->setData($help_message);
                 }else{
                     $help_message->setIsActive(false);
                     $event->setData($help_message);
                 }
             }                         
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ProfileBundle\Entity\MmHelpMessage',
            'alt_languages' => array(),   
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_profilebundle_mmhelpmessages';
    }
}
