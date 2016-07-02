<?php

namespace Infrastructure\DomainEvents;

final class DomainEventCliLogger
{
    public function __invoke($event)
    {
        echo sprintf(
            'Domain event recorded: %s',
            var_export($event, true)
        );
    }
}
