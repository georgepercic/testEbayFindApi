<?php

namespace AppBundle\Model;

interface ProductInterface
{
    /**
     * @return mixed
     */
    public function getProvider();

    /**
     * @param mixed $provider
     */
    public function setProvider($provider);

    /**
     * @return mixed
     */
    public function getItemId();

    /**
     * @param mixed $item_id
     */
    public function setItemId($item_id);

    /**
     * @return mixed
     */
    public function getClickOutLink();

    /**
     * @param mixed $click_out_link
     */
    public function setClickOutLink($click_out_link);

    /**
     * @return mixed
     */
    public function getMainPhotoUrl();

    /**
     * @param mixed $main_photo_url
     */
    public function setMainPhotoUrl($main_photo_url);

    /**
     * @return mixed
     */
    public function getPrice();

    /**
     * @param mixed $price
     */
    public function setPrice($price);

    /**
     * @return mixed
     */
    public function getPriceCurrency();

    /**
     * @param mixed $price_currency
     */
    public function setPriceCurrency($price_currency);

    /**
     * @return mixed
     */
    public function getShippingPrice();

    /**
     * @param mixed $shipping_price
     */
    public function setShippingPrice($shipping_price);

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param mixed $title
     */
    public function setTitle($title);

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param mixed $description
     */
    public function setDescription($description);

    /**
     * @return mixed
     */
    public function getValidUntil();

    /**
     * @param mixed $valid_until
     */
    public function setValidUntil($valid_until);

    /**
     * @return mixed
     */
    public function getBrand();

    /**
     * @param mixed $brand
     */
    public function setBrand($brand);
}
