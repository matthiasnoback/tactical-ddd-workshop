<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

final class Location
{
    private $address;
    private $geolocation;

    private function __construct(Address $address, Geolocation $geolocation)
    {
        $this->address = $address;
        $this->geolocation = $geolocation;
    }

    public static function fromAddressAndGeolocation(Address $address, Geolocation $geolocation): Location
    {
        return new self($address, $geolocation);
    }
}
