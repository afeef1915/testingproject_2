<?php

namespace ESERV\MAIN\TemplateBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class TemplateType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('content', 'textarea', array(
                    'label' => 'Content',
                    'attr' => array(
                        'ck-editor' => '',
                        'data-ng-model' => 'templateContentNGModel'
                    ),
                    'required' => true
                ))
                ->add('code')
                ->add('name')
                ->add('templateType', 'entity', array('class' => 'ESERV\MAIN\TemplateBundle\Entity\TemplateType', 'property' => 'name'))
        ;

        $alt_languages = $options['alt_languages'];
        foreach ($alt_languages as $alt_language) {
            $builder->add($alt_language, 'text', array('mapped' => false, 'required' => false));
        }

        $builder->add('save', 'submit')
                ->setMethod('POST');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\TemplateBundle\Entity\Template',
            'alt_languages' => array(),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_templatebundle_template';
    }

}
