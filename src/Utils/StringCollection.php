<?php


namespace App\Utils;


use App\Base\AbstractCollection;

class StringCollection extends AbstractCollection
{
    protected function getTypeName(): string
    {
        return "string";
    }
}