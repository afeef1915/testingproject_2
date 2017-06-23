<?php

namespace ESERV\MAIN\CommunicationsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ESERV\MAIN\CommunicationsBundle\Form\DataTransformer\ActivityCategoryToNumberTransformer;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class LetterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options) {
        // this assumes that the entity manager was passed in as an option
        $extra_data = $options['extra_data'];
        $short_desc = '';
        $entityManager = $options['em'];
        $transformer = new ActivityCategoryToNumberTransformer($entityManager);

        $qb = $entityManager->createQueryBuilder();
        
        $targets = array();
        if (count($extra_data['target_contact']) > 0) {
            $contacts = $qb->select('c.id AS id, c.displayName AS displayName')
                           ->from('ESERVMAINContactBundle:Contact', 'c')
                           ->where('c.id IN (:ids)')
                           ->setParameter('ids', $extra_data['target_contact'])
                           ->getQuery()
                           ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);            
            foreach ($contacts as $key => $value) {
                $targets[$value['id']] = $value['displayName'];
                $short_desc .= $value['displayName'].'<br/>';
            }
        }
        $builder
                ->add('status_id', 'hidden', array('mapped' => false, 'data' => $extra_data['status_id']))
//                ->add('query', 'hidden', array('mapped' => false, 'data' => $options['commsSql']))
                ->add('entityId', 'hidden', array('data' => $extra_data['entity_id']))
                ->add('entityName', 'hidden', array('data' => $extra_data['entity_name']))
                ->add('csl_code'
                     ,'hidden'
                     ,array('mapped' => false
                           ,'data' => (array_key_exists('csl_code', $extra_data) ? $extra_data['csl_code'] : '')
                           )
                     )
                ->add('comm_type'
                     ,'hidden'
                     ,array('mapped' => false
                           ,'data' => (array_key_exists('comm_type', $extra_data) ? $extra_data['comm_type'] : \ESERV\MAIN\Services\AppConstants::COMM_LETTER)
                           )
                     )
                ->add(
                        $builder->create('activityCategory', 'hidden')
                        ->addModelTransformer($transformer)
                )
                ->add('templateVersion', 'entity', array(
                    'class' => 'ESERVMAINTemplateBundle:EservVCurrTemplateVersion',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                                ->where('t.templateTypeCode = :letter_code')
                                ->setParameter('letter_code', \ESERV\MAIN\Services\AppConstants::TEMPLATE_TYPE_LETTER_CODE)
                        ;
                    },
                    'property' => 'name',
                    'mapped' => false,
                    'label' => 'Template',
                    'empty_value' => '-- Please Select --',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\NotBlank()
                    )
                ))                            
                ->add('temp_ver_edit'
                     ,'checkbox'
                     ,array(
                          'mapped' => false
                         ,'label' => 'Edit'
                         ,'required' => false
                      )     
                )
                ->add('targets', 'choice', array(
                    'multiple' => true,
                    'choices' => $targets,
                    'label' => 'Recipient(s)',
                    'mapped' => false,
                    'data' => $extra_data['target_contact']
                ))
                ->add('print_now'
                     ,'checkbox'                     
                     ,array(
                          'required' => false
                         ,'mapped' => false
                         ,'label' => 'Print Now'
                      )
                )
            ;
            if ($extra_data['entity_id'] == '') {
                $builder->add('shortDescription'
                             ,'text'
                             ,array(
                                  'label' => 'Description'
                                 ,'required' => true));
            } else {
                $builder->add('shortDescription', 'hidden', array('data' => $short_desc));
            }
            $builder->add('longDescription', 'textarea', array(
                          'label' => 'Content',
                          'attr' => array(
                                        'ck-editor' => '',
                                        'data-ng-model' => 'shortDescriptionNGModel'
                                         ),
                          'required' => true))
                    ->add('commsQ', 'hidden', array(
                    'required' => false,
                    'data' => $options['commsSql'],
                    'mapped' => false
                ))
            ;
            $builder->add('save', 'submit');
            $builder->setMethod('POST');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                    'data_class' => 'ESERV\MAIN\ActivityBundle\Entity\Activity',
                    'extra_data' => array('view_now'),
                    'commsSql' => ''
                ))
                ->setRequired(array(
                    'em',
                ))
                ->setAllowedTypes(array(
                    'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_communicationsbundle_letter';
    }

}
