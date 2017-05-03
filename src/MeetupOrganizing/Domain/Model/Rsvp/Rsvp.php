<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Rsvp;

use MeetupOrganizing\Domain\Model\Meetup\MeetupId;

final class Rsvp
{
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

    /**
     * @param RsvpId $rsvpId
     * @param MeetupId $meetupId
     * @param AttendeeId $attendeeId
     * @param string $answer
     */
    private function __construct(RsvpId $rsvpId, MeetupId $meetupId, AttendeeId $attendeeId, $answer)
    {
        $this->attendeeId = $attendeeId;
        $this->answer = $answer;
        $this->rsvpId = $rsvpId;
        $this->meetupId = $meetupId;
    }

    public static function yes(RsvpId $rsvpId, MeetupId $meetupId, AttendeeId $attendeeId)
    {
        return new self($rsvpId, $meetupId, $attendeeId, self::YES);
    }

    public static function no(RsvpId $rsvpId, MeetupId $meetupId, AttendeeId $attendeeId)
    {
        return new self($rsvpId, $meetupId, $attendeeId, self::NO);
    }

    public function changeToNo(): void
    {
        if ($this->answer !== self::NO) {
            $this->answer = self::NO;
        }
    }

    public function changeToYes(): void
    {
        if ($this->answer !== self::YES) {
            $this->answer = self::YES;
        }
    }
}
