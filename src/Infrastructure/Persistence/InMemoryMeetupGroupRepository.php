<?php
declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\MeetupGroup\MeetupGroupId;
use Domain\Model\MeetupGroup\MeetupGroupRepository;
use Ramsey\Uuid\Uuid;

final class InMemoryMeetupGroupRepository implements MeetupGroupRepository
{
    private $meetupGroups = [];

    public function add(MeetupGroup $meetupGroup)
    {
        $this->meetupGroups[(string) $meetupGroup->meetupGroupId()] = $meetupGroup;
    }

    public function getById(MeetupGroupId $meetupGroupId) : MeetupGroup
    {
        if (!isset($this->meetupGroups[(string)$meetupGroupId])) {
            throw new \LogicException(sprintf('Meetup group "%s" not found', $meetupGroupId));
        }

        return $this->meetupGroups[(string)$meetupGroupId];
    }

    public function nextIdentity() : MeetupGroupId
    {
        return MeetupGroupId::fromString((string) Uuid::uuid4());
    }
}
