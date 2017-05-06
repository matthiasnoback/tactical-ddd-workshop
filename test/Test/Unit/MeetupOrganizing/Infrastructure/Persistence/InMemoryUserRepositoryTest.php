<?php
declare(strict_types=1);

namespace Test\Unit\MeetupOrganizing\Infrastructure\Persistence;

use MeetupOrganizing\Domain\Model\User\User;
use MeetupOrganizing\Domain\Model\User\UserId;
use MeetupOrganizing\Infrastructure\Persistence\InMemoryUserRepository;
use Ramsey\Uuid\Uuid;

class InMemoryUserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_keeps_users_and_is_able_to_retrieve_them_by_their_id()
    {
        $repository = new InMemoryUserRepository();

        $userId = UserId::fromString((string)Uuid::uuid4());
        $user = new User($userId, 'Matthias Noback', 'matthiasnoback@gmail.com');
        $repository->add($user);

        $retrievedUser = $repository->getById($userId);
        $this->assertSame($user, $retrievedUser);
    }

    /**
     * @test
     */
    public function it_fails_when_the_given_meetup_group_does_not_exist()
    {
        $repository = new InMemoryUserRepository();
        $this->expectException(\RuntimeException::class);

        $repository->getById(UserId::fromString('ae9ab5d9-51c6-4a3a-b26a-5f30bacc3a77'));
    }

    /**
     * @test
     */
    public function it_provides_a_next_identity()
    {
        $repository = new InMemoryUserRepository();

        $this->assertInstanceOf(UserId::class, $repository->nextIdentity());
    }
}
