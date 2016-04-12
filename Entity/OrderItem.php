<?php

namespace Acme\Bundle\TemporaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("acme_temporary_order_item")
 */
class OrderItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="qty", type="integer")
     */
    protected $qty;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="items",cascade={"persist"})
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $order;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $product;

    /**
     * @var string
     *
     * @ORM\Column(name="product_sku", type="string", length=50)
     */
    protected $productSku;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255)
     */
    protected $productName;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->setOrder($order);
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return integer
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product     = $product;
        $this->productName = $product->getName();
        $this->productSku  = $product->getSku();
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
