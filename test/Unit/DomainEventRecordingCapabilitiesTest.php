<?php

namespace Test\Unit;

use Test\Unit\Fixtures\EntityTestDouble;

final class DomainEventRecordingCapabilitiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_records_and_exposes_recorded_domain_events()
    {
        $entity = new EntityTestDouble();

        $event1 = new \stdClass();
        $entity->doSomething($event1);

        $event2 = new \stdClass();
        $entity->doSomething($event2);

        $this->assertSame([$event1, $event2], $entity->recordedEvents());

        $entity->clearEvents();

        $this->assertSame([], $entity->recordedEvents());
    }
}
