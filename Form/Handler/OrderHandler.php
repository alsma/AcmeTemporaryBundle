<?php

namespace Acme\Bundle\TemporaryBundle\Form\Handler;

use Doctrine\Common\Persistence\ManagerRegistry;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;

use Acme\Bundle\TemporaryBundle\Entity\Order;

class OrderHandler
{
    /** @var FormInterface */
    protected $form;

    /** @var RequestStack */
    protected $requestStack;

    /** @var ManagerRegistry */
    protected $registry;

    /**
     * @param FormInterface   $form
     * @param RequestStack    $requestStack
     * @param ManagerRegistry $registry
     */
    public function __construct(FormInterface $form, RequestStack $requestStack, ManagerRegistry $registry)
    {
        $this->form = $form;
        $this->registry = $registry;
        $this->requestStack = $requestStack;
    }

    /**
     * @param Order $entity
     *
     * @return bool True when successful processed, false otherwise
     */
    public function process(Order $entity)
    {
        $this->form->setData($entity);

        if ($this->form->handleRequest($this->requestStack->getCurrentRequest())->isValid()) {
            $em = $this->registry->getManagerForClass(Order::class);

            $em->persist($entity);
            $em->flush($entity);

            return true;
        }

        return false;
    }
}
