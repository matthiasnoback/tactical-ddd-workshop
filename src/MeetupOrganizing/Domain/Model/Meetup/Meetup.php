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

    /**
     * @var bool
     */
    private $cancelled = false;

    /**
     * @var object[]
     */
    private $events = [];

    private function recordThat($event): void
    {
        $this->events[] = $event;

        $this->apply($event);
    }

    public function popRecordedEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    private function apply($event): void
    {
        if ($event instanceof MeetupScheduled) {
            $this->applyMeetupScheduled($event);
            return;
        }

        if ($event instanceof MeetupCancelled) {
            $this->applyMeetupCancelled($event);
            return;
        }

        throw new \LogicException('Unknown event');
    }

    public static function reconstitute(array $events)
    {
        $instance = new static();

        foreach ($events as $event) {
            $instance->apply($event);
        }

        return $instance;
    }

    private function __construct()
    {
    }

    public static function schedule(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        OrganizerId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ): Meetup {
        $meetup = new self();

        $meetup->recordThat(new MeetupScheduled($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor));

        return $meetup;
    }

    public function cancel(): void
    {
        if ($this->cancelled) {
            // do nothing (this command is idempotent)
            return;
        }

        $this->recordThat(new MeetupCancelled($this->meetupId));
    }

    private function applyMeetupScheduled(MeetupScheduled $event): void
    {
        $this->meetupId = $event->meetupId();
        $this->meetupGroupId = $event->meetupGroupId();
        $this->organizerId = $event->organizerId();
        $this->workingTitle = $event->workingTitle();
        $this->scheduledFor = $event->scheduledFor();
    }

    private function applyMeetupCancelled($event): void
    {
        $this->cancelled = true;
    }
}
