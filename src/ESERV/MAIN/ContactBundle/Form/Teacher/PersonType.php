<?php

namespace ESERV\MAIN\ContactBundle\Form\Teacher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PersonType extends AbstractType {

    public $client_table_name_array;
    public $show_client_fields;
    public $extra;

    public function __construct($ctna, $show_client_fields = true, $extra = array()) {
        $this->client_table_name_array = $ctna;
        $this->show_client_fields = $show_client_fields;
        $this->extra = $extra;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $niNumberRequired = false;
        if(count($this->extra) > 0 && isset($this->extra['niNumber']) && isset($this->extra['niNumber']['required'])){
            $niNumberRequired = $this->extra['niNumber']['required'];
        }
        
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
                ->add('middleName', 'text', array(
                    'label' => 'Middle Name',
                    'required' => false
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
//                            'start_date' => date('d/m/Y'),
//                            'end_date' => date('d/m/Y')
                        )
                    )
                ))
                ->add('disabled', 'checkbox', array(
                    'label' => 'Disabled',
                    'required' => false
                ))
                ->add('lastNameSearch', 'hidden', array())
                ->add('contact', new ContactType())
                ->add('address', new AddressType())
                ->add('phone', new PhoneType())
                ->add('mobileNumber', 'text', array(
                    'required' => false
                ))
                ->add('mobileType', 'entity', array(
                    'mapped' => false,
                    'class' => 'ESERVMAINApplicationCodeBundle:ApplicationCode',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.applicationCodeType', 'act')
                                ->where('u.code = :uc ')
                                ->setParameter('uc', \ESERV\MAIN\Services\AppConstants::AC_MOBILE_NUMBER)
                                ->andWhere('act.code = :atc')
                                ->setParameter('atc', \ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE)
                        ;
                    },
                ))
                ->add('email', new EmailType())
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
                    'required' => $niNumberRequired,
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

        if ($this->show_client_fields) {
            $tables = $this->client_table_name_array;

            foreach ($tables as $key => $value) {
                $location = $value['location'];
                $builder->add($value['name'], new $location());
            }
        }


        $builder
                ->add('save', 'submit')
                ->setMethod('POST')
                ->getForm()
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\Person'
//        ));
//    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_contactbundle_person';
    }

}
