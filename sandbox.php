<?php
declare(strict_types = 1);

use Domain\Model\Meetup\Meetup;
use Domain\Model\Meetup\MeetupId;
use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\Rsvp\Rsvp;
use Domain\Model\Rsvp\RsvpId;
use Domain\Model\User\User;
use Infrastructure\DomainEvents\DomainEventCliLogger;
use Infrastructure\DomainEvents\DomainEventDispatcher;
use Infrastructure\DomainEvents\Fixtures\DummyDomainEvent;
use Infrastructure\Persistence\InMemoryMeetupGroupRepository;
use Infrastructure\Persistence\InMemoryUserRepository;
use Ramsey\Uuid\Uuid;

require __DIR__ . '/vendor/autoload.php';

$userRepository = new InMemoryUserRepository();
$meetupGroupRepository = new InMemoryMeetupGroupRepository();

$eventDispatcher = new DomainEventDispatcher();
$eventDispatcher->subscribeToAllEvents(new DomainEventCliLogger());

$user = new User(
    $userRepository->nextIdentity(),
    'Matthias Noback',
    'matthiasnoback@gmail.com'
);
$userRepository->add($user);

$meetupGroup = new MeetupGroup(
    $meetupGroupRepository->nextIdentity(),
    'PHPBenelux meetups'
);
$meetupGroupRepository->add($meetupGroup);

// assignment/01

$meetupId = MeetupId::fromString(Uuid::uuid4()->toString());
$meetup = Meetup::schedule(
    $meetupId,
    'PHPBenelux post-workshop social',
    new \DateTimeImmutable('2017-01-27 12:30'),
    $user->userId(),
    $meetupGroup->meetupGroupId()
);

// persist $meetup

$rsvp = $meetup->rsvpYes($user->userId());

// persist $rsvp

echo str_repeat('#', 100) ."\n\n";

dump($meetup);

echo str_repeat('#', 100) ."\n\n";

dump($rsvp);
//$eventDispatcher->dispatch(new DummyDomainEvent());
