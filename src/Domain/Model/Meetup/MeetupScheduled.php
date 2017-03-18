<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

use Domain\Model\MeetupGroup\MeetupGroupId;
use Domain\Model\User\UserId;

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
     * @var string
     */
    private $workingTitle;

    /**
     * @var \DateTimeImmutable
     */
    private $scheduledFor;

    public function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        string $workingTitle,
        \DateTimeImmutable $scheduledFor
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
