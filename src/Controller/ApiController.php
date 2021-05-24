<?php


namespace App\Controller;


use App\Api\Builder\ApiResponseBuilder;
use App\Api\Entity\Response\ApiDatasetsResponse;
use App\Api\Entity\Response\ApiGetDatasetResponse;
use App\Entity\Dataset;
use App\Repository\DatasetRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api", name="api_")
 */
class ApiController
{
    private ApiResponseBuilder $responseBuilder;

    public function __construct(ApiResponseBuilder $responseBuilder)
    {
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @Route("/datasets", name="get_all_datasets", methods={"GET"})
     */
    public function getAllDatasets(DatasetRepository $datasetRepository): Response
    {
        $datasets = $datasetRepository->findAll();

        $response = new ApiDatasetsResponse();
        $response->setDatasetCollection($datasets);

        return $this->responseBuilder->build($response);
    }

    /**
     * @Route("/datasets/{id}")
     * @ParamConverter("dataset", class="App\Entity\Dataset")
     */
    public function getDataset(Dataset $dataset): Response
    {
        $response = new ApiGetDatasetResponse($dataset);

        return $this->responseBuilder->build($response);
    }
}