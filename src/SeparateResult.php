<?php

namespace AcidF0x\KoreanHandler;

use ArrayAccess;
use Iterator;

class SeparateResult implements ArrayAccess, Iterator
{
    private int $position;
    /** @var array|Character */
    private array $characters = [];

    public function __construct(array $characters = [])
    {
        $this->position = 0;
        $this->characters = $characters;
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->characters[] = $value;
        } else {
            $this->characters[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->characters[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->characters[$offset]);
    }

    public function offsetGet($offset): ?Character
    {
        return $this->characters[$offset] ?? null;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current(): Character
    {
        return $this->characters[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->characters[$this->position]);
    }

    public function getChoseongList(): array
    {
        return array_map(fn(Character $char) => $char->getChoseong(), $this->characters);
    }

    public function getJungseongList(): array
    {
        return array_map(fn(Character $char) => $char->getJungseong(), $this->characters);
    }

    public function getJongseongList(): array
    {
        return array_filter(
            array_map(fn(Character $char) => $char->getJongseong(), $this->characters),
            fn($i) => $i !== null
        );
    }

    public function getSplitList(): array
    {
        $result = [];
        /** @var Character $character */
        foreach ($this->characters as $character) {
            array_push($result, ...$character->getSplit());
        }

        return $result;
    }
}
