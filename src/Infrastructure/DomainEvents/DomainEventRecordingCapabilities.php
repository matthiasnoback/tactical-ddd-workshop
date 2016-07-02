<?php
declare(strict_types=1);

namespace Infrastructure\DomainEvents;

trait DomainEventRecordingCapabilities
{
    private $events = [];

    protected function recordThat($event)
    {
        $this->events[] = $event;
    }

    public function recordedEvents()
    {
        return $this->events;
    }

    public function clearEvents()
    {
        $this->events = [];
    }
}
