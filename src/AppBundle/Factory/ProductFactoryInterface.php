<?php

namespace AppBundle\Factory;

use AppBundle\Model\Product;

/**
 * Interface ProductFactoryInterface.
 */
interface ProductFactoryInterface
{
    /**
     * @return Product
     */
    public function buildProduct(): Product;
}
