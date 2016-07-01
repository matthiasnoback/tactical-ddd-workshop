<?php

namespace Test\Unit\Fixtures;

use Infrastructure\DomainEvents\DomainEventRecordingCapabilities;
use Infrastructure\DomainEvents\RecordsDomainEvents;

final class EntityTestDouble implements RecordsDomainEvents
{
    use DomainEventRecordingCapabilities;

    public function doSomething($associatedEvent)
    {
        $this->recordThat($associatedEvent);
    }
}
