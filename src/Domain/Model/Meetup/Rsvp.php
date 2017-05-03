<?php
declare(strict_types=1);

namespace Domain\Model\Meetup;

use Domain\Model\User\UserId;

final class Rsvp
{
    const YES = 'yes';
    const NO = 'no';

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
    private function __construct(UserId $userId, $answer)
    {
        $this->userId = $userId;
        $this->answer = $answer;
    }

    public static function yes(UserId $userId)
    {
        return new self($userId, self::YES);
    }

    public static function no(UserId $userId)
    {
        return new self($userId, self::NO);
    }
}
