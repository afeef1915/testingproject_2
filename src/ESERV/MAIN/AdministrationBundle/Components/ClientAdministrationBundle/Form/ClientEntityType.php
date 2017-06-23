<?php

namespace ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientEntityType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entityName')
            ->add('entityDescription')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity\ClientEntity'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_administrationbundle_components_clientadministrationbundle_cliententity';
    }
}
