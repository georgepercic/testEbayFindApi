<?php

namespace AppBundle\Service;

use AppBundle\Client\ClientInterface;
use AppBundle\Component\DataFetcher;

class EbayFinder
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * EbayFinder constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $data
     * @param int   $page
     *
     * @return \Pagerfanta\Pagerfanta
     */
    public function find(array $data, int $page)
    {
        $dataFetcher = new DataFetcher($this->client->callApi($data));

        return $dataFetcher->getFormatedResult($page);
    }
}
