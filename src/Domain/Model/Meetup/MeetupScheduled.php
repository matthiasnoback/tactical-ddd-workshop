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
    private $id;
    /**
     * @var string
     */
    private $workingTitle;
    /**
     * @var \DateTimeImmutable
     */
    private $scheduledFor;
    /**
     * @var UserId
     */
    private $organizerId;
    /**
     * @var MeetupGroupId
     */
    private $meetupGroupId;

    public function __construct(
        MeetupId $id,
        string $workingTitle,
        \DateTimeImmutable $scheduledFor,
        UserId $organizerId,
        MeetupGroupId $meetupGroupId
    ) {
        $this->id = $id;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
        $this->organizerId = $organizerId;
        $this->meetupGroupId = $meetupGroupId;
    }

    public function id()
    {
        return $this->id;
    }

    public function workingTitle()
    {
        return $this->workingTitle;
    }

    public function scheduledFor()
    {
        return $this->scheduledFor;
    }

    public function organizerId()
    {
        return $this->organizerId;
    }

    public function meetupGroupId()
    {
        return $this->meetupGroupId;
    }
}
