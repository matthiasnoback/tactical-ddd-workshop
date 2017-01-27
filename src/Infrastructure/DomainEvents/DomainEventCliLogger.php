<?php

namespace Infrastructure\DomainEvents;

final class DomainEventCliLogger
{
    public function __invoke($event)
    {
        echo "Domain event recorded:\n";
        dump($event);
    }
}
