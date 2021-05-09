<?php


namespace App\Supplier\DataEu\GetDataset;


use App\Supplier\DataEu\Common\DataEuDataset;
use JMS\Serializer\Annotation as Serializer;

class DataEuGetDatasetResponse
{
    /** @Serializer\Type("bool") */
    private bool $success;

    /** @Serializer\Type("App\Supplier\DataEu\Common\DataEuDataset") */
    private DataEuDataset $result;

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getResult(): DataEuDataset
    {
        return $this->result;
    }
}