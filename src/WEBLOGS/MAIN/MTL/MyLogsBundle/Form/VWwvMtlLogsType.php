<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VWwvMtlLogsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('log_id')
            ->add('customer')
            ->add('date_requested')
            ->add('date_required')
            ->add('requested_by')
            ->add('approved_by')
            ->add('priority_level')
            ->add('category')
            ->add('category_name')
            ->add('description')
            ->add('mtl_person_id')
            ->add('estimate')
            ->add('date_completed')
            ->add('time_taken')
            ->add('completed_by')
            ->add('mtl_description')
            ->add('developer_text')
            ->add('mtl_category')
            ->add('chargeable')
            ->add('invoice_no')
            ->add('date_invoiced')
            ->add('slo_user_id')
            ->add('slo_date_last_updated')
            ->add('slo_date_entered')
            ->add('mlo_quote_id')
            ->add('customer_log_id')
            ->add('short_description')
            ->add('invoice_amount')
            ->add('release_date')
            ->add('sign_off_date')
            ->add('version_no')
            ->add('mtl_budget_code')
            ->add('task')
            ->add('assigned_to_id')
            ->add('client_status_code')
            ->add('urgent')
            ->add('log_due_date')
            ->add('mtl_dev_id')
            ->add('mtl_action')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\VWwvMtlLogs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'weblogs_main_mtl_mylogsbundle_vwwvmtllogs';
    }
}
