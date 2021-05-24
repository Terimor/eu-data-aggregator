<?php


namespace App\SupplierFacade\DataEu\RequestBuilder;


use App\Api\Entity\Request\ApiSearchRequest;
use App\Supplier\DataEu\DataEuConst;

class DataEuSearchRequestBuilder
{
    private const FILTER_DATASET = 'dataset';
    private const SORT_BY = 'relevance+desc, modification_date+desc, title.en+asc';

    public function build(ApiSearchRequest $searchRequest): array
    {
        if ($searchRequest->getQuery()) {
            $query['q'] = $searchRequest->getQuery();
        }
        $query['page'] = $searchRequest->getPage();
        $query['limit'] = $searchRequest->getPerPage();
        $query['sort'] = self::SORT_BY;
        $query['filter'] = self::FILTER_DATASET;
        $query['facets'] = $this->buildFacets($searchRequest);

        return $query;
    }

    private function buildFacets(ApiSearchRequest $searchRequest): string
    {
        $facets['format'] = DataEuConst::SUPPORTABLE_FORMATS;

        return json_encode($facets, JSON_THROW_ON_ERROR);
    }
}