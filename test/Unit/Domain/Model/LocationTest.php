<?php
declare(strict_types=1);

namespace test\Unit\Domain\Model;

use MeetupOrganizing\Domain\Model\Meetup\Geolocation;
use MeetupOrganizing\Domain\Model\Meetup\Location;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider values
     */
    public function it_accepts_only_a_valid_address($address, Geolocation $geolocation, bool $expectedToBeValid)
    {
        if (!$expectedToBeValid) {
            $this->expectException(\InvalidArgumentException::class);
        }

        $location = Location::fromAddressAndGeolocation($address, $geolocation);

        $this->assertInstanceOf(Location::class, $location);
    }

    public function values(): array
    {
        $validGeolocation = Geolocation::fromCoordinates(0, 0);

        return [
            ['', $validGeolocation, false],
            ['Some address', $validGeolocation, true]
        ];
    }
}
