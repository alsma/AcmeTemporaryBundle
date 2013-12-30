<?php

namespace Acme\Bundle\TemporaryBundle\Form\Type;

use Acme\Bundle\TemporaryBundle\Entity\OrderItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderItemType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qty')
            ->add('product');
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Acme\Bundle\TemporaryBundle\Entity\OrderItem',
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
