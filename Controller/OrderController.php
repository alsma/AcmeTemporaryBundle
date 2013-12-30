<?php

namespace Acme\Bundle\TemporaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\Bundle\TemporaryBundle\Entity\Order;

/**
 * Class OrderController
 *
 * @package Acme\Bundle\TemporaryBundle\Controller\
 * @Route("/order")
 */
class OrderController extends Controller
{
    /**
     * @Template
     * @Route("/", name="acme_temporary_order_index")
     * @return array
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Template("AcmeTemporaryBundle:Order:update.html.twig")
     * @Route("/create", name="acme_temporary_order_create")
     */
    public function createAction()
    {
        return $this->update(new Order());
    }

    /**
     * @Template
     * @Route("/update/{id}", name="acme_temporary_order_update", requirements={"id"="\d+"}, defaults={"id"=0})
     */
    public function updateAction(Order $entity)
    {
        return $this->update($entity);
    }

    /**
     * @param Order $entity
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function update(Order $entity)
    {
        if ($this->get('acme_temporary.form.handler.order')->process($entity)) {
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('acme.temporary.controller.order.saved.message')
            );

            return $this->get('oro_ui.router')->actionRedirect(
                array(
                    'route'      => 'acme_temporary_order_update',
                    'parameters' => array('id' => $entity->getId()),
                ),
                array(
                    'route' => 'acme_temporary_order_index',
                )
            );
        }

        return [
            'form' => $this->get('acme_temporary.form.order')->createView()
        ];
    }
}
