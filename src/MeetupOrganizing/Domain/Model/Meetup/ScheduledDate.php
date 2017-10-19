<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

final class ScheduledDate
{
    /**
     * @var string
     */
    private $date;

    private function __construct(string $date)
    {
        $this->date = $date;
    }

    public static function fromDateTime(\DateTimeImmutable $dateTime): ScheduledDate
    {
        return new self($dateTime->format(\DateTime::ATOM));
    }
}
