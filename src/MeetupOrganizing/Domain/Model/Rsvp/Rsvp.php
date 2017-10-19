<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Rsvp;

use MeetupOrganizing\Domain\Model\Meetup\MeetupId;
use MeetupOrganizing\Domain\Model\User\UserId;

final class Rsvp
{
    private const YES = 'yes';
    private const NO = 'no';

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

    /**
     * @param string $answer
     */
    private function __construct(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId, string $answer)
    {
        $this->answer = $answer;
        $this->rsvpId = $rsvpId;
        $this->meetupId = $meetupId;
        $this->userId = $userId;
    }

    public static function yes(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId): Rsvp
    {
        return new self($rsvpId, $meetupId, $userId, self::YES);
    }

    public static function no(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId): Rsvp
    {
        return new self($rsvpId, $meetupId, $userId, self::NO);
    }
}
