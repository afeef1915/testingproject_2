<?php

namespace ESERV\MAIN\ContactBundle\Form\Teacher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PersonMainType extends AbstractType { 

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', 'entity', array(
                    'empty_value' => ' -- Please Select -- ',
                    'label' => 'Title',
                    'required' => false,
                    'property' => 'name',
                    'class' => 'ESERVMAINSystemConfigBundle:Title'
                ))
                ->add('lastName', 'text', array(
                    'label' => 'Surname',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('firstName', 'text', array(
                    'label' => 'Forename(s)',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
//                ->add('previousLastName', 'text', array(
//                    'label' => 'Previous Surname',
//                    'required' => false
//                ))
                ->add('gender', 'choice', array(
                    'choices' => array('M' => 'Male', 'F' => 'Female'),
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('dateOfBirth', 'date', array(
                    'widget' => 'single_text',
                    'format' => \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank(),
                        new \Symfony\Component\Validator\Constraints\Date()
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                            'yearrange' => '-120:-'.\ESERV\MAIN\Services\AppConstants::ORGANISATION_MIN_AGE,
                        )
                    )
                ))
                ->add('disabled', 'checkbox', array(
                    'label' => 'Disabled',
                    'required' => false
                ))
                ->add('lastNameSearch', 'hidden', array(
                    'data' => '.'
                ))                
                ->add('ethnicGroup', 'entity', array(
                    'empty_value' => ' -- Please Select -- ',
                    'class' => 'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode',
                    'property' => 'name',
                    'required' => false,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.applicationCodeType', 'act')
                                ->where('act.code = :emt')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_ETHNIC_GROUP);
                    }
                ))
                ->add('nationalen', 'entity', array(
                    'empty_value' => ' -- Please Select -- ',
                    'class' => 'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode',
                    'label' => 'National Identity',
                    'property' => 'name',
                    'required' => false,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.applicationCodeType', 'act')
                                ->where('act.code = :emt')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_NATIONAL_IDENTITY);
                    }
                ))
                ->add('referenceNo', 'text', array(
                    'label' => 'Ref No',
                    'required' => false,
                    'max_length' => 7,
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Length(array(
                            'min' => 7,
                            'max' => 7
                                ))
                    )
                ))
                ->add('niNumber', 'text', array(
                    'label' => 'NI Number',
                    'required' => false,
                    'eserv_extra_validation' => array(
                        'lettercase' => 'upper',
                        'regexp' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::NI_NUMBER_REG_EXP,
                            'error_msg' => \ESERV\MAIN\Services\AppConstants::NI_NUMBER_REG_EXP_ERROR,
                        )
                    ),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Regex(array(
                            'pattern' => \ESERV\MAIN\Services\AppConstants::NI_NUMBER_REG_EXP,
                            'match' => true,
                            'message' => \ESERV\MAIN\Services\AppConstants::NI_NUMBER_REG_EXP_ERROR,
                                ))),      
        ));

        $builder
                ->add('save', 'submit')
                ->setMethod('POST')
                ->getForm()
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\Person'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_contactbundle_person_main';
    }

}
