<?php


namespace App\SupplierFacade\DataEu\Bridge\GetDataset;


use App\Entity\Dataset;
use App\Supplier\DataEu\GetDataset\DataEuGetDatasetResponse;
use App\SupplierFacade\DataEu\Bridge\Common\DataEuDatasetResponseBridge;

class DataEuGetDatasetResponseBridge
{
    private DataEuDatasetResponseBridge $datasetResponseBridge;

    public function __construct(DataEuDatasetResponseBridge $datasetResponseBridge)
    {
        $this->datasetResponseBridge = $datasetResponseBridge;
    }

    public function build(DataEuGetDatasetResponse $response): Dataset
    {
        return $this->datasetResponseBridge->build($response->getResult());
    }
}