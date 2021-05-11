<?php


namespace App\SupplierFacade\DataEu;


use App\Api\Entity\Request\ApiGetDatasetRequest;
use App\Api\Entity\Request\ApiSearchRequest;
use App\Api\Entity\Response\ApiDatasetsResponse;
use App\Api\Entity\Response\ApiSuccessResponse;
use App\SupplierFacade\DataEu\MethodFacade\DataEuGetDatasetMethodFacade;
use App\SupplierFacade\DataEu\MethodFacade\DataEuSearchMethodFacade;

class DataEuSupplierFacade
{
    private DataEuSearchMethodFacade $searchMethodFacade;

    private DataEuGetDatasetMethodFacade $getDatasetMethodFacade;

    public function __construct(DataEuGetDatasetMethodFacade $getDatasetMethodFacade, DataEuSearchMethodFacade $searchMethodFacade)
    {
        $this->searchMethodFacade = $searchMethodFacade;
        $this->getDatasetMethodFacade = $getDatasetMethodFacade;
    }

    public function search(ApiSearchRequest $searchRequest): ApiDatasetsResponse
    {
        return $this->searchMethodFacade->commit($searchRequest);
    }

    public function getDataset(ApiGetDatasetRequest $getDatasetRequest): ApiSuccessResponse
    {
        return $this->getDatasetMethodFacade->commit($getDatasetRequest);
    }
}