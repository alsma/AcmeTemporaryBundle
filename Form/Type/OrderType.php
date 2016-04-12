<?php

namespace Acme\Bundle\TemporaryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Acme\Bundle\TemporaryBundle\Entity\Order;

class OrderType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('label');
        $builder->add('items', 'acme_bundle_temporary_order_item_collection');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => Order::class,
            'cascade_validation' => true
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'acme_bundle_temporary_order';
    }
}
