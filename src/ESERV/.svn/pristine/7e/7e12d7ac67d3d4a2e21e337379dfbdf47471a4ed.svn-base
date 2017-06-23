<?php

namespace ESERV\MAIN\ContactBundle\Form\Mentor;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;

class PersonType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('referenceNo', 'text', array(
                    'label' => 'Ref No',
                    'constraints' => array(
                           new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
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
                    'widget'=>'single_text', 
                    'format'=> \ESERV\MAIN\Services\AppConstants::SYMFONY_DATE_FORMAT,
                    'constraints' => array(                           
                           new \Symfony\Component\Validator\Constraints\Date()
                    ),
                    'eserv_extra_validation' => array(
                        'date' => array(
                            'format' => \ESERV\MAIN\Services\AppConstants::DATEPICKER_DATE_FORMAT,
                            'yearrange' => '-120:-'.\ESERV\MAIN\Services\AppConstants::ORGANISATION_MIN_AGE,
                        )
                    ),
                    'required' => false
                ))
                ->add('disabled', 'checkbox', array(
                    'label' => 'Disabled',
                    'required' => false
                ))
                ->add('lastNameSearch', 'hidden', array())
                ->add('contact', new ContactType())                
                ->add('address', new AddressType())
                ->add('phone', new PhoneType())
                ->add('mobile', new MobileType())
                ->add('email', new EmailType())
                ->add('ethnicGroup', 'entity', array(
                    'empty_value' => ' -- Please Select -- ',
                    'class' => 'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.applicationCodeType','act')
                                ->where('act.code = :emt')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_ETHNIC_GROUP);
                    }, 
                    'constraints' => array(                        
                    ),
                    'required' => false
                ))
                ->add('nationalen', 'entity', array(
                    'empty_value' => ' -- Please Select -- ',
                    'class' => 'ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode', 
                    'label' => 'National Identity',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.applicationCodeType','act')
                                ->where('act.code = :emt')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_NATIONAL_IDENTITY);
                    },
                    'constraints' => array(                           
                    ),
                    'required' => false
                ))
                         
                ;
        
            $tables = $options['client_table_name_array'];            

            foreach ($tables as $key => $value) {
                $location = $value['location'];                
                $builder->add($value['name'], new $location(), array('mapped' => false));
            }

        $builder
                ->add('save', 'submit')
                ->setMethod('POST')
                ->getForm();
        
        $builder->addEventListener(FormEvents::BIND, function($event) {           
            $data = $event->getData();

            $firstName = $data->getFirstName();
            $lastName = $data->getLastName();
            $displayName = trim($firstName).' '.trim($lastName);
            
            $data->getContact()->setDisplayName($displayName);
            $event->setData($data);
            $getDisabled = $data->getDisabled();
            
            if(isset($getDisabled) && $data->getDisabled() === 1){
                $data->setDisabled('Y');
                $event->setData($data);
            } else {                         
                $data->setDisabled('N');
                $event->setData($data);
            }

        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\Person',
            'client_table_name_array' => array()
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_mentor_person';
    }
}
