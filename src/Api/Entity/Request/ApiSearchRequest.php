<?php


namespace App\Api\Entity\Request;


use JMS\Serializer\Annotation as Serializer;

class ApiSearchRequest implements ApiRequestInterface
{
    /** @Serializer\Type("string") */
    private string $query;

    /** @Serializer\Type("int") */
    private int $page;

    /** @Serializer\Type("int") */
    private int $perPage;

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}