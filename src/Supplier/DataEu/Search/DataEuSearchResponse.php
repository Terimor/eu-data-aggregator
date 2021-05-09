<?php


namespace App\Supplier\DataEu\Search;


use JMS\Serializer\Annotation as Serializer;

class DataEuSearchResponse
{
    /** @Serializer\Type("bool") */
    private bool $success;

    /** @Serializer\Type("array<App\Supplier\DataEu\Common\DataEuDataset>") */
    private array $results;

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getResults(): array
    {
        return $this->results;
    }
}