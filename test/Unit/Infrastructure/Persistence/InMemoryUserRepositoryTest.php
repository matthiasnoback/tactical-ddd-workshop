<?php
declare(strict_types=1);

namespace Test\Unit\Infrastructure\Persistence;

use Domain\Model\User\User;
use Domain\Model\User\UserId;
use Infrastructure\Persistence\InMemoryUserRepository;
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
}
