<?php


namespace App\SupplierFacade\DataEu\MethodFacade;


use App\Api\Entity\Request\ApiGetDatasetRequest;
use App\Api\Entity\Response\ApiGetDatasetResponse;
use App\Api\Entity\Response\ApiSuccessResponse;
use App\Entity\Dataset;
use App\Supplier\DataEu\DataEuConst;
use App\Supplier\DataEu\GetDataset\DataEuGetDatasetResponse;
use App\SupplierFacade\DataEu\Bridge\GetDataset\DataEuGetDatasetResponseBridge;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\SerializerInterface;
use UnexpectedValueException;

class DataEuGetDatasetMethodFacade
{
    private const URI_PATTERN = 'datasets/%s';

    private const DOWNLOAD_HEADERS = ['User-Agent' => 'PostmanRuntime/7.26.8'];

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

        $this->loadDistributionPayloads($dataset);

        if ($getDatasetRequest->usePersist()) {
            $this->entityManager->persist($dataset);
            $this->entityManager->flush();
        }

        return new ApiGetDatasetResponse($dataset);
    }

    private function sendAndGetStringResponse(ApiGetDatasetRequest $getDatasetRequest): string
    {
        $client = new Client(['base_uri' => DataEuConst::BASE_URI]);

        $uri = sprintf(self::URI_PATTERN, $getDatasetRequest->getExternalId());
        $response = $client->get($uri);

        return $response->getBody();
    }

    private function loadDistributionPayloads(Dataset $dataset): void
    {
        $client = new Client();
        $promises = [];

        foreach ($dataset->getDistributions() as $distribution) {
            $promises[$distribution->getExternalId()] = $client->getAsync($distribution->getDownloadUrl(), ['headers' => self::DOWNLOAD_HEADERS]);
        }

        $responses = Promise\Utils::settle($promises)->wait();

        foreach ($dataset->getDistributions() as $distribution) {
            try {
                $content = $this->getResponseContent($responses[$distribution->getExternalId()]);
                $distribution->setPayload($content);
            } catch (UnexpectedValueException $exception) {
                $dataset->getDistributions()->removeElement($distribution);
            }
        }
    }

    private function getResponseContent(array $response): string
    {
        $responseState = $response['state'];
        if ($responseState !== Promise\Promise::FULFILLED) {
            throw new UnexpectedValueException();
        }

        /** @var Response $responseObj */
        $responseObj = $response['value'];
        $body = $responseObj->getBody();
        if (!$body) {
            throw new UnexpectedValueException();
        }

        $content = $body->getContents();
        if (mb_detect_encoding($content, null, true) === false) {
            throw new UnexpectedValueException();
        }

        return $content;
    }
}