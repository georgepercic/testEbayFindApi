<?php

namespace AppBundle\Model;

class Product implements ProductInterface
{
    private $provider;
    private $itemId;
    private $clickOutLink;
    private $mainPhotoUrl;
    private $price;
    private $priceCurrency;
    private $shippingPrice;
    private $title;
    private $description;
    private $validUntil;
    private $brand;

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return mixed
     */
    public function getClickOutLink()
    {
        return $this->clickOutLink;
    }

    /**
     * @param mixed $clickOutLink
     */
    public function setClickOutLink($clickOutLink)
    {
        $this->clickOutLink = $clickOutLink;
    }

    /**
     * @return mixed
     */
    public function getMainPhotoUrl()
    {
        return $this->mainPhotoUrl;
    }

    /**
     * @param mixed $mainPhotoUrl
     */
    public function setMainPhotoUrl($mainPhotoUrl)
    {
        $this->mainPhotoUrl = $mainPhotoUrl;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }

    /**
     * @param mixed $priceCurrency
     */
    public function setPriceCurrency($priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * @return mixed
     */
    public function getShippingPrice()
    {
        return $this->shippingPrice;
    }

    /**
     * @param mixed $shippingPrice
     */
    public function setShippingPrice($shippingPrice)
    {
        $this->shippingPrice = $shippingPrice;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getValidUntil()
    {
        return $this->validUntil;
    }

    /**
     * @param mixed $validUntil
     */
    public function setValidUntil($validUntil)
    {
        $this->validUntil = $validUntil;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
}
