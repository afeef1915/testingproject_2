<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VAssignedToType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_display_name')
            ->add('user_id')
            ->add('csev_mtlgroup')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
//            'data_class' => 'WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\VAssignedTo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_mylogsbundle_vassignedto';
    }
}
