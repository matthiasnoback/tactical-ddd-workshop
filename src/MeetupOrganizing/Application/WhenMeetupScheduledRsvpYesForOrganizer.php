<?php
declare(strict_types=1);

namespace MeetupOrganizing\Application;

use MeetupOrganizing\Domain\Model\Meetup\MeetupScheduled;
use MeetupOrganizing\Domain\Model\Rsvp\Rsvp;
use MeetupOrganizing\Domain\Model\Rsvp\RsvpId;
use Ramsey\Uuid\Uuid;

final class WhenMeetupScheduledRsvpYesForOrganizer
{
    public function __invoke(MeetupScheduled $event): void
    {
        $rsvpId = RsvpId::fromString((string)Uuid::uuid4());
        $rsvp = Rsvp::yes($rsvpId, $event->meetupId(), $event->organizerId());
        dump($rsvp);
    }
}
