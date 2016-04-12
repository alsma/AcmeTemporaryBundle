<?php

namespace Acme\Bundle\TemporaryBundle\Migrations\Data\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use Acme\Bundle\TemporaryBundle\Entity\Product;

class LoadProductsData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $products = [
            ['Some name1', 'someSKU1'],
            ['Some name2', 'someSKU2'],
            ['Some name3', 'someSKU3'],
            ['Some name4', 'someSKU4'],
            ['Some name5', 'someSKU5'],
        ];
        foreach ($products as $product) {
            list ($sku, $name) = $product;

            $product = new Product($sku, $name);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
