<?php

namespace ESERV\MAIN\TemplateBundle\Form\Header;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TemplateType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder            
            ->add('name', 'text', array(
                'required' => true,
                'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank(),
                        new \Symfony\Component\Validator\Constraints\Length(array('max' => 100))
                    )
            ))
            ->add('code', 'text', array(
                'required' => true,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\NotBlank(),
                    new \Symfony\Component\Validator\Constraints\Length(array('max' => 10))
                )
            ))            
            ->add('content', 'textarea', array(
                'label' => 'Content',
                'attr' => array(
                    'ck-editor' => '',
                    'data-ng-model' => 'templateContentNGModel'
                ),
                'required' => true,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\NotBlank()
                )
            ))
            ->add('language', 'entity', array(
                    'class' => 'ESERV\MAIN\SystemConfigBundle\Entity\Language',
                    'property' => 'name',                    
                    'label' => 'Language',
                    'empty_value' => ' -- Please Select -- ', 
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
//            ->add('version', 'text', array('data' => 1))
            ->add('version', 'hidden', array('data' => 1))
//            ->add('isDefault')
//            ->add('reportId')
            
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
            
//            ->add('mailMergeType')
//            ->add('templateDocumentGroup')
//            ->add('systemPrinter')
//            ->add('header')
//            ->add('footer')
//            ->add('templateType')
            ->add('save', 'submit')
            ->setMethod('POST')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\TemplateBundle\Entity\Template'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eserv_main_templatebundle_header_template';
    }
}
