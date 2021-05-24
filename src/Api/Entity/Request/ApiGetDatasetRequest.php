<?php


namespace App\Api\Entity\Request;


use JMS\Serializer\Annotation as Serializer;

class ApiGetDatasetRequest implements ApiRequestInterface
{
    /** @Serializer\Type("string") */
    private string $externalId;

    /** @Serializer\Type("bool") */
    private bool $usePersist;

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function usePersist(): bool
    {
        return $this->usePersist;
    }
}