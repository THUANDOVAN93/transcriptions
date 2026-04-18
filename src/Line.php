<?php

namespace Laracasts\Transcriptions;

class Line
{

    public function __construct(
        public readonly int $position,
        public readonly string $timestamp,
        public readonly string $body
    )
    {
    }

    public function toHtml(): string
    {
        return "<a href=\"?time={$this->beginningTimestamp()}\">{$this->body}</a>";
    }

    public function beginningTimestamp(): ?string
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);

        return $matches[1] ?? '';
    }
}