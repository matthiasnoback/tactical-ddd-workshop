<?php
declare(strict_types=1);

namespace Test\Unit\MeetupOrganizing\Domain\Model;

use MeetupOrganizing\Domain\Model\User\User;
use MeetupOrganizing\Domain\Model\User\UserId;

final class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_has_an_id_name_and_email_address()
    {
        $userId = UserId::fromString('b943eab5-ea0e-43df-bb47-cbbc19168df9');
        $name = 'Matthias Noback';
        $emailAddress = 'matthiasnoback@gmail.com';

        $user = new User($userId, $name, $emailAddress);
        $this->assertEquals($userId, $user->userId());
        $this->assertEquals($name, $user->name());
        $this->assertEquals($emailAddress, $user->emailAddress());
    }
}
