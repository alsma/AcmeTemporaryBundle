<?php

namespace Acme\Bundle\TemporaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table("acme_temporary_order")
 */
class Order
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
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    protected $label;

    /**
     * @var OrderItem[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order",cascade={"all"}, orphanRemoval=true)
     */
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems()
    {
        return $this->items->toArray();
    }

    /**
     * @param OrderItem $item
     */
    public function addItem(OrderItem $item)
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
        }
    }

    /**
     * @param OrderItem $item
     */
    public function removeItem(OrderItem $item)
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
        }
    }

    /**
     * @return int
     */
    public function getItemsOrderedCount()
    {
        return $this->items->count();
    }
}
