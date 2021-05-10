<?php


namespace App\Supplier\DataEu\Common\Collection;


use App\Base\AbstractCollection;
use App\Supplier\DataEu\Common\DataEuDataset;

class DataEuDatasetCollection extends AbstractCollection
{
    protected function getTypeName(): string
    {
        return DataEuDataset::class;
    }
}