<?php

namespace ESERV\MAIN\AdministrationBundle\Form\InterfaceForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ESERV\MAIN\Services\AppConstants;
use Doctrine\ORM\EntityRepository;

class ImportType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fosUserId', 'text', array(
                    'data' => 1
                ))
                ->add('name', 'text')
                ->add('category', 'choice', array(
                    'choices' => $options['extra_params'],
                    'empty_value' => ' -- Please Select -- ',
                ))
                ->add('membershipOrg', 'choice', array(
                    'label' => 'Registration Category', 
                    "choices" => $options['membership_org_choice'], 
                    'empty_value' => ' -- Please Select -- ',
                    'required' => false,
                ))
                ->add('description', 'text', array(
                    'label' => 'Description',
                    'required' => false,    //In response to Log: 9041856
                ))
                ->add('priority', 'entity', array(
                    'class' => 'ESERV\MAIN\SystemConfigBundle\Entity\SystemCode',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.systemCodeType', 'sct')
                                ->where('sct.code = :emt')
                                ->setParameter('emt', AppConstants::SCT_NOTIFICATION_PRIORITY);
                    },
                    'label' => 'Priority',
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                    ),
                    'required' => true,
                ))
                ->add('attachment', 'text', array(
                    'label' => 'Document'
                ))
                ->add('processed', 'text', array(
                    'data' => 'N'
                ))
                ->add('save', 'submit')
                ->setMethod('POST')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            //'data_class' => ''
            'extra_params' => array(),
            'membership_org_choice' => array(),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_administration_import_form';
    }
    
}
