<?php
declare(strict_types=1);

namespace Domain\Model\MeetupGroup;

interface MeetupGroupRepository
{
    public function add(MeetupGroup $meetupGroup);

    public function getById(string $meetupGroupId) : MeetupGroup;

    public function nextIdentity() : string;
}
