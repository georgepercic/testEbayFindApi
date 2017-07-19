<?php

namespace AppBundle\Factory;

use AppBundle\Model\Product;

/**
 * Class EbayProductFactory.
 */
class EbayProductFactory implements ProductFactoryInterface
{
    const PROVIDER = 'ebay';
    const NOT_AVAILABLE = '';

    /**
     * @var array
     */
    private $data;

    /**
     * EbayProductFactory constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Product
     */
    public function buildProduct(): Product
    {
        $product = new Product();

        $product->setProvider(self::PROVIDER);
        $product->setDescription(self::NOT_AVAILABLE);
        $product->setBrand(self::NOT_AVAILABLE);
        $product->setClickOutLink($this->data['viewItemURL'][0]);
        $product->setItemId($this->data['itemId'][0]);
        $product->setMainPhotoUrl($this->getGalleryUrl());
        $product->setTitle($this->data['title'][0]);

        $priceData = $this->getSellingPriceData();

        $product->setPrice($priceData['__value__']);
        $product->setPriceCurrency($priceData['@currencyId']);
        $product->setValidUntil($this->getValidUntil());
        $product->setShippingPrice($this->getShippingCost());

        return $product;
    }

    /**
     * @return string
     */
    private function getGalleryUrl()
    {
        if (empty($this->data['galleryURL'])) {
            return self::NOT_AVAILABLE;
        }

        return $this->data['galleryURL'][0];
    }

    /**
     * @return mixed
     */
    private function getSellingPriceData()
    {
        return $this->data['sellingStatus'][0]['currentPrice'][0];
    }

    /**
     * @return \DateTime
     */
    private function getValidUntil()
    {
        $endTime = $this->data['listingInfo'][0]['endTime'][0];

        return new \DateTime($endTime);
    }

    /**
     * @return mixed
     */
    private function getShippingCost()
    {
        if (empty($this->data['shippingInfo'][0]['shippingServiceCost'][0]['__value__'])) {
            return 0;
        }

        return $this->data['shippingInfo'][0]['shippingServiceCost'][0]['__value__'];
    }
}
