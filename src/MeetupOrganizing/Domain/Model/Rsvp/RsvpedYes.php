<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Rsvp;

use MeetupOrganizing\Domain\Model\Meetup\MeetupId;

final class RsvpedYes
{
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

    public function __construct(RsvpId $rsvpId, MeetupId $meetupId, AttendeeId $attendeeId)
    {
        $this->rsvpId = $rsvpId;
        $this->meetupId = $meetupId;
        $this->attendeeId = $attendeeId;
    }

    public function rsvpId(): RsvpId
    {
        return $this->rsvpId;
    }

    public function meetupId(): MeetupId
    {
        return $this->meetupId;
    }

    public function attendeeId(): AttendeeId
    {
        return $this->attendeeId;
    }
}
