<?php

namespace ESERV\MAIN\TemplateBundle\Form\Email;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use ESERV\MAIN\Services\AppConstants;

class TemplateType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('header', 'entity', array(
                    'class' => 'ESERV\MAIN\TemplateBundle\Entity\Template',
                    'property' => 'name',
                    'label' => 'Header',
                    'empty_value' => ' -- Please Select -- ',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.templateType', 'tt')
                                ->where('tt.code = :code')
                                ->setParameter('code', AppConstants::TEMPLATE_TYPE_HEADER_CODE)
                        ;
                    },
                    'constraints' => array(
                    ),
                    'required' => false
                ))
                ->add('footer', 'entity', array(
                    'class' => 'ESERV\MAIN\TemplateBundle\Entity\Template',
                    'property' => 'name',
                    'label' => 'Footer',
                    'empty_value' => ' -- Please Select -- ',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.templateType', 'tt')
                                ->where('tt.code = :code')
                                ->setParameter('code', AppConstants::TEMPLATE_TYPE_FOOTER_CODE)
                        ;
                    },
                    'constraints' => array(
                    ),
                    'required' => false
                ))
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
                ->add('mailMergeType', 'entity', array(
                    'class' => 'ESERV\MAIN\TemplateBundle\Entity\MailMergeType',
                    'property' => 'value',
                    'label' => 'Mail Merge Type',
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))
                ->add('templateDocumentGroup', 'entity', array(
                    'class' => 'ESERV\MAIN\SystemConfigBundle\Entity\SystemCode',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->leftJoin('u.systemCodeType', 'sct')
                                ->where('sct.code = :emt')
                                ->setParameter('emt', AppConstants::SCT_TEMPLATE_DOCUMENT_GROUP_CODE);
                    },
                    'label' => 'Template Document Group',
                    'empty_value' => ' -- Please Select -- ',
                    'constraints' => array(
                    ),
                    'required' => true,
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
//                ->add('version', 'text', array(
//                    'data' => 1
//                ))
                ->add('version', 'hidden', array('data' => 1))
                ->add('save', 'submit')
                ->setMethod('POST')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ESERV\MAIN\TemplateBundle\Entity\Template'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_templatebundle_header_template';
    }

}
