<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use Common\DomainModel\AggregateId;
use Membership\Domain\Model\User\UserId;

final class OrganizerId
{
    use AggregateId;

    public function asUserId(): UserId
    {
        return UserId::fromString(
            $this->__toString()
        );
    }
}
