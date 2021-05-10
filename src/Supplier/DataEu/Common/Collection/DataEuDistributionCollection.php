<?php


namespace App\Supplier\DataEu\Common\Collection;


use App\Base\AbstractCollection;
use App\Supplier\DataEu\Common\DataEuDistribution;

class DataEuDistributionCollection extends AbstractCollection
{
    protected function getTypeName(): string
    {
        return DataEuDistribution::class;
    }
}