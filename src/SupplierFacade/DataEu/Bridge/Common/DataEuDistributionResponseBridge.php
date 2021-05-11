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

        $format = $supplierDistribution->getFormat();
        if (!$format) {
            throw new UnnecessaryDistributionCoreSupplierException();
        }
        $distribution->setFormat($format->getId());

        $accessUrl = $supplierDistribution->getAccessUrl();
        if (!$accessUrl) {
            throw new UnnecessaryDistributionCoreSupplierException();
        }
        $distribution->setDownloadUrl($supplierDistribution->getAccessUrl());

        return $distribution;
    }
}