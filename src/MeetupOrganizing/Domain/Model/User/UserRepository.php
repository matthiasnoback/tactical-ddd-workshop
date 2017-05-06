<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\User;

interface UserRepository
{
    public function add(User $user);

    public function getById(UserId $userId): User;

    public function nextIdentity(): UserId;
}
