<?php


namespace App\Controller;


use App\Api\Builder\ApiRequestBuilder;
use App\Api\Builder\ApiResponseBuilder;
use App\Api\Entity\Request\ApiDatasetRequest;
use App\Api\Entity\Response\ApiDatasetsResponse;
use App\Api\Entity\Response\ApiGetDatasetResponse;
use App\Api\Entity\Response\ApiSuccessResponse;
use App\Entity\Dataset;
use App\Repository\DatasetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

    public function __construct(ApiResponseBuilder $responseBuilder, ApiRequestBuilder $requestBuilder)
    {
        $this->requestBuilder = $requestBuilder;
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

    /**
     * @Route("/datasets", name="get_dataset", methods={"PUT"})
     */
    public function saveDataset(Request $request, EntityManagerInterface $em): Response
    {
        $data = $request->getContent();
        /** @var ApiDatasetRequest $requestObj */
        $requestObj = $this->requestBuilder->build(ApiDatasetRequest::class, $data);
        $dataset = $requestObj->getDataset();

        $em->persist($dataset);
        $em->flush();

        $response = new ApiSuccessResponse();

        return $this->responseBuilder->build($response);
    }
}