<?php


namespace App\Supplier\DataEu\Common;


use JMS\Serializer\Annotation as Serializer;

class DataEuDistribution
{
    /**
     * @Serializer\Type("string")
     */
    private ?string $access_url = null;

    /** @Serializer\Type("App\Supplier\DataEu\Common\DataEuFormat") */
    private DataEuFormat $format;

    public function getAccessUrl(): ?string
    {
        return $this->access_url;
    }

    public function getFormat(): DataEuFormat
    {
        return $this->format;
    }
}