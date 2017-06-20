<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Rsvp;

use Common\EventSourcing\Aggregate\EventSourcedAggregateCapabilities;
use MeetupOrganizing\Domain\Model\Meetup\MeetupId;

final class Rsvp
{
    use EventSourcedAggregateCapabilities;

    const YES = 'yes';
    const NO = 'no';

    /**
     * @var RsvpId
     */
    private $rsvpId;

    /**
     * @var MeetupId
     */
    private $meetupId;

    /**
     * @var AttendeeId
     */
    private $attendeeId;

    /**
     * @var string
     */
    private $answer;

    public static function yes(RsvpId $rsvpId, MeetupId $meetupId, AttendeeId $attendeeId)
    {
        $rsvp = new static();

        $rsvp->recordThat(new RsvpedYes($rsvpId, $meetupId, $attendeeId));

        return $rsvp;
    }

    public static function no(RsvpId $rsvpId, MeetupId $meetupId, AttendeeId $attendeeId)
    {
        $rsvp = new static();

        $rsvp->recordThat(new RsvpedNo($rsvpId, $meetupId, $attendeeId));

        return $rsvp;
    }

    public function changeToNo(): void
    {
        if ($this->answer === self::NO) {
            return;
        }

        $this->recordThat(new RsvpedNo($this->rsvpId, $this->meetupId, $this->attendeeId));
    }

    public function changeToYes(): void
    {
        if ($this->answer === self::YES) {
            return;
        }

        $this->recordThat(new RsvpedNo($this->rsvpId, $this->meetupId, $this->attendeeId));
    }

    private function whenRsvpedYes(RsvpedYes $event)
    {
        $this->attendeeId = $event->attendeeId();
        $this->rsvpId = $event->rsvpId();
        $this->meetupId = $event->meetupId();
        $this->answer = self::YES;
    }

    private function whenRsvpedNo(RsvpedNo $event)
    {
        $this->attendeeId = $event->attendeeId();
        $this->rsvpId = $event->rsvpId();
        $this->meetupId = $event->meetupId();
        $this->answer = self::NO;
    }
}
