<?php


namespace App\Api\Entity\Request;


use JMS\Serializer\Annotation as Serializer;

class ApiGetDatasetRequest implements ApiRequestInterface
{
    /** @Serializer\Type("integer") */
    private int $externalId;

    public function getExternalId(): int
    {
        return $this->externalId;
    }
}