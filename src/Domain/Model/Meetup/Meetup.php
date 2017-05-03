<?php
declare(strict_types=1);

namespace Domain\Model\Meetup;

use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\MeetupGroup\MeetupGroupId;
use Domain\Model\User\User;
use Domain\Model\User\UserId;

final class Meetup
{
    /**
     * @var MeetupId
     */
    private $meetupId;

    /**
     * @var MeetupGroup
     */
    private $meetupGroupId;

    /**
     * @var User
     */
    private $organizerId;

    /**
     * @var WorkingTitle
     */
    private $workingTitle;

    /**
     * @var ScheduledDate
     */
    private $scheduledFor;

    private $rsvps = [];

    private function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ) {
        $this->meetupGroupId = $meetupGroupId;
        $this->organizerId = $organizerId;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
        $this->meetupId = $meetupId;

        $this->rsvps[(string)$this->organizerId] = Rsvp::yes($this->organizerId);
    }

    public static function schedule(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ): Meetup {
        return new self($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor);
    }
}
