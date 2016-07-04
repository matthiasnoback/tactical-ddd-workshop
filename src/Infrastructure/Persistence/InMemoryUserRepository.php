<?php
declare(strict_types = 1);

namespace Infrastructure\Persistence;

use Domain\Model\User\User;
use Domain\Model\User\UserId;
use Domain\Model\User\UserRepository;
use Ramsey\Uuid\Uuid;

final class InMemoryUserRepository implements UserRepository
{
    private $users = [];

    public function add(User $user)
    {
        $this->users[(string)$user->userId()] = $user;
    }

    public function getById(UserId $userId) : User
    {
        if (!isset($this->users[(string)$userId])) {
            throw new \LogicException(sprintf('User "%s" not found', $userId));
        }

        return $this->users[(string)$userId];
    }

    public function nextIdentity() : UserId
    {
        return UserId::fromString((string)Uuid::uuid4());
    }
}
