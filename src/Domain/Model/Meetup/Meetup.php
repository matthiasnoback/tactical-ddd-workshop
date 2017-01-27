<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\User\User;
use Ramsey\Uuid\UuidInterface;

final class Meetup
{
    /**
     * @var UuidInterface
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
     * @var User
     */
    private $organizer;

    /**
     * @var MeetupGroup
     */
    private $meetupGroup;

    /**
     * @var Rsvp[]
     */
    private $rsvps = [];

    private function __construct(
        UuidInterface $id,
        string $workingTitle,
        \DateTimeImmutable $scheduledFor,
        User $organizer,
        MeetupGroup $meetupGroup
    ) {
        $this->id = $id;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
        $this->organizer = $organizer;
        $this->meetupGroup = $meetupGroup;

        $this->rsvps[] = Rsvp::yes($organizer);
    }

    public static function schedule(
        UuidInterface $id,
        string $workingTitle,
        \DateTimeImmutable $scheduledFor,
        User $organizer,
        MeetupGroup $meetupGroup
    ) : Meetup
    {
        return new self(
            $id,
            $workingTitle,
            $scheduledFor,
            $organizer,
            $meetupGroup
        );
    }
}
