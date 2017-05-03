<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\MeetupGroup;

use Membership\Domain\Model\User\UserId;

final class MeetupGroup
{
    /**
     * @var MeetupGroupId
     */
    private $meetupGroupId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $memberIds = [];

    public function __construct(MeetupGroupId $meetupGroupId, string $name)
    {
        $this->meetupGroupId = $meetupGroupId;
        $this->name = $name;
    }

    /**
     * @return MeetupGroupId
     */
    public function meetupGroupId() : MeetupGroupId
    {
        return $this->meetupGroupId;
    }

    /**
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }

    public function addMember(UserId $memberId)
    {
        $this->memberIds[] = $memberId;
    }

    public function memberIds() : array
    {
        return $this->memberIds;
    }
}
