<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

use Domain\Model\User\User;

final class Meetup
{
    /**
     * @var MeetupId
     */
    private $meetupId;

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

    /**
     * @var Rsvp[]
     */
    private $rsvps = [];

    private function __construct(MeetupId $meetupId, User $organizer, string $workingTitle, \DateTimeImmutable $scheduledFor)
    {
        $this->organizer = $organizer;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
        $this->meetupId = $meetupId;

        $this->rsvpYes($organizer);
    }

    public static function schedule(MeetupId $meetupId, User $organizer, string $workingTitle, \DateTimeImmutable $scheduledFor): Meetup
    {
        return new self(
            $meetupId,
            $organizer,
            $workingTitle,
            $scheduledFor
        );
    }

    public function rsvpYes(User $user)
    {
        $this->rsvps[] = Rsvp::yes($user);
    }

    public function rsvpNo(User $user)
    {
        $this->rsvps[] = Rsvp::no($user);
    }
}
