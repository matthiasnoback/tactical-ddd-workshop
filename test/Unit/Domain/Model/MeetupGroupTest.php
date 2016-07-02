<?php

namespace Test\Unit\Domain\Model;

use Domain\Model\MeetupGroup\MeetupGroup;
use Ramsey\Uuid\Uuid;

class MeetupGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_has_an_id_and_a_name()
    {
        $meetupGroupId = (string) Uuid::uuid4();
        $name = 'Ibuildings Events';
        $meetupGroup = new MeetupGroup($meetupGroupId, $name);

        $this->assertSame($name, $meetupGroup->name());
        $this->assertSame($meetupGroupId, $meetupGroup->meetupGroupId());
    }

    /**
     * @test
     */
    public function it_accepts_new_members()
    {
        $memberId1 = (string) Uuid::uuid4();
        $memberId2 = (string) Uuid::uuid4();

        $meetupGroup = new MeetupGroup((string) Uuid::uuid4(), 'Ibuildings Events');
        $meetupGroup->addMember($memberId1);
        $meetupGroup->addMember($memberId2);

        $this->assertSame([$memberId1, $memberId2], $meetupGroup->memberIds());
    }
}
