<?php
declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Model\User\User;
use Domain\Model\User\UserRepository;
use Ramsey\Uuid\Uuid;

final class InMemoryUserRepository implements UserRepository
{
    private $users = [];

    public function add(User $user)
    {
        $this->users[$user->userId()] = $user;
    }

    public function getById(string $userId) : User
    {
        if (!isset($this->users[$userId])) {
            throw new \LogicException(sprintf('User "%s" not found', $userId));
        }

        return $this->users[$userId];
    }

    public function nextIdentity() : string
    {
        return (string) Uuid::uuid4();
    }
}
