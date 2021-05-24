<?php


namespace App\Api\Entity\Response;


use App\Entity\Dataset;

class ApiGetDatasetResponse extends ApiSuccessResponse
{
    private Dataset $dataset;

    public function __construct(Dataset $dataset)
    {
        $this->dataset = $dataset;
    }
}