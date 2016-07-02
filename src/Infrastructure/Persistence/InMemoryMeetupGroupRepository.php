<?php
declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\MeetupGroup\MeetupGroupRepository;
use Ramsey\Uuid\Uuid;

final class InMemoryMeetupGroupRepository implements MeetupGroupRepository
{
    private $meetupGroups = [];

    public function add(MeetupGroup $meetupGroup)
    {
        $this->meetupGroups[$meetupGroup->meetupGroupId()] = $meetupGroup;
    }

    public function getById(string $meetupGroupId) : MeetupGroup
    {
        if (!isset($this->meetupGroups[$meetupGroupId])) {
            throw new \LogicException(sprintf('Meetup group "%s" not found', $meetupGroupId));
        }

        return $this->meetupGroups[$meetupGroupId];
    }

    public function nextIdentity() : string
    {
        return (string) Uuid::uuid4();
    }
}
