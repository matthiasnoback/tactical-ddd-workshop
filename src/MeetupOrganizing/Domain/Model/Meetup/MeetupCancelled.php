<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

final class MeetupCancelled
{
    /**
     * @var MeetupId
     */
    private $meetupId;

    public function __construct(MeetupId $meetupId)
    {
        $this->meetupId = $meetupId;
    }

    public function meetupId(): MeetupId
    {
        return $this->meetupId;
    }
}
