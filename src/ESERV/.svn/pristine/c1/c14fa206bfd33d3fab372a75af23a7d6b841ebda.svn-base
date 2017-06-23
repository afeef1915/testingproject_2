<?php

namespace ESERV\MAIN\QualificationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class QualificationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('code')
                ->add('name')
                ->add('qualType', 'entity', array('required' => false,
                    'class' => 'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('a')
                        ->leftJoin('a.applicationCodeType', 'act')
                        ->where('act.code = :app_code_type ')
                        ->setParameter('app_code_type', \ESERV\MAIN\Services\AppConstants::ACT_QUTYPE)
                        ->orderBy('a.name', 'ASC');
                }))
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
                ->add('save', 'submit')
                ->setMethod('POST');    
                     
                $alt_languages = $options['alt_languages'];
                foreach($alt_languages as $alt_language){             
                     $builder->add($alt_language, 'text', array('mapped' => false, 'required' => false));
                }   
                     
                $qual_mand_controls = $options['qual_mand_controls'];
                foreach($qual_mand_controls as $qual_mand_control_id => $org_name){                     
                     $builder->add($qual_mand_control_id, 'checkbox', array('mapped' => false, 'required' => false, 'label' => 'Qual Mandatory - '.$org_name));  
                }   
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\QualificationBundle\Entity\Qualification',
            'alt_languages' => array(),            
            'qual_mand_controls' => array(),            
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_qualificationbundle_qualification';
    }

}
