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
            ->add(
                'items',
                'collection',
                [
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'type'         => 'acme_bundle_temporary_orderitem'
                ]
            );
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Acme\Bundle\TemporaryBundle\Entity\Order'
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
