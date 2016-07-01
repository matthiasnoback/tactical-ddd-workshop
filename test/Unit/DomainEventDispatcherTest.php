<?php

namespace Test\Unit;

use Infrastructure\DomainEvents\DomainEventDispatcher;

final class DomainEventDispatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_dispatches_events_to_generic_subscribers_and_domain_specific_subscribers()
    {
        $dispatcher = new DomainEventDispatcher();
        $event = new \stdClass();

        $notifiedSubscribers = [];
        $subscriber1 = function () use (&$notifiedSubscribers) {
            $notifiedSubscribers[] = 'subscriber1';
        };
        $subscriber2 = function () use (&$notifiedSubscribers) {
            $notifiedSubscribers[] = 'subscriber2';
        };
        $subscriber3 = function() use (&$notifiedSubscribers) {
            $notifiedSubscribers[] = 'subscriber3';
        };

        $dispatcher->registerSubscriber('stdClass', $subscriber1);
        $dispatcher->registerSubscriber('Some\Other\Class', $subscriber2);
        $dispatcher->subscribeToAllEvents($subscriber3);

        $dispatcher->dispatch($event);

        $this->assertSame(
            ['subscriber1', 'subscriber3'],
            $notifiedSubscribers
        );
    }
}
