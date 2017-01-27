<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

use Domain\Model\User\User;

final class Rsvp
{
    const YES = 'yes';
    const NO = 'no';

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $answer;

    private function __construct(User $user, string $answer)
    {
        $this->user = $user;
        $this->answer = $answer;
    }

    public static function yes(User $user) : Rsvp
    {
        return new self($user, self::YES);
    }

    public static function no(User $user) : Rsvp
    {
        return new self($user, self::NO);
    }
}
