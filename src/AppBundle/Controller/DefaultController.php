<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $searchKeywords = $request->get('keywords');
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');
        $sortTerm = $request->get('sort');
        $page = $request->get('page') ?: 1;

        $searchResults = new ArrayCollection();

        if ($searchKeywords) {
            $finder = $this->get('ebay_api.finder');
            $data = [
                'keywords' => $searchKeywords,
                'minPrice' => $minPrice,
                'maxPrice' => $maxPrice,
                'sort' => $sortTerm,
            ];

            $searchResults = $finder->find($data, $page);
        }

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'pager' => $searchResults,
            'searchKeywords' => $searchKeywords,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sortData' => $this->sortData(),
            'sortTerm' => $sortTerm,
        ]);
    }

    /**
     * @return array
     */
    private function sortData()
    {
        return [
            'BestMatch' => 'Best Match',
            'BidCountFewest' => 'Bid Count Fewest',
            'BidCountMost' => 'Bid Count Most',
            'CountryAscending' => 'Country Ascending',
            'CountryDescending' => 'Country Descending',
            'CurrentPriceHighest' => 'Current Highest Price',
            'DistanceNearest' => 'Nearest Distance',
            'EndTimeSoonest' => 'End Time Soonest',
            'PricePlusShippingHighest' => 'Price Plus Shipping Highest',
            'PricePlusShippingLowest' => 'Price Plus Shipping Lowest',
            'StartTimeNewest' => 'Start Time Newest',
        ];
    }
}
