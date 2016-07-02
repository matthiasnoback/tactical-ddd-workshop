<?php
declare(strict_types=1);

namespace Infrastructure\DomainEvents;

interface RecordsDomainEvents
{
    /**
     * @return object[]
     */
    public function recordedEvents();
}
