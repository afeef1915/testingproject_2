<?php

namespace ESERV\MAIN\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displayName')            
            ->add('contactStatus')
            ->add('statusDate')            
            ->add('createdAt','datetime',array('date_widget' => 'single_text','attr'=>array('class'=>'display_non')))
            ->add('updatedAt','datetime',array('date_widget' => 'single_text','attr'=>array('class'=>'display_non')))
            ->add('createdBy','hidden',array('data' => '1'))
            ->add('updatedBy','hidden',array('data' => '1'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_contact';
    }
}
