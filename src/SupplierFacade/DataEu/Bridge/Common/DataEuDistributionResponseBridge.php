<?php


namespace App\SupplierFacade\DataEu\Bridge\Common;


use App\Entity\Distribution;
use App\Supplier\DataEu\Common\DataEuDistribution;
use App\SupplierFacade\Exception\UnnecessaryDistributionCoreSupplierException;

class DataEuDistributionResponseBridge
{
    public function build(DataEuDistribution $supplierDistribution): Distribution
    {
        $distribution = new Distribution();

        $distribution->setFormat($supplierDistribution->getFormat()->getId());

        $accessUrl = $supplierDistribution->getAccessUrl();
        if (!$accessUrl) {
            throw new UnnecessaryDistributionCoreSupplierException();
        }
        $distribution->setDownloadUrl($supplierDistribution->getAccessUrl());

        return $distribution;
    }
}