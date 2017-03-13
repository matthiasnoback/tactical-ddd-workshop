<?php
declare(strict_types=1);

namespace Test\Unit\Infrastructure\DomainEvents\Fixtures;

use Common\DomainModel\AggregateRoot;
use Common\DomainModel\RecordsDomainEvents;

final class EntityTestDouble implements RecordsDomainEvents
{
    use AggregateRoot;

    public function doSomething($associatedEvent)
    {
        $this->recordThat($associatedEvent);
    }
}
