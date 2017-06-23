<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class  NewImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attachment', 'text', array(
                    'label' => 'File to upload',
                   'required' => true,
                
                ))
//                 ->add('log_id', 'text', array(
//                    'label' => 'log'
//                ))
//                ->add('membershipOrg', 'choice', array(
//                    'label' => 'Registration Category', 
//                    "choices" => array(
//                    'Y' => 'Yes',
//                    'N' => 'No'
//                ), 
//                    'empty_value' => ' -- Please Select -- ',
//                    'required' => false,
//                ))
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
       //     'data_class' => 'WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\MtlLogs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_mylogsbundle_mtllogs_new_image';
    }
}
