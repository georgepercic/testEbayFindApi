<?php

namespace AppBundle\Client;

use AppBundle\Component\Filter;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

/**
 * Class EbayClient.
 */
class EbayClient implements ClientInterface
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var array
     */
    private $filterArray = [];

    /**
     * EbayClient constructor.
     *
     * @param string $apiKey
     * @param string $endpoint
     */
    public function __construct(string $apiKey, string $endpoint)
    {
        $this->apiKey = $apiKey;
        $this->endpoint = $endpoint;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function callApi(array $data): array
    {
        $client = new Client();
        $req = new Request('POST', $this->endpoint, $this->setHeaders(), $this->buildRequest($data));
        $resp = $client->send($req);

        return json_decode($resp->getBody()->getContents(), true);
    }

    /**
     * @return array
     */
    private function setHeaders(): array
    {
        return [
            'X-EBAY-SOA-OPERATION-NAME' => 'findItemsByKeywords',
            'X-EBAY-SOA-SERVICE-VERSION' => '1.3.0',
            'X-EBAY-SOA-REQUEST-DATA-FORMAT' => 'XML',
            'X-EBAY-SOA-RESPONSE-DATA-FORMAT' => 'json',
            'X-EBAY-SOA-GLOBAL-ID' => 'EBAY-US',
            'X-EBAY-SOA-SECURITY-APPNAME' => $this->apiKey,
            'Content-Type' => 'text/xml;charset=utf-8',
        ];
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function buildRequest(array $data): string
    {
        $filters = $this->setFilters($data);

        $xmlrequest = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xmlrequest .= "<findItemsByKeywordsRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\n";
        $xmlrequest .= '<keywords>';
        $xmlrequest .= urlencode($data['keywords']);
        $xmlrequest .= "</keywords>\n";
        $xmlrequest .= '<sortOrder>';
        $xmlrequest .= $data['sort'];
        $xmlrequest .= "</sortOrder>\n";
        $xmlrequest .= $filters;
        $xmlrequest .= "<paginationInput>\n <entriesPerPage>40</entriesPerPage>\n </paginationInput>\n";
        $xmlrequest .= '</findItemsByKeywordsRequest>';

        return $xmlrequest;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function setFilters(array $data): string
    {
        if (!empty($data['minPrice'])) {
            $this->setMinPriceFilter($data['minPrice']);
        }

        if (!empty($data['maxPrice'])) {
            $this->setMaxPriceFilter($data['maxPrice']);
        }

        if (empty($this->filterArray)) {
            return '';
        }

        return $this->buildXMLFilter();
    }

    /**
     * @param $price
     */
    private function setMinPriceFilter($price)
    {
        $filter = new Filter();
        $filter
            ->setName('MinPrice')
            ->setValue($price)
            ->setParamName(Filter::PRICE_PARAM_NAME)
            ->setParamValue(Filter::PRICE_PARAM_VALUE)
        ;

        $this->filterArray[] = $filter;
    }

    /**
     * @param $price
     */
    private function setMaxPriceFilter($price)
    {
        $filter = new Filter();
        $filter
            ->setName('MaxPrice')
            ->setValue($price)
            ->setParamName(Filter::PRICE_PARAM_NAME)
            ->setParamValue(Filter::PRICE_PARAM_VALUE)
        ;

        $this->filterArray[] = $filter;
    }

    /**
     * @return string
     */
    private function buildXMLFilter(): string
    {
        $xmlfilter = '';

        /** @var Filter $filter */
        foreach ($this->filterArray as $filter) {
            $xmlfilter .= "<itemFilter>\n";

            $xmlfilter .= sprintf("<name>%s</name>\n", $filter->getName());
            $xmlfilter .= sprintf("<value>%s</value>\n", $filter->getValue());
            $xmlfilter .= sprintf("<paramName>%s</paramName>\n", $filter->getParamName());
            $xmlfilter .= sprintf("<paramValue>%s</paramValue>\n", $filter->getParamValue());

            $xmlfilter .= "</itemFilter>\n";
        }

        return "$xmlfilter";
    }
}
