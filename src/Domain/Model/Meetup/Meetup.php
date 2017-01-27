<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

use Domain\Model\MeetupGroup\MeetupGroupId;
use Domain\Model\Rsvp\Rsvp;
use Domain\Model\Rsvp\RsvpId;
use Domain\Model\User\UserId;
use Infrastructure\DomainEvents\DomainEventRecordingCapabilities;
use Infrastructure\DomainEvents\RecordsDomainEvents;

final class Meetup implements RecordsDomainEvents
{
    use DomainEventRecordingCapabilities;

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

        $this->recordThat(new MeetupScheduled($id, $workingTitle, $scheduledFor, $organizerId, $meetupGroupId));
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

    public function rsvpYes(UserId $userId) : Rsvp
    {
        return Rsvp::yes(
            RsvpId::fromString(Uuid::uuid4()->toString()),
            $this->id,
            $userId
        );
    }

    public function meetupId()
    {
        return $this->id;
    }
}
