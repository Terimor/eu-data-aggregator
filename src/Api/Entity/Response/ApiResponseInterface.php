<?php


namespace App\Api\Entity\Response;


interface ApiResponseInterface
{
    public function isSuccess(): bool;
}