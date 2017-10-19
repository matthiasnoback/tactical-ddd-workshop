<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use Assert\Assertion;

final class Address
{
    /**
     * @var string
     */
    private $title;

    public function __construct(string $title)
    {
        Assertion::notEmpty($title);
        $this->title = $title;
    }
}
