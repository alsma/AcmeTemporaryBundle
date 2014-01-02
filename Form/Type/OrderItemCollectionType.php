<?php

namespace Acme\Bundle\TemporaryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderItemCollectionType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'allow_add'      => true,
                'allow_delete'   => true,
                'prototype'      => true,
                'prototype_name' => '__name__',
                'type'           => 'acme_bundle_temporary_orderitem'
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'collection';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'acme_bundle_temporary_order_item_collection';
    }
}
