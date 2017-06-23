<?php

namespace ESERV\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EservClientWelshlanguageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entityId')
            ->add('welshspeaker')
            ->add('welshmediumteacher')
            ->add('welsh2ndlanguage')
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\ClientBundle\Entity\EservClientWelshlanguage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_clientbundle_eservclientwelshlanguage';
    }
}
