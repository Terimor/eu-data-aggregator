<?php


namespace App\SupplierFacade\DataEu\MethodFacade;


use App\Api\Entity\Request\ApiSearchRequest;
use App\Api\Entity\Response\ApiDatasetsResponse;
use App\Supplier\DataEu\DataEuConst;
use App\Supplier\DataEu\Search\DataEuSearchResponse;
use App\SupplierFacade\DataEu\Bridge\Search\DataEuSearchResponseBridge;
use App\SupplierFacade\DataEu\RequestBuilder\DataEuSearchRequestBuilder;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

class DataEuSearchMethodFacade
{
    private SerializerInterface $serializer;

    private DataEuSearchResponseBridge $searchResponseBridge;

    private DataEuSearchRequestBuilder $searchRequestBuilder;

    public function __construct(
        SerializerInterface $serializer,
        DataEuSearchResponseBridge $searchResponseBridge,
        DataEuSearchRequestBuilder $searchRequestBuilder
    ) {
        $this->serializer = $serializer;
        $this->searchResponseBridge = $searchResponseBridge;
        $this->searchRequestBuilder = $searchRequestBuilder;
    }

    public function commit(ApiSearchRequest $searchRequest): ApiDatasetsResponse
    {
        $stringResponse = $this->sendAndGetStringResponse($searchRequest);

        /** @var DataEuSearchResponse $response */
        $response = $this->serializer->deserialize($stringResponse, DataEuSearchResponse::class, 'json');
        $datasetCollection = $this->searchResponseBridge->build($response);
        $totalDatasetsAmount = $response->getResult()->getCount();

        $apiSearchResponse = new ApiDatasetsResponse();
        $apiSearchResponse->setDatasetCollection($datasetCollection);
        $apiSearchResponse->setTotalDatasetsAmount($totalDatasetsAmount);

        return $apiSearchResponse;
    }

    private function sendAndGetStringResponse(ApiSearchRequest $searchRequest): string
    {
        $client = new Client(['base_uri' => DataEuConst::BASE_URI]);

        $response = $client->get(
            'search',
            [
                'query' => $this->searchRequestBuilder->build($searchRequest),
            ]
        );

        return $response->getBody();
    }
}