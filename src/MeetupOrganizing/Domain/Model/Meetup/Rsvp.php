<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

final class Rsvp
{
    private const YES = 'yes';
    private const NO = 'no';

    /**
     * @var string
     */
    private $answer;

    /**
     * @param string $answer
     */
    private function __construct($answer)
    {
        $this->answer = $answer;
    }

    public static function yes(): Rsvp
    {
        return new self(self::YES);
    }

    public static function no(): Rsvp
    {
        return new self(self::NO);
    }
}
