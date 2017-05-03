<?php
declare(strict_types=1);

namespace Domain\Model\Meetup;

final class UserIdFactory
{
    /**
     * @param string $userId
     * @return OrganizerId
     * @throws UserIsNotAnOrganizer
     */
    public function createOrganizerId(string $userId): OrganizerId
    {
        // TODO ask the "Membership" context if the given user ID belongs to an organizer

        return OrganizerId::fromString($userId);
    }
}
