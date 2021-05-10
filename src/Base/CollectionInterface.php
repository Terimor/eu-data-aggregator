<?php


namespace App\Base;


use ArrayIterator;
use Countable;
use IteratorAggregate;
use ArrayAccess;

interface CollectionInterface extends Countable, IteratorAggregate, ArrayAccess
{
    public function get($key);

    public function add($element): void;

    public function addCollection(AbstractCollection $collectionToMerge): void;

    public function set(string $key, $element): void;

    public function contains($element): bool;

    public function containsKey(string $key);

    public function clear(): void;

    public function isEmpty(): bool;

    public function remove($key);

    public function removeElement($element): bool;

    public function first();

    public function last();

    public function current();

    public function next();

    public function key();

    public function getKeys(): array;

    public function getValues(): array;

    public function toArray(): array;

    public function isValid(): bool;

    public function getIterator(): ArrayIterator;
}