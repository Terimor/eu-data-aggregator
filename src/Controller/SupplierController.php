<?php


namespace App\Controller;


use App\Api\Builder\ApiRequestBuilder;
use App\Api\Builder\ApiResponseBuilder;
use App\Api\Entity\Request\ApiGetDatasetRequest;
use App\Api\Entity\Request\ApiSearchRequest;
use App\SupplierFacade\DataEu\DataEuSupplierFacade;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/supplier", name="supplier_")
 */
class SupplierController
{
    private ApiRequestBuilder $requestBuilder;

    private ApiResponseBuilder $responseBuilder;

    private DataEuSupplierFacade $dataEuSupplierFacade;

    public function __construct(ApiRequestBuilder $requestBuilder, ApiResponseBuilder $responseBuilder, DataEuSupplierFacade $dataEuSupplierFacade)
    {
        $this->requestBuilder = $requestBuilder;
        $this->responseBuilder = $responseBuilder;
        $this->dataEuSupplierFacade = $dataEuSupplierFacade;
    }

    /**
     * @Route("/search", name="search", methods={"POST"})
     */
    public function search(Request $request): Response
    {
        $data = $request->getContent();
        /** @var ApiSearchRequest $searchRequest */
        $searchRequest = $this->requestBuilder->build(ApiSearchRequest::class, $data);

        $response = $this->dataEuSupplierFacade->search($searchRequest);

        return $this->responseBuilder->build($response);
    }

    /**
     * @Route("/get-dataset", name="import_dataset", methods={"POST"})
     */
    public function getDataset(Request $request): Response
    {
        $data = $request->getContent();
        /** @var ApiGetDatasetRequest $getDatasetRequest */
        $getDatasetRequest = $this->requestBuilder->build(ApiGetDatasetRequest::class, $data);

        $response = $this->dataEuSupplierFacade->getDataset($getDatasetRequest);

        return $this->responseBuilder->build($response);
    }
}