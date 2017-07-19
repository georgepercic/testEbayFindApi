<?php

namespace AppBundle\Component;

/**
 * Class Filter.
 */
class Filter
{
    const PRICE_PARAM_NAME = 'Currency';
    const PRICE_PARAM_VALUE = 'USD';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $paramName;

    /**
     * @var string
     */
    private $paramValue;

    /**
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getParamName()
    {
        return $this->paramName;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setParamName($name)
    {
        $this->paramName = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getParamValue()
    {
        return $this->paramValue;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setParamValue($value)
    {
        $this->paramValue = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
