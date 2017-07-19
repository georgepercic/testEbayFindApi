<?php

namespace AppBundle\Component;

use AppBundle\Factory\EbayProductFactory;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class DataFetcher.
 */
class DataFetcher
{
    /**
     * @var array
     */
    private $data;

    /**
     * DataFetcher constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function getFormatedResult(int $page)
    {
        return $this->buildProductFromData($page);
    }

    /**
     * @return int
     */
    public function getCurrentPageNumber(): int
    {
        $pageData = $this->fetchPageData();

        if (empty($pageData)) {
            return 0;
        }

        return $pageData['pageNumber'][0];
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        $pageData = $this->fetchPageData();

        if (empty($pageData)) {
            return 0;
        }

        return $pageData['totalPages'][0];
    }

    /**
     * @return array
     */
    private function fetchSearchResult(): array
    {
        if (empty($this->data['findItemsByKeywordsResponse'][0]['searchResult'][0]['item'])) {
            return [];
        }

        return $this->data['findItemsByKeywordsResponse'][0]['searchResult'][0]['item'];
    }

    /**
     * @return array
     */
    private function fetchPageData(): array
    {
        if (empty($this->data['findItemsByKeywordsResponse'][0]['paginationOutput'])) {
            return [];
        }

        return $this->data['findItemsByKeywordsResponse'][0]['paginationOutput'][0];
    }

    /**
     * @return array
     */
    private function getResult(): array
    {
        return $this->fetchSearchResult();
    }

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    private function buildProductFromData(int $page)
    {
        $results = $this->getResult();
        $products = [];

        if (empty($results)) {
            return $this->getPaginatedResults($products, $page);
        }

        foreach ($results as $result) {
            $factory = new EbayProductFactory($result);
            $products[] = $factory->buildProduct();

            unset($factory);
        }

        return $this->getPaginatedResults($products, $page);
    }

    /**
     * @param array $data
     * @param int   $page
     *
     * @return Pagerfanta
     */
    private function getPaginatedResults(array $data, int $page)
    {
        $adapter = new ArrayAdapter($data);
        $pager = new Pagerfanta($adapter);

        $pager
            ->setMaxPerPage(10)
            ->setCurrentPage($page);

        $pager->haveToPaginate();

        return $pager;
    }
}
