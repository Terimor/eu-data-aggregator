<?php


namespace App\SupplierFacade\DataEu\Bridge\Common;


use App\Entity\Distribution;
use App\Supplier\DataEu\Common\DataEuDistribution;
use App\Supplier\DataEu\DataEuConst;
use App\SupplierFacade\Exception\UnnecessaryDistributionCoreSupplierException;

class DataEuDistributionResponseBridge
{
    public function build(DataEuDistribution $supplierDistribution): Distribution
    {
        $distribution = new Distribution();

        $distribution->setExternalId($supplierDistribution->getId());

        $format = $supplierDistribution->getFormat();
        if (!$format || !$this->isFormatAllowed($format->getId())) {
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

    private function isFormatAllowed(string $format): bool
    {
        foreach (DataEuConst::SUPPORTABLE_FORMATS as $supportableFormat) {
            if (strcasecmp($format, $supportableFormat) === 0) {
                return true;
            }
        }

        return false;
    }
}