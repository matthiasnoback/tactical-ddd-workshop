<?php
declare(strict_types=1);

namespace Test\Unit\Domain\Model;

use MeetupOrganizing\Domain\Model\Meetup\Geolocation;

class GeolocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider coordinates
     */
    public function it_only_accepts_valid_coordinates(float $latitude, float $longitude, bool $expectedToBeValid)
    {
        if (!$expectedToBeValid) {
            $this->expectException(\InvalidArgumentException::class);
        }

        $geolocation = Geolocation::fromCoordinates($latitude, $longitude);

        $this->assertInstanceOf(Geolocation::class, $geolocation);
    }

    public function coordinates(): array
    {
        return [
            [90, -181, false], // longitude too small
            [-91, 180, false], // latitude too small
            [91, -180, false], // latitude too large
            [90, 181, false], // longitude too large
            [90, -180, true],
            [90, 180, true],
            [-90, -180, true],
            [-90, 180, true],
        ];
    }
}
