<?php


namespace App\SupplierFacade\DataEu\MethodFacade;


use App\Api\Entity\Request\ApiGetDatasetRequest;
use App\Api\Entity\Response\ApiSuccessResponse;
use App\Supplier\DataEu\DataEuConst;
use App\Supplier\DataEu\GetDataset\DataEuGetDatasetResponse;
use App\SupplierFacade\DataEu\Bridge\GetDataset\DataEuGetDatasetResponseBridge;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

class DataEuGetDatasetMethodFacade
{
    private const URI_PATTERN = 'datasets/%s';

    private SerializerInterface $serializer;

    private DataEuGetDatasetResponseBridge $getDatasetResponseBridge;

    private EntityManagerInterface $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        DataEuGetDatasetResponseBridge $getDatasetResponseBridge,
        EntityManagerInterface $entityManager
    ) {
        $this->serializer = $serializer;
        $this->getDatasetResponseBridge = $getDatasetResponseBridge;
        $this->entityManager = $entityManager;
    }

    public function commit(ApiGetDatasetRequest $getDatasetRequest): ApiSuccessResponse
    {
        $stringResponse = $this->sendAndGetStringResponse($getDatasetRequest);

        $response = $this->serializer->deserialize($stringResponse, DataEuGetDatasetResponse::class, 'json');
        $dataset = $this->getDatasetResponseBridge->build($response);

        $this->entityManager->persist($dataset);
        $this->entityManager->flush();

        return new ApiSuccessResponse();
    }

    private function sendAndGetStringResponse(ApiGetDatasetRequest $getDatasetRequest): string
    {
        $client = new Client(['base_uri' => DataEuConst::BASE_URI]);

        $uri = sprintf(self::URI_PATTERN, $getDatasetRequest->getExternalId());
        $response = $client->get($uri);

        return $response->getBody();
    }
}