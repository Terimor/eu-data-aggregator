<?php


namespace App\Api\Entity\Request;


use JMS\Serializer\Annotation as Serializer;

class ApiGetDatasetRequest implements ApiRequestInterface
{
    /** @Serializer\Type("string") */
    private string $externalId;

    public function getExternalId(): string
    {
        return $this->externalId;
    }
}