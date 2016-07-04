<?php

namespace Domain\Model\Common;

use Ramsey\Uuid\Uuid;

abstract class AggregateRootId
{
    private $id;

    private function __construct(string $id)
    {
        $this->id = Uuid::fromString($id);
    }

    public static function fromString(string $id) : self
    {
        return new static($id);
    }

    public function __toString()
    {
        return (string)$this->id;
    }
}
