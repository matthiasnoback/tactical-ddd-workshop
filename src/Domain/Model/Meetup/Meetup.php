<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

use Domain\Model\MeetupGroup\MeetupGroupId;
use Domain\Model\User\UserId;

final class Meetup
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

    private function __construct(
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

    public static function schedule(
        MeetupId $id,
        string $workingTitle,
        \DateTimeImmutable $scheduledFor,
        UserId $organizerId,
        MeetupGroupId $meetupGroupId
    ) : Meetup
    {
        return new self(
            $id,
            $workingTitle,
            $scheduledFor,
            $organizerId,
            $meetupGroupId
        );
    }
}
