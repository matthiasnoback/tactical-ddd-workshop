<?php

namespace Infrastructure\DomainEvents;

use Assert\Assertion;
use Webmozart\Assert\Assert;

final class DomainEventDispatcher
{
    private $subscribers = [];
    private $subscribedToAllEvents = [];

    public function registerSubscriber(string $eventName, callable $subscriber)
    {
        $this->subscribers[$eventName][] = $subscriber;
    }

    public function subscribeToAllEvents(callable $subscriber)
    {
        $this->subscribedToAllEvents[] = $subscriber;
    }

    public function dispatch($event)
    {
        Assertion::isObject($event);
        
        $eventName = get_class($event);
        $eventSubscribers = array_merge(
            $this->subscribers[$eventName] ?? [],
            $this->subscribedToAllEvents
        );

        foreach ($eventSubscribers as $eventSubscriber) {
            $eventSubscriber($event);
        }
    }
}
