<?php

namespace Laracasts\Transcriptions;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class Lines implements Countable, IteratorAggregate
{
    public function __construct(protected array $lines)
    {
    }

    public function asHtml(): string
    {
        $formattedLines = array_map(
            fn(Line $line) => $line->toAnchorTag(),
            $this->lines
        );

        return (new static($formattedLines))->__toString();
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }

    public function count(): int
    {
        return count($this->lines);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->lines);
    }
}