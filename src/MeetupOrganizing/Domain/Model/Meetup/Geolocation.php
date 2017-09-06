<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

final class Geolocation
{
    private $latitude;
    private $longitude;

    private function __construct(float $latitude, float $longitude)
    {
        if ($latitude < -90 || $latitude > 90) {
            throw new \InvalidArgumentException('Latitude should be between -90 and 90');
        }

        if ($longitude < -180 || $longitude > 180) {
            throw new \InvalidArgumentException('Longitude should be between -180 and 180');
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public static function fromCoordinates(float $latitude, float $longitude): Geolocation
    {
        return new self($latitude, $longitude);
    }
}
