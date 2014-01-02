<?php

namespace Acme\Bundle\TemporaryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('items', 'acme_bundle_temporary_order_item_collection');
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => 'Acme\Bundle\TemporaryBundle\Entity\Order',
                'cascade_validation' => true
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'acme_bundle_temporary_order';
    }
}
