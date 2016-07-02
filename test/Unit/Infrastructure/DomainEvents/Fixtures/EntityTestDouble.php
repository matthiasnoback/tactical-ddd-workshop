<?php
declare(strict_types=1);

namespace Test\Unit\Infrastructure\DomainEvents\Fixtures;

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
