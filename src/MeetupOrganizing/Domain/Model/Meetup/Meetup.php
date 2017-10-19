<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use Common\DomainModel\AggregateRoot;
use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;
use MeetupOrganizing\Domain\Model\User\UserId;

final class Meetup
{
    use AggregateRoot;

    /**
     * @var MeetupId
     */
    private $meetupId;

    /**
     * @var MeetupGroupId
     */
    private $meetupGroupId;

    /**
     * @var UserId
     */
    private $organizerId;

    /**
     * @var Title
     */
    private $title;

    /**
     * @var ScheduledDate
     */
    private $scheduledFor;

    /**
     * @var Location
     */
    private $location;

    private function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        Title $title,
        ScheduledDate $scheduledFor,
        Location $location
    ) {
        $this->meetupGroupId = $meetupGroupId;
        $this->organizerId = $organizerId;
        $this->title = $title;
        $this->scheduledFor = $scheduledFor;
        $this->meetupId = $meetupId;
        $this->location = $location;
    }

    public static function schedule(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        UserId $organizerId,
        Title $workingTitle,
        ScheduledDate $scheduledFor,
        Location $location
    ): Meetup {
        $meetup = new self($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor, $location);

        $meetup->recordThat(new MeetupScheduled($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor));

        return $meetup;
    }
}
