<?php

namespace AppBundle\Client;

/**
 * Interface ClientInterface.
 */
interface ClientInterface
{
    public function callApi(array $data): array;
}
