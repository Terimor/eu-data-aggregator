<?php


namespace App\Supplier\DataEu\Common;


use JMS\Serializer\Annotation as Serializer;

class DataEuDescription
{
    /** @Serializer\Type("string") */
    private ?string $en = null;

    /** @Serializer\Type("string") */
    private ?string $de = null;

    /** @Serializer\Type("string") */
    private ?string $fr = null;

    public function getEn(): ?string
    {
        return $this->en;
    }

    public function setEn(string $en): void
    {
        $this->en = $en;
    }

    public function getDe(): ?string
    {
        return $this->de;
    }

    public function setDe(string $de): void
    {
        $this->de = $de;
    }

    public function getFr(): ?string
    {
        return $this->fr;
    }

    public function setFr(string $fr): void
    {
        $this->fr = $fr;
    }
}