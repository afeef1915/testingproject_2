<?php

namespace WEBLOGS\MAIN\MTL\ShowUsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerContactsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('csev_customer_id')
            ->add('csev_seq_id')
            ->add('csev_name')
            ->add('csev_title')
            ->add('csev_department')
            ->add('csev_email')
            ->add('csev_telephone_no')
            ->add('csev_extension')
            ->add('csev_notes')
            ->add('csev_status_code')
            ->add('csev_status_date')
            ->add('csev_mtlgroup')
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
            'data_class' => 'WEBLOGS\MAIN\MTL\ShowUsersBundle\Entity\CustomerContacts'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_showusersbundle_customercontacts';
    }
}
