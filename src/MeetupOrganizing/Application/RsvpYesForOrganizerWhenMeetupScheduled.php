<?php
declare(strict_types=1);

namespace MeetupOrganizing\Application;

use MeetupOrganizing\Domain\Factory\UserIdFactory;
use MeetupOrganizing\Domain\Model\Meetup\MeetupScheduled;
use MeetupOrganizing\Domain\Model\Rsvp\Rsvp;
use MeetupOrganizing\Domain\Model\Rsvp\RsvpId;
use Ramsey\Uuid\Uuid;

final class RsvpYesForOrganizerWhenMeetupScheduled
{
    /**
     * @var UserIdFactory
     */
    private $userIdFactory;

    public function __construct(UserIdFactory $userIdFactory)
    {
        $this->userIdFactory = $userIdFactory;
    }

    public function __invoke(MeetupScheduled $event): void
    {
        $attendeeId = $this->userIdFactory->createAttendeeId((string)$event->organizerId());
        $rsvpId = RsvpId::fromString((string)Uuid::uuid4());
        $rsvp = Rsvp::yes($rsvpId, $event->meetupId(), $attendeeId);
        dump($rsvp); // i.e. persist
    }
}
