<?php

namespace ESERV\MAIN\AdministrationBundle\Form\SystemConfig;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SystemConfigType extends AbstractType 
{
    private $dataArray;
    
    public function __construct($dataArray = null)
    {
        $this->dataArray = $dataArray;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $data = $this->dataArray;
        $builder->add('ESERV01', 'text', array(
                    'label' => (isset($data['ESERV01']) ? $data['ESERV01']['name'] : ''),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),  
                    'data' => (isset($data['ESERV01']) ? $data['ESERV01']['configValue'] : '')
                ))
                ->add('ESERV02', 'text', array(
                    'label' => (isset($data['ESERV02']) ? $data['ESERV02']['name'] : ''),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),                    
                    'data' => (isset($data['ESERV02']) ? $data['ESERV02']['configValue'] : '')
                ))
                ->add('ESERV03', 'text', array(
                    'label' => (isset($data['ESERV03']) ? $data['ESERV03']['name'] : ''),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                    'data' => (isset($data['ESERV03']) ? $data['ESERV03']['configValue'] : '')
                ))
                ->add('ESERV04', 'text', array(
                    'label' => (isset($data['ESERV04']) ? $data['ESERV04']['name'] : ''),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                    'data' => (isset($data['ESERV04']) ? $data['ESERV04']['configValue'] : '')
                ))
                ->add('ESERV05', 'choice', array(
                    'label' => (isset($data['ESERV05']) ? $data['ESERV05']['name'] : ''),
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    ),
                    'choices' => array(
                        'Y' => 'Yes',
                        'N' => 'No'
                    ),
                    'data' => (isset($data['ESERV05']) ? $data['ESERV05']['configValue'] : '')
                ))
                ->add('save', 'submit')
                ->setMethod('POST');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {        
        $resolver->setDefaults(array(
            'data' => array()
        ));
    }
    
    public function getName() 
    {
        return 'edit_system_config';
    }

}
