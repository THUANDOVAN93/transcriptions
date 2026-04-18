<?php

namespace Laracasts\Transcriptions;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class Lines extends Collection
{

    public function asHtml(): string
    {
        return $this->map(fn(Line $line) => $line->toHtml())
            ->__toString();
    }

    public function __toString(): string
    {
        return implode("\n", $this->items);
    }
}