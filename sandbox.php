<?php
declare(strict_types = 1);

use Common\EventDispatcher\EventCliLogger;
use Common\EventDispatcher\EventDispatcher;
use Domain\Model\Meetup\MeetupId;
use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\Rsvp\Rsvp;
use Domain\Model\Rsvp\RsvpId;
use Domain\Model\User\User;
use Infrastructure\DomainEvents\Fixtures\DummyDomainEvent;
use Infrastructure\Persistence\InMemoryMeetupGroupRepository;
use Infrastructure\Persistence\InMemoryUserRepository;
use Ramsey\Uuid\Uuid;

require __DIR__ . '/vendor/autoload.php';

$userRepository = new InMemoryUserRepository();
$meetupGroupRepository = new InMemoryMeetupGroupRepository();

$eventDispatcher = new EventDispatcher();
$eventDispatcher->subscribeToAllEvents(new EventCliLogger());

$user = new User(
    $userRepository->nextIdentity(),
    'Matthias Noback',
    'matthiasnoback@gmail.com'
);
$userRepository->add($user);

$meetupGroup = new MeetupGroup(
    $meetupGroupRepository->nextIdentity(),
    'Ibuildings Events'
);
$meetupGroupRepository->add($meetupGroup);

$meetup = \Domain\Model\Meetup\Meetup::schedule(
    MeetupId::fromString((string)Uuid::uuid4()),
    $meetupGroup->meetupGroupId(),
    $user->userId(),
    'Lunchmeeting bij Het Broodlokaal',
    new \DateTimeImmutable('12:30')
);

$rsvpId = RsvpId::fromString((string)Uuid::uuid4());
$rsvp = Rsvp::yes($rsvpId, $meetup->meetupId(), $user->userId());
$rsvp->changeToNo();

dump($meetup);
dump($rsvp);

//$eventDispatcher->dispatch(new DummyDomainEvent());
