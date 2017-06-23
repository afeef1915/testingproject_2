<?php

namespace ESERV\MAIN\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ESERV\MAIN\Services\AppConstants;
use Doctrine\ORM\EntityRepository;

class ContactStatusType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contactType', 'entity', array(
                    'empty_value' => ' -- Please Select -- ',
                    'label' => 'Contact Type',
                    'property' => 'name',
                    'class' => 'ESERVMAINContactBundle:ContactType',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('statusType', 'entity', array(
                    'class' => 'ESERV\MAIN\SystemConfigBundle\Entity\SystemCode',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.systemCodeType', 'sct')
                                ->where('sct.code = :emt')
                                ->setParameter('emt', AppConstants::SCT_STATUS_TYPE);
                    },
                    'label' => 'Status Type',
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                ))
                ->add('code', 'text', array(
                    'label' => 'Code',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('name', 'text', array(
                    'label' => 'Name',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('mtlColour', 'entity', array(
                    'empty_value' => ' -- Please Select -- ',
                    'label' => 'MTL Colour',
                    'required' => false,
                    'property' => 'name',
                    'class' => 'ESERVMAINSystemConfigBundle:MtlColour',
                ))
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
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\ContactStatus'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_contact_status';
    }
}