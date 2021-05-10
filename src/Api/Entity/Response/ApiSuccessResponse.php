<?php


namespace App\Api\Entity\Response;


class ApiSuccessResponse implements ApiResponseInterface
{
     public function isSuccess(): bool
     {
         return true;
     }
 }