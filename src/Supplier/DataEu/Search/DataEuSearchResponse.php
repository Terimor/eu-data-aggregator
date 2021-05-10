<?php


namespace App\Supplier\DataEu\Search;


use App\Supplier\DataEu\Common\Collection\DataEuDatasetCollection;
use JMS\Serializer\Annotation as Serializer;

class DataEuSearchResponse
{
    /** @Serializer\Type("bool") */
    private bool $success;

    /** @Serializer\Type("App\Supplier\DataEu\Search\DataEuResultResponse") */
    private DataEuResultResponse $result;

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getResult(): DataEuResultResponse
    {
        return $this->result;
    }
}