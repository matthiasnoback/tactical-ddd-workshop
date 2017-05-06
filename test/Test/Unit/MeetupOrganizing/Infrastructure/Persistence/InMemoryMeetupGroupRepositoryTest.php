<?php
declare(strict_types=1);

namespace Test\Unit\MeetupOrganizing\Infrastructure\Persistence;

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

    /**
     * @test
     */
    public function it_fails_when_the_given_meetup_group_does_not_exist()
    {
        $repository = new InMemoryMeetupGroupRepository();
        $this->expectException(\RuntimeException::class);

        $repository->getById(MeetupGroupId::fromString('ae9ab5d9-51c6-4a3a-b26a-5f30bacc3a77'));
    }

    /**
     * @test
     */
    public function it_provides_a_next_identity()
    {
        $repository = new InMemoryMeetupGroupRepository();

        $this->assertInstanceOf(MeetupGroupId::class, $repository->nextIdentity());
    }
}
