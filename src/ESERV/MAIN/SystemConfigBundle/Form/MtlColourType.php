<?php

namespace ESERV\MAIN\SystemConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MtlColourType extends AbstractType 
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('code', 'text', array(
                    'label' => 'Code',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('name', 'text', array(
                    'label' => 'Name',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('htmlCode', 'hidden', array(
                    'label' => 'HTML Code',
                    
                ))
                ->add('rgbRed', 'hidden', array(
                    'label' => 'RGB Red',                    
                ))
                ->add('rgbGreen', 'hidden', array(
                    'label' => 'RGB Green',                    
                ))
                ->add('rgbBlue', 'hidden', array(
                    'label' => 'RGB Blue',                    
                ))
                ->add('hsvHue', 'hidden', array(
                    'label' => 'HSV Hue',                    
                ))
                ->add('hsvSaturation', 'hidden', array(
                    'label' => 'HSV Saturation',                    
                ))
                ->add('hsvValue', 'hidden', array(
                    'label' => 'HSV Value',                    
                ))
                ->add('isWebsafe', 'hidden', array(
                    'label' => 'Websafe',                    
                ))
                //cssClass=mtl_code_status
                ->add('save', 'submit')
                ->setMethod('POST');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {        
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\SystemConfigBundle\Entity\MtlColour'
        ));
    }
    
    public function getName() 
    {
        return 'system_config_mtl_colour';
    }

}
