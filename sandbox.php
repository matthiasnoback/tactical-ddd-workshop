<?php
declare(strict_types = 1);

use Domain\Model\Meetup\Meetup;
use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\User\User;
use Infrastructure\DomainEvents\DomainEventCliLogger;
use Infrastructure\DomainEvents\DomainEventDispatcher;
use Infrastructure\DomainEvents\Fixtures\DummyDomainEvent;
use Infrastructure\Persistence\InMemoryMeetupGroupRepository;
use Infrastructure\Persistence\InMemoryUserRepository;

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

$meetup = Meetup::schedule(
    \Ramsey\Uuid\Uuid::uuid4(),
    'PHPBenelux post-workshop social',
    new \DateTimeImmutable('2017-01-27 12:30'),
    $user,
    $meetupGroup
);

dump($meetup);

//$eventDispatcher->dispatch(new DummyDomainEvent());
