<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroup;
use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;

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
     * @var OrganizerId
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

    private function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        OrganizerId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ) {
        $this->meetupGroupId = $meetupGroupId;
        $this->organizerId = $organizerId;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
        $this->meetupId = $meetupId;
    }

    public static function schedule(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        OrganizerId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ): Meetup {
        return new self($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor);
    }
}
