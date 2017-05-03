<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

final class WorkingTitle
{
    /**
     * @var string
     */
    private $workingTitle;

    public function __construct(string $workingTitle)
    {
        $this->workingTitle = $workingTitle;
    }
}
