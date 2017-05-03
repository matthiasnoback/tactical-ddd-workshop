<?php
declare(strict_types=1);

namespace Domain\Model\Meetup;

final class ScheduledDate
{
    /**
     * @var string
     */
    private $date;

    /**
     * @param string $date
     */
    private function __construct($date)
    {
        $this->date = $date;
    }

    public static function fromDateTime(\DateTimeImmutable $dateTime)
    {
        return new self($dateTime->format(\DateTime::ATOM));
    }
}
