<?php
declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Model\Meetup\Meetup;
use Domain\Model\Meetup\MeetupId;
use Domain\Model\Meetup\MeetupRepository;
use Ramsey\Uuid\Uuid;

final class InMemoryMeetupRepository implements MeetupRepository
{
    private $meetups = [];

    public function add(Meetup $meetup)
    {
        $this->meetups[(string) $meetup->meetupId()] = $meetup;
    }

    public function getById(MeetupId $meetupId) : Meetup
    {
        if (!isset($this->meetups[(string)$meetupId])) {
            throw new \LogicException(sprintf('Meetup "%s" not found', $meetupId));
        }

        return $this->meetups[(string)$meetupId];
    }

    public function nextIdentity() : MeetupId
    {
        return MeetupId::fromString((string) Uuid::uuid4());
    }
}
