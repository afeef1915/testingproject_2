<?php

namespace ESERV\MAIN\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivitySubCategoryType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('description')
            ->add('defaultActivityDescription')
            ->add('activityCategory', 'entity', array('class' => 'ESERV\MAIN\ActivityBundle\Entity\ActivityCategory', 'property' => 'description'));
        
            $alt_languages = $options['alt_languages'];
            foreach($alt_languages as $alt_language){             
                 $builder->add($alt_language, 'text', array('mapped' => false, 'required' => false));
            }   
            
            $builder
            ->add('save', 'submit')
            ->setMethod('POST');        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory',
            'alt_languages' => array(),    
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_activitybundle_activitysubcategory';
    }
}
