<?php
declare(strict_types = 1);

namespace Domain\Model\Rsvp;

use Domain\Model\Meetup\MeetupId;
use Domain\Model\User\User;
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
     * @var User
     */
    private $userId;

    /**
     * @var string
     */
    private $answer;

    private function __construct(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId, string $answer)
    {
        $this->userId = $userId;
        $this->answer = $answer;
        $this->meetupId = $meetupId;
        $this->rsvpId = $rsvpId;
    }

    public static function yes(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId): Rsvp
    {
        return new self($rsvpId, $meetupId, $userId, self::YES);
    }

    public static function no(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId): Rsvp
    {
        return new self($rsvpId, $meetupId, $userId, self::NO);
    }

    public function changeToNo()
    {
        $this->answer = self::NO;
    }

    public function changeToYes()
    {
        $this->answer = self::YES;
    }
}
