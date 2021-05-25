<?php


namespace App\Api\Entity\Request;


use App\Entity\Dataset;
use JMS\Serializer\Annotation as Serializer;

class ApiDatasetRequest implements ApiRequestInterface
{
    /** @Serializer\Type("App\Entity\Dataset") */
    private Dataset $dataset;

    public function getDataset(): Dataset
    {
        return $this->dataset;
    }
}