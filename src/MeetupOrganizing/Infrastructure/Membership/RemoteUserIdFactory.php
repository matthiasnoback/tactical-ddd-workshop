<?php
declare(strict_types=1);

namespace MeetupOrganizing\Infrastructure\Membership;

use MeetupOrganizing\Domain\Factory\UserIdFactory;
use MeetupOrganizing\Domain\Model\Meetup\OrganizerId;
use MeetupOrganizing\Domain\Model\Rsvp\AttendeeId;

final class RemoteUserIdFactory implements UserIdFactory
{
    public function createOrganizerId(string $userId): OrganizerId
    {
        // TODO ask the "Membership" context if the given user ID belongs to an organizer

        return OrganizerId::fromString($userId);
    }

    public function createAttendeeId(string $userId): AttendeeId
    {
        return AttendeeId::fromString($userId);
    }
}
