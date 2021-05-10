<?php


namespace App\Api\Builder;


use App\Api\Entity\Request\ApiRequestInterface;
use JMS\Serializer\SerializerInterface;

class ApiRequestBuilder
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function build(string $requestClass, string $data): ApiRequestInterface
    {
        /** @var ApiRequestInterface $request */
        return $this->serializer->deserialize($data, $requestClass, 'json');
    }
}