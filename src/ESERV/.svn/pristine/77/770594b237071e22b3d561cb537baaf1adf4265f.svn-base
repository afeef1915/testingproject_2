<?php

namespace ESERV\MAIN\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrganisationType1 extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact', new ContactType())
            ->add('person', new ContactSubtypeType())
            ->add('name')
            ->add('previousName')
            ->add('code')
            ->add('dateOpened')
            ->add('dateClosed')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('createdBy')
            ->add('updatedBy')
            ->add('contact')
            ->add('save', 'submit')    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ContactBundle\Entity\Organisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_contactbundle_organisation';
    }
}
