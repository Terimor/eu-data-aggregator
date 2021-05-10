<?php


namespace App\SupplierFacade\DataEu\Bridge\Common;


use App\Entity\Dataset;
use App\Supplier\DataEu\Common\DataEuDataset;
use App\SupplierFacade\Exception\UnnecessaryDistributionCoreSupplierException;
use Psr\Log\LoggerInterface;

class DataEuDatasetResponseBridge
{
    private DataEuDistributionResponseBridge $distributionResponseBridge;

    private LoggerInterface $logger;

    public function __construct(DataEuDistributionResponseBridge $distributionResponseBridge, LoggerInterface $logger)
    {
        $this->distributionResponseBridge = $distributionResponseBridge;
        $this->logger = $logger;
    }

    public function build(DataEuDataset $supplierDataset): Dataset
    {
        $dataset = new Dataset();

        $dataset->setExternalId($supplierDataset->getId());

        $countryCode = strtoupper($supplierDataset->getCountry()->getId());
        $dataset->setCountryCode($countryCode);

        $description = $supplierDataset->getDescription();
        $dataset->setDescriptionEn($description->getEn());
        $dataset->setDescriptionDe($description->getDe());
        $dataset->setDescriptionFr($description->getFr());

        foreach ($supplierDataset->getDistributions() as $supplierDistribution) {
            try {
                $distribution = $this->distributionResponseBridge->build($supplierDistribution);
                $dataset->addDistribution($distribution);
            } catch (UnnecessaryDistributionCoreSupplierException $throwable) {
                $this->logger->info('Distribution was ignored due to empty download url');
            }
        }

        return $dataset;
    }
}