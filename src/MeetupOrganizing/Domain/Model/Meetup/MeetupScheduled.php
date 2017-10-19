<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;
use MeetupOrganizing\Domain\Model\User\UserId;

final class MeetupScheduled
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
    private $workingTitle;

    /**
     * @var ScheduledDate
     */
    private $scheduledFor;

    public function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        Title $workingTitle,
        ScheduledDate $scheduledFor
    ) {
        $this->meetupId = $meetupId;
        $this->meetupGroupId = $meetupGroupId;
        $this->organizerId = $organizerId;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
    }

    public function meetupId()
    {
        return $this->meetupId;
    }

    public function organizerId()
    {
        return $this->organizerId;
    }
}
