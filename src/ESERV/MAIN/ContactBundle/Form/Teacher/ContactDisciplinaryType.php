<?php

namespace ESERV\MAIN\ContactBundle\Form\Teacher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ContactDisciplinaryType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('disciplinaryNote')
            ->add('startDate' , 'date', 
                    array(
                        'widget'=>'single_text', 
                        'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                        'label' => 'Start Date',  
                        'eserv_extra_validation' => array(
                            'date' => array(
                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                            )
                        ),
            ))
            ->add('endDate', 'date', 
                    array(
                        'widget'=>'single_text', 
                        'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                        'label' => 'End Date',                            
                        'eserv_extra_validation' => array(
                            'date' => array(
                                'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                            )
                        ),
            ))            

            ->add('discType', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 
                            'property'=>'name',
                            'empty_value' => ' -- Please Select -- ',
                            'label' => 'Restriction Description',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')
                                        ->leftJoin('u.applicationCodeType','act')
                                        ->where('act.code = :emt')
                                        ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_RESTRICTION_BARRING);
                            }
            ))
            ->add('webEnabled', 'entity', 
                        array(
                            'class'=>'ESERV\MAIN\SystemConfigBundle\Entity\SystemCode', 
                            'property'=>'name',
                            'empty_value' => ' -- Please Select -- ',
                            'label' => 'Live / Expired Web Display Options',
//                            'multiple' => false,
//                            'expanded' => true,                            
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('u')
                                        ->leftJoin('u.systemCodeType','act')
                                        ->where('act.code = :emt')
                                        ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::SCT_RESTRICTIONS_WEB_ENABLED_OPTION);
                            }
            ))
//            ->add('contact')            
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')   
            ->add('save', 'submit')
            ->setMethod('POST')     
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\ContactDisciplinary'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_contactdisciplinary';
    }
}
