<?php
declare(strict_types = 1);

namespace Application;

use Domain\Model\Meetup\MeetupId;
use Domain\Model\Rsvp\Rsvp;
use Domain\Model\Rsvp\RsvpId;
use Domain\Model\User\UserId;

final class RsvpYesHandler
{
    public function handle(RsvpYes $command): void
    {
        $rsvp = Rsvp::yes(
            RsvpId::fromString($command->rsvpId),
            MeetupId::fromString($command->meetupId),
            UserId::fromString($command->userId)
        );

        dump($rsvp);
    }
}
