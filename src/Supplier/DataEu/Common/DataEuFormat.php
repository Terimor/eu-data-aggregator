<?php


namespace App\Supplier\DataEu\Common;


use JMS\Serializer\Annotation as Serializer;

class DataEuFormat
{
    /** @Serializer\Type("string") */
    private string $title;

    /** @Serializer\Type("string") */
    private string $id;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getId(): string
    {
        return $this->id;
    }
}