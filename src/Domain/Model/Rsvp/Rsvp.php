<?php
declare(strict_types = 1);

namespace Domain\Model\Rsvp;

use Domain\Model\Meetup\MeetupId;
use Domain\Model\User\UserId;

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
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $answer;

    private function __construct(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId, string $answer)
    {
        $this->rsvpId = $rsvpId;
        $this->meetupId = $meetupId;
        $this->userId = $userId;
        $this->answer = $answer;
    }

    public static function yes(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId) : Rsvp
    {
        return new self($rsvpId, $meetupId, $userId, self::YES);
    }

    public static function no(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId) : Rsvp
    {
        return new self($rsvpId, $meetupId, $userId, self::NO);
    }
}
