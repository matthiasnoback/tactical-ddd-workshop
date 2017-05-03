<?php
declare(strict_types = 1);

namespace Test\Unit\Infrastructure\Persistence;

use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroup;
use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;
use MeetupOrganizing\Infrastructure\Persistence\InMemoryMeetupGroupRepository;
use Ramsey\Uuid\Uuid;

class InMemoryMeetupGroupRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_keeps_meetup_groups_and_is_able_to_retrieve_them_by_their_id()
    {
        $repository = new InMemoryMeetupGroupRepository();

        $meetupGroupId = MeetupGroupId::fromString((string)Uuid::uuid4());
        $meetupGroup = new MeetupGroup($meetupGroupId, 'Ibuildings Events');
        $repository->add($meetupGroup);

        $retrievedUser = $repository->getById($meetupGroupId);
        $this->assertSame($meetupGroup, $retrievedUser);
    }
}
