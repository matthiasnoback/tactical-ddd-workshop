<?php

namespace Infrastructure\DomainEvents;

interface RecordsDomainEvents
{
    /**
     * @return object[]
     */
    public function recordedEvents();
}
