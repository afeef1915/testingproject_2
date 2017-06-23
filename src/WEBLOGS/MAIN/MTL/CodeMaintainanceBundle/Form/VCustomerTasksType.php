<?php

namespace WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VCustomerTasksType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('ctk_customer_id')
            ->add('ctk_code')
            ->add('ctk_name')
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
            'data_class' => 'WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\VCustomerTasks'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_codemaintainancebundle_vcustomertasks';
    }
}
