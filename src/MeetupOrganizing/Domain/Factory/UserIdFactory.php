<?php

namespace MeetupOrganizing\Domain\Factory;

use MeetupOrganizing\Domain\Model\Meetup\OrganizerId;
use MeetupOrganizing\Domain\Model\Rsvp\AttendeeId;

interface UserIdFactory
{
    public function createOrganizerId(string $userId): OrganizerId;

    public function createAttendeeId(string $userId): AttendeeId;
}
