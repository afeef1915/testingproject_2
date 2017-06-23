<?php

namespace ESERV\MAIN\CommunicationsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ESERV\MAIN\CommunicationsBundle\Form\DataTransformer\ActivityCategoryToNumberTransformer;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class EmailType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
//    protected $contact_id;
//    protected $status_id;
//    protected $act_cat_id;
//    protected $act_data;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        // this assumes that the entity manager was passed in as an option
//        $this->contact_id = $options['contact_id'];
//        $this->status_id = $options['status_id'];
//        $this->act_cat_id = $options['act_cat_id'];
//        $this->act_data = $options['act_data'];
        $extra_data = $options['extra_data'];

        $entityManager = $options['em'];
        $transformer = new ActivityCategoryToNumberTransformer($entityManager);

        $qb = $entityManager->createQueryBuilder();

//print_r($extra_data['targets']); #Array ( [17] => Christopher Sansom (cj@email.com) ) 
//print('<br />');
//print_r($extra_data['target_contact']); #Array ( [0] => 17 )
//die; 
//        $targets = array();
//        $rec_display = '';
//        if (count($extra_data['target_contact']) > 0) {
//            $contacts = $qb->select('c.contactId AS id, c.contactDisplayName AS displayName, c.emailAddress as emailAddress')        
//                           ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail', 'c')
//                           ->where('c.contactId IN (:con_ids)')                    
//                           ->setParameter('con_ids', $extra_data['target_contact'])
//                           ->andWhere('c.primaryRecord = :prim_rec')
//                           ->setParameter('prim_rec', 'Y')
//                           ->getQuery()
//                           ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
//            $targets = array();
//            foreach ($contacts as $key => $value) {           
//                $targets[$value['id']] = $value['displayName'];
//                $rec_display = $value['displayName'];
//            }
//        }
        $builder
                ->add('status_id', 'hidden', array('mapped' => false, 'data' => $extra_data['status_id']))
//                ->add('query', 'hidden', array('mapped' => false, 'data' => $extra_data['query']))
                ->add('entityId', 'hidden', array('mapped' => false, 'data' => $extra_data['entity_id']))
                ->add('entityName', 'hidden', array('mapped' => false, 'data' => $extra_data['entity_name']))
                ->add('csl_code'
                     ,'hidden'
                     ,array('mapped' => false
                           ,'data' => (array_key_exists('csl_code', $extra_data) ? $extra_data['csl_code'] : '')
                           )
                     )
                ->add('comm_type'
                     ,'hidden'
                     ,array('mapped' => false
                           ,'data' => (array_key_exists('comm_type', $extra_data) ? $extra_data['comm_type'] : \ESERV\MAIN\Services\AppConstants::COMM_EMAIL)
                           )
                     )            
//                ->add('source_contact', 'hidden', array(
//                    'mapped' => false,
////                    'data' => $this->contact_id
//                ))
                ->add(
                        $builder->create('activityCategory', 'hidden')
                        ->addModelTransformer($transformer)
                )
                ->add('templateVersion'
                     ,'entity'
                     ,array(
                    'class' => 'ESERVMAINTemplateBundle:EservVCurrTemplateVersion',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                                ->where('t.templateTypeCode = :letter_code')
                                ->setParameter('letter_code', \ESERV\MAIN\Services\AppConstants::TEMPLATE_TYPE_EMAIL_CODE)
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
//                ->add('recipients', 'choice', array(
//                    'multiple' => true,
//                    #'choices' => $targets,
//                    'choices' => $extra_data['targets'],
//                    'mapped' => false,
//                    'data' => $extra_data['target_contact']
//                ))
//                ->add('rec_display', 'hidden', array('mapped' => false, 'data' => $rec_display))
->add('rec_display', 'hidden', array('mapped' => false, 'data' => $extra_data['rec_display']))                            
//                ->add('recipient_email', 'hidden', array('mapped' => false, 'data' => implode(',', $recipient_email)))                            
                ->add('shortDescription', 'text', array('label' => 'Subject'))
                ->add('longDescription'
                     ,'textarea'
                     ,array('label' => 'Content',
                            'attr' => array(
                            'ck-editor' => '',
                            'data-ng-model' => 'emailNGModel'
                           )
                     ,'required' => true
                ))
                ->add('attachment'
                     ,'text'
                     ,array(
                            'mapped' => false
                           ,'required' => false
                           )
                     )
                ->add('commsQ', 'hidden', array(
                    'required' => false,
                    'data' => $options['commsSql'],
                    'mapped' => false
                ))
                ->add('email_address', 'hidden', array(
                    'required' => false,
                    'data' => $extra_data['email_address'],
                    'mapped' => false
                ))
                ->add('save', 'submit', array('label' => 'Send'))
                ->setMethod('POST');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                       array(
                           'data_class' => 'ESERV\MAIN\ActivityBundle\Entity\Activity',
                           'extra_data' => array(),
                           'commsSql' => ''
                ))
                ->setRequired(array(
                    'em',
//                    'contact_id',
//                    'status_id',
//                    'act_cat_id',
//                    'act_data'
                ))
                ->setAllowedTypes(array(
                    'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'eserv_main_communicationsbundle_email';
    }

}
