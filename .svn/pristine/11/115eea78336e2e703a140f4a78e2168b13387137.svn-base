<?php

namespace WEBLOGS\MAIN\MTL\ShowUsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VShowusersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('csev_seq_id')
            ->add('csev_name')
            ->add('csev_title')
            ->add('csev_department')
            ->add('csev_email')
            ->add('csev_telephone_no')
            ->add('csev_extension')
            ->add('customer_name')
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
            'data_class' => 'WEBLOGS\MAIN\MTL\ShowUsersBundle\Entity\VShowusers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_showusersbundle_vshowusers';
    }
}
