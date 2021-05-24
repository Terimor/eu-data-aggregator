<?php


namespace App\Supplier\DataEu\Search;


use App\Supplier\DataEu\Common\Collection\DataEuDatasetCollection;
use App\Supplier\DataEu\Common\DataEuDataset;
use JMS\Serializer\Annotation as Serializer;

class DataEuResultResponse
{
    /**
     * @Serializer\Type("array<App\Supplier\DataEu\Common\DataEuDataset>")
     * @var DataEuDataset[]|DataEuDatasetCollection
     */
    private $results = [];

    /** @Serializer\Type("int") */
    private int $count;

    public function getResults(): DataEuDatasetCollection
    {
        if (!$this->results instanceof DataEuDatasetCollection) {
            $this->results = new DataEuDatasetCollection($this->results);
        }

        return $this->results;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}