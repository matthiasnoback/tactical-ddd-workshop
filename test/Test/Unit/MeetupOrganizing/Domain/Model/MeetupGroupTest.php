<?php

namespace Test\Unit\MeetupOrganizing\Domain\Model;

use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroup;
use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;
use MeetupOrganizing\Domain\Model\User\UserId;
use Ramsey\Uuid\Uuid;

final class MeetupGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_has_an_id_and_a_name()
    {
        $meetupGroupId = MeetupGroupId::fromString((string)Uuid::uuid4());
        $name = 'Ibuildings Events';
        $meetupGroup = new MeetupGroup($meetupGroupId, $name);

        $this->assertSame($name, $meetupGroup->name());
        $this->assertEquals($meetupGroupId, $meetupGroup->meetupGroupId());
    }

    /**
     * @test
     */
    public function it_accepts_new_members()
    {
        $memberId1 = UserId::fromString((string)Uuid::uuid4());
        $memberId2 = UserId::fromString((string)Uuid::uuid4());

        $meetupGroup = new MeetupGroup(
            MeetupGroupId::fromString((string)Uuid::uuid4()),
            'Ibuildings Events'
        );
        $meetupGroup->addMember($memberId1);
        $meetupGroup->addMember($memberId2);

        $this->assertSame([$memberId1, $memberId2], $meetupGroup->memberIds());
    }
}
