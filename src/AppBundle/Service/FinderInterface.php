<?php

namespace AppBundle\Service;

/**
 * Interface FinderInterface.
 */
interface FinderInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function find(array $data);
}
