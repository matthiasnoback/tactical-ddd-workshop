<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;
use MeetupOrganizing\Domain\Model\User\UserId;

final class Meetup
{
    /**
     * @var MeetupId
     */
    private $meetupId;

    /**
     * @var MeetupGroupId
     */
    private $meetupGroupId;

    /**
     * @var UserId
     */
    private $organizerId;

    /**
     * @var Title
     */
    private $title;

    /**
     * @var ScheduledDate
     */
    private $scheduledFor;

    private $rsvps = [];

    private function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        Title $title,
        ScheduledDate $scheduledFor
    ) {
        $this->meetupGroupId = $meetupGroupId;
        $this->organizerId = $organizerId;
        $this->title = $title;
        $this->scheduledFor = $scheduledFor;
        $this->meetupId = $meetupId;

        $this->rsvps[(string)$this->organizerId] = Rsvp::yes();
    }

    public static function schedule(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        Title $workingTitle,
        ScheduledDate $scheduledFor
    ): Meetup {
        return new self($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor);
    }
}
