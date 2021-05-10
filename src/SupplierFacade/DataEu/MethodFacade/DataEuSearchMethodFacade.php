<?php


namespace App\SupplierFacade\DataEu\MethodFacade;


use App\Api\Entity\Request\ApiSearchRequest;
use App\Api\Entity\Response\ApiSearchResponse;
use App\Supplier\DataEu\DataEuConst;
use App\Supplier\DataEu\Search\DataEuSearchResponse;
use App\SupplierFacade\DataEu\Bridge\Search\DataEuSearchResponseBridge;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

class DataEuSearchMethodFacade
{
    private const FILTER_DATASET = 'dataset';
    private const SORT_BY = 'relevance';

    private SerializerInterface $serializer;

    private DataEuSearchResponseBridge $searchResponseBridge;

    public function __construct(SerializerInterface $serializer, DataEuSearchResponseBridge $searchResponseBridge)
    {
        $this->serializer = $serializer;
        $this->searchResponseBridge = $searchResponseBridge;
    }

    public function commit(ApiSearchRequest $searchRequest): ApiSearchResponse
    {
        $stringResponse = $this->sendAndGetStringResponse($searchRequest);

        $response = $this->serializer->deserialize($stringResponse, DataEuSearchResponse::class, 'json');
        $datasetCollection = $this->searchResponseBridge->build($response);

        $apiSearchResponse = new ApiSearchResponse();
        $apiSearchResponse->setDatasetCollection($datasetCollection);

        return $apiSearchResponse;
    }

    private function sendAndGetStringResponse(ApiSearchRequest $searchRequest): string
    {
        $client = new Client(['base_uri' => DataEuConst::BASE_URI]);

        $response = $client->get('search', [
            'query' => [
                'q' => $searchRequest->getQuery(),
                'filter' => self::FILTER_DATASET,
                'sort' => self::SORT_BY,
                'page' => $searchRequest->getPage() - 1,
                'limit' => $searchRequest->getPerPage()
            ]
        ]);

        return $response->getBody();
    }
}