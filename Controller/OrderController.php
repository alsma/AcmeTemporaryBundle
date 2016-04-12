<?php

namespace Acme\Bundle\TemporaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\Bundle\TemporaryBundle\Entity\Order;

/**
 * @Route("/order")
 */
class OrderController extends Controller
{
    /**
     * @Route("/", name="acme_temporary_order_index")
     * @Template
     *
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/create", name="acme_temporary_order_create")
     * @Template("AcmeTemporaryBundle:Order:update.html.twig")
     */
    public function createAction()
    {
        return $this->update(new Order());
    }

    /**
     * @Route("/update/{id}", name="acme_temporary_order_update", requirements={"id"="\d+"}, defaults={"id"=0})
     * @Template
     */
    public function updateAction(Order $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param Order $order
     *
     * @return array|RedirectResponse
     */
    protected function update(Order $order)
    {
        if ($this->get('acme_temporary.form.handler.order')->process($order)) {
            $this->addFlash(
                'success',
                $this->get('translator')->trans('acme.temporary.controller.order.saved.message')
            );

            return $this->get('oro_ui.router')->redirectAfterSave(
                ['route' => 'acme_temporary_order_update', 'parameters' => ['id' => $order->getId()]],
                ['route' => 'acme_temporary_order_index']
            );
        }

        return [
            'form' => $this->get('acme_temporary.form.order')->createView()
        ];
    }
}
