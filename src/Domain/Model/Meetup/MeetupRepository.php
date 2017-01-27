<?php
declare(strict_types = 1);

namespace Domain\Model\Meetup;

interface MeetupRepository
{
    public function add(Meetup $meetup);

    public function getById(MeetupId $meetupId) : Meetup;

    public function nextIdentity() : MeetupId;
}
