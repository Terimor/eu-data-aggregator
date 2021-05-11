<?php


namespace App\Controller;


use App\Api\Builder\ApiRequestBuilder;
use App\Api\Builder\ApiResponseBuilder;
use App\Api\Entity\Request\ApiGetDatasetRequest;
use App\Api\Entity\Request\ApiSearchRequest;
use App\Api\Entity\Response\ApiDatasetsResponse;
use App\Repository\DatasetRepository;
use App\SupplierFacade\DataEu\DataEuSupplierFacade;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ApiController
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
     * @Route("/import-dataset", name="import_dataset", methods={"POST"})
     */
    public function importDataset(Request $request): Response
    {
        $data = $request->getContent();
        /** @var ApiGetDatasetRequest $getDatasetRequest */
        $getDatasetRequest = $this->requestBuilder->build(ApiGetDatasetRequest::class, $data);

        $response = $this->dataEuSupplierFacade->getDataset($getDatasetRequest);

        return $this->responseBuilder->build($response);
    }

    /**
     * @Route("/get-all-datasets", name="get_all_datasets", methods={"GET"})
     */
    public function getAllDatasets(DatasetRepository $datasetRepository): Response
    {
        $datasets = $datasetRepository->findAll();

        $response = new ApiDatasetsResponse();
        $response->setDatasetCollection($datasets);

        return $this->responseBuilder->build($response);
    }
}