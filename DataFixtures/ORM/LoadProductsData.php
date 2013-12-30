<?php

namespace Acme\Bundle\TemporaryBundle\DataFixtures\ORM;

use Acme\Bundle\TemporaryBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadProductsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load sample products
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $products = [
            ['name' => 'Some name1', 'sku' => 'someSKU1'],
            ['name' => 'Some name2', 'sku' => 'someSKU2'],
            ['name' => 'Some name3', 'sku' => 'someSKU3'],
            ['name' => 'Some name4', 'sku' => 'someSKU4'],
            ['name' => 'Some name5', 'sku' => 'someSKU5'],
        ];
        foreach ($products as $product) {
            $product = new Product($product['sku'], $product['name']);
            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 200;
    }
}
