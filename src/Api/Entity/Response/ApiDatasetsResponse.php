<?php


namespace App\Api\Entity\Response;


use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;

class ApiDatasetsResponse extends ApiSuccessResponse
{
    /** @Serializer\Type("ArrayCollection<App\Entity\Dataset>") */
    private Collection $datasetCollection;

    private ?int $totalDatasetsAmount = null;

    public function setDatasetCollection(Collection $datasetCollection): void
    {
        $this->datasetCollection = $datasetCollection;
    }

    public function setTotalDatasetsAmount(int $totalDatasetsAmount): void
    {
        $this->totalDatasetsAmount = $totalDatasetsAmount;
    }
}