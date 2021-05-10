<?php


namespace App\Api\Entity\Response;


use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;

class ApiSearchResponse extends ApiSuccessResponse
{
    /** @Serializer\Type("ArrayCollection<App\Entity\Dataset>") */
    private Collection $datasetCollection;

    public function setDatasetCollection(Collection $datasetCollection): void
    {
        $this->datasetCollection = $datasetCollection;
    }
}