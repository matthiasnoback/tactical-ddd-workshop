<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

final class Location
{
    private $address;
    private $geolocation;

    private function __construct(string $address, Geolocation $geolocation)
    {
        if (empty($address)) {
            throw new \InvalidArgumentException('Address should not be empty');
        }

        $this->address = $address;
        $this->geolocation = $geolocation;
    }

    public static function fromAddressAndGeolocation(string $address, Geolocation $geolocation): Location
    {
        return new self($address, $geolocation);
    }
}
