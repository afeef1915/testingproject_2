<?php

namespace ESERV\MAIN\ContactBundle\Form\Teacher;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AddressType extends AbstractType {
       /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $required = false; 
        if (array_key_exists('enable_required_fields',$options)) {
            if ($options['enable_required_fields'] == true) {
                $required = true;
            }
        }        
        $builder->add('addressType', 'entity', array(
                    'label' => 'Address Type',
                    'required' => $required,
                    'empty_value' => ' -- Please Select -- ',
                    'class' => 'ESERVMAINContactBundleComponentsContactDetailsBundle:AddressType',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.contactType', 'ct')
                                ->andWhere('ct.code = :ctc')
                                ->setParameter('ctc', 'P')
                        ;
                    },
                ))
                ->add('primaryRecord', 'checkbox', array(
                    'label' => 'Primary',
                    'required' => false,
                ))
                ->add('postcode', 'text', array(
                    'required' => false,
                    'eserv_extra_validation' => array(
                        'lettercase' => 'upper',
                        //'uk_postcode' => 'uk_postcode',
//                        'regexp' => array(
//                            'format' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP,
//                            'error_msg' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP_ERROR,
//                        )
                    ),                    
                    'constraints' => array(
//                        new \Symfony\Component\Validator\Constraints\Regex(array(
//                            'pattern' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP,
//                            'match' => true,
//                            'message' => \ESERV\MAIN\Services\AppConstants::UK_POSTCODE_REG_EXP_ERROR,
//                        ))
                     ),
                ))
                ->add('addressLine1', 'text', array('required' => $required))
                ->add('addressLine2', 'text', array('required' => false))
                ->add('addressLine3', 'text', array('required' => false))
                ->add('town', 'text', array('required' => $required))
                ->add('county', 'text', array('required' => false))
                ->add('save', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address',
            'enable_required_fields' => false,
        )) ;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_contactbundle_components_contactdetailsbundle_address';
    }

}
