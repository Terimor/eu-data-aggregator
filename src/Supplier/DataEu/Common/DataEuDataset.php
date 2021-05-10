<?php


namespace App\Supplier\DataEu\Common;


use App\Supplier\DataEu\Common\Collection\DataEuDistributionCollection;
use JMS\Serializer\Annotation as Serializer;

class DataEuDataset
{
    /** @Serializer\Type("string") */
    private string $id;

    /** @Serializer\Type("App\Supplier\DataEu\Common\DataEuCountry") */
    private DataEuCountry $country;

    /** @Serializer\Type("App\Supplier\DataEu\Common\DataEuDescription") */
    private DataEuDescription $description;

    /**
     * @var DataEuDistribution|DataEuDistributionCollection
     * @Serializer\Type("array<App\Supplier\DataEu\Common\DataEuDistribution>")
     */
    private $distributions;

    public function getCountry(): DataEuCountry
    {
        return $this->country;
    }

    public function getDescription(): DataEuDescription
    {
        return $this->description;
    }

    public function getDistributions()
    {
        return $this->distributions;
    }

    public function getId(): string
    {
        return $this->id;
    }
}