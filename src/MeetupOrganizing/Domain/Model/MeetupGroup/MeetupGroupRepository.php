<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\MeetupGroup;

interface MeetupGroupRepository
{
    public function add(MeetupGroup $meetupGroup);

    public function getById(MeetupGroupId $meetupGroupId) : MeetupGroup;

    public function nextIdentity() : MeetupGroupId;
}
