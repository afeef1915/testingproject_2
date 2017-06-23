<?php

namespace WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Form;
//namespace WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
//use Symfony\Component\Form\FormEvents;
//use WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\CustomerTasks;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;



use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class CustomerTasksType extends AbstractType
{
    
  

//name of the class shoule be same as the 'name' in the $data array in above 'myDataTableDataAction' function


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $empty_task = array(
          
        );
        $builder
//            ->add('ctk_customer_id', 'text', array(
//                'label' => 'Customer Id',                
//                'required' => false,
//            ))
            ->add('ctk_customer_id', 'entity', array(
                'label' => 'Customer',
                'required' => true,
                'empty_value' => ' -- Choose an option -- ',
                'class' => 'WEBLOGSMAINMTLCodeMaintainanceBundle:VWwvCustomers',
                'property' => 'name',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('fg')
                            ->orderBy('fg.name', 'ASC')
                    ;
                },
            ))
          // ->add('ctk_customer_id')
             ->add('ctk_code', 'text', array(
                'label' => 'Code',                
                'required' => true,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\NotBlank(),
//                    new \Symfony\Component\Validator\Constraints\Length(array(
//                        'min' => 6,
                            //)
                 //)
                )
            ))
            //->add('ctk_code')
              ->add('ctk_name', 'text', array(
                'label' => 'Name',                
                'required' => true,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\NotBlank(),
//                    new \Symfony\Component\Validator\Constraints\Length(array(
//                        'min' => 6,
                            //)
                 //)
                    )
            ))
//                        ->add('ctk_budget_code', 'choice', array(
//                'label' => 'Budget',                
//                'required' => true,
//                'constraints' => array(
//             //       new \Symfony\Component\Validator\Constraints\NotBlank(),
////                    new \Symfony\Component\Validator\Constraints\Length(array(
////                        'min' => 6,
//                            //)
//                 //)
//                    )
//            ))  
                       -> add('ctk_budget_code', 'choice',array( 'label' => 'Ctk Budget Code', 'required' => false)) 
//         $builder
//           ->add('ctk_customer_id')
//            ->add('ctk_code')
//            ->add('ctk_name')
            ->add('save', 'submit')
            ->setMethod('POST')
            ->getForm()
        
        ;
             $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
         $data = $event->getData();
         
         
      
         $form = $event->getForm();
          //  print_r($form); die;
         if ($form->has('ctk_budget_code')) {
             $form->remove('ctk_budget_code');
         }
  if(array_key_exists("ctk_budget_code",$data)){
         $form->add('ctk_budget_code', 'choice', array(
             'choices' => array($data['ctk_budget_code']=>'Whatever'),
  )); }
                 });

        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity\CustomerTasks'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_codemaintainancebundle_customertasks';
    }
}
