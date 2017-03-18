<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

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
     * @var MeetupGroupId
     */
    private $meetupGroupId;

    /**
     * @var User
     */
    private $organizer;

    /**
     * @var string
     */
    private $workingTitle;

    /**
     * @var \DateTimeImmutable
     */
    private $scheduledFor;

    private function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizer,
        string $workingTitle,
        \DateTimeImmutable $scheduledFor
    ) {
        $this->meetupId = $meetupId;
        $this->meetupGroupId = $meetupGroupId;
        $this->organizer = $organizer;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
    }

    public static function schedule(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizer,
        string $workingTitle,
        \DateTimeImmutable $scheduledFor
    ): Meetup {
        return new self(
            $meetupId,
            $meetupGroupId,
            $organizer,
            $workingTitle,
            $scheduledFor
        );
    }

    public function meetupId()
    {
        return $this->meetupId;
    }
}
