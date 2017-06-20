<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;

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

    public function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        OrganizerId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ) {
        $this->meetupId = $meetupId;
        $this->meetupGroupId = $meetupGroupId;
        $this->organizerId = $organizerId;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
    }

    public function meetupId(): MeetupId
    {
        return $this->meetupId;
    }

    public function organizerId(): OrganizerId
    {
        return $this->organizerId;
    }

    public function meetupGroupId(): MeetupGroupId
    {
        return $this->meetupGroupId;
    }

    public function workingTitle(): WorkingTitle
    {
        return $this->workingTitle;
    }

    public function scheduledFor(): ScheduledDate
    {
        return $this->scheduledFor;
    }
}
