<?php
declare(strict_types=1);

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

    /**
     * @param UserId $userId
     * @param string $answer
     */
    private function __construct(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId, $answer)
    {
        $this->userId = $userId;
        $this->answer = $answer;
        $this->rsvpId = $rsvpId;
        $this->meetupId = $meetupId;
    }

    public static function yes(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId)
    {
        return new self($rsvpId, $meetupId, $userId, self::YES);
    }

    public static function no(RsvpId $rsvpId, MeetupId $meetupId, UserId $userId)
    {
        return new self($rsvpId, $meetupId, $userId, self::NO);
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
