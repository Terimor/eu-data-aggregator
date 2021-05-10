<?php


namespace App\Api\Builder;


use App\Api\Entity\Response\ApiResponseInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseBuilder
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function build(ApiResponseInterface $response): JsonResponse
    {
        $statusCode = $response->isSuccess() ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR;
        $data = $this->buildJsonString($response);

        return new JsonResponse($data, $statusCode, [], true);
    }

    public function buildJsonString(ApiResponseInterface $response): string
    {
        return $this->serializer->serialize($response, 'json');
    }
}