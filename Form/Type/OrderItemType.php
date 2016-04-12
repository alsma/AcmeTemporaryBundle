<?php

namespace Acme\Bundle\TemporaryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Acme\Bundle\TemporaryBundle\Entity\OrderItem;

class OrderItemType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('qty');
        $builder->add('product');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => OrderItem::class,
                'empty_data' => function (FormInterface $form) {
                    return new OrderItem($form->getParent()->getParent()->getData());
                }
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'acme_bundle_temporary_orderitem';
    }
}
