<?php
declare(strict_types=1);

namespace Domain\Model\MeetupGroup;

final class MeetupGroup
{
    /**
     * @var string
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

    public function __construct(string $meetupGroupId, string $name)
    {
        $this->meetupGroupId = $meetupGroupId;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function meetupGroupId() : string
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

    public function addMember($memberId)
    {
        $this->memberIds[] = $memberId;
    }

    public function memberIds() : array
    {
        return $this->memberIds;
    }
}
