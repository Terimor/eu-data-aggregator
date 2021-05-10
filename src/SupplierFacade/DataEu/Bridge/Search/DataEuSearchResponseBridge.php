<?php


namespace App\SupplierFacade\DataEu\Bridge\Search;


use App\Entity\Dataset;
use App\Supplier\DataEu\Common\DataEuDataset;
use App\Supplier\DataEu\Search\DataEuSearchResponse;
use App\SupplierFacade\DataEu\Bridge\Common\DataEuDatasetResponseBridge;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class DataEuSearchResponseBridge
{
    private DataEuDatasetResponseBridge $datasetResponseBridge;

    public function __construct(DataEuDatasetResponseBridge $datasetResponseBridge)
    {
        $this->datasetResponseBridge = $datasetResponseBridge;
    }

    /** @return Dataset[]|Collection */
    public function build(DataEuSearchResponse $searchResponse): Collection
    {
        $result = new ArrayCollection();

        /** @var DataEuDataset $dataset */
        foreach ($searchResponse->getResult()->getResults() as $dataset) {
            $dataset = $this->datasetResponseBridge->build($dataset);
            $result->add($dataset);
        }

        return $result;
    }
}