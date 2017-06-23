<?php

// src/ESERV/MAIN/ActivityBundle/Form/DataTransformer/StatusToNumberTransformer.php
namespace ESERV\MAIN\ActivityBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use ESERV\MAIN\SystemConfigBundle\Entity\SystemCode;

class StatusToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (activity_category) to a string (number).
     *
     * @param  ActivityCategory|null $activity_category
     * @return string
     */
    public function transform($activity_category)
    {
        if (null === $activity_category) {
            return "";
        }

        return $activity_category->getId();
    }

    /**
     * Transforms a string (number) to an object (activity_category).
     *
     * @param  string $id
     *
     * @return ActivityCategory|null
     *
     * @throws TransformationFailedException if object (activity_category) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $activity_category = $this->om
            ->getRepository('ESERVMAINSystemConfigBundle:SystemCode')
            ->findOneBy(array('id' => $id))
        ;

        if (null === $activity_category) {
            throw new TransformationFailedException(sprintf(
                'System code with id "%s" does not exist!',
                $id
            ));
        }

        return $activity_category;
    }
}