<?php
declare(strict_types = 1);

namespace Application;

use Domain\Model\Meetup\MeetupScheduled;
use Ramsey\Uuid\Uuid;

final class OrganizerRsvpYesWhenMeetupScheduled
{
    private $rsvpYesHandler;

    public function __construct(RsvpYesHandler $rsvpYesHandler)
    {
        $this->rsvpYesHandler = $rsvpYesHandler;
    }

    public function __invoke(MeetupScheduled $event): void
    {
        $rsvpYes = new RsvpYes();
        $rsvpYes->userId = (string)$event->organizerId();
        $rsvpYes->meetupId = (string)$event->meetupId();
        $rsvpYes->rsvpId = (string)Uuid::uuid4();

        $this->rsvpYesHandler->handle($rsvpYes);
    }
}
