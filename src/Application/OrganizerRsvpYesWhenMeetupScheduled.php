<?php
declare(strict_types = 1);

namespace Application;

use Domain\Model\Meetup\MeetupScheduled;
use Domain\Model\Rsvp\Rsvp;
use Domain\Model\Rsvp\RsvpId;
use Ramsey\Uuid\Uuid;

final class OrganizerRsvpYesWhenMeetupScheduled
{
    public function __invoke(MeetupScheduled $event)
    {
        $rsvpId = RsvpId::fromString((string)Uuid::uuid4());
        $rsvp = Rsvp::yes($rsvpId, $event->meetupId(), $event->organizerId());

        dump($rsvp);

        // TODO persist $rsvp
    }
}
