<?php
/**
 * Description of MerlinTreeType
 *
 * @author MTL Web Development Team
 */

namespace ESERV\MAIN\Services\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MerlinTreeType extends AbstractType {

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'tree_options' => array()
        ));
    }

    public function getParent() {
        return 'text';
    }

    public function getName() {
        return 'tree';
    }

}
