<?php
declare(strict_types = 1);

use Common\EventDispatcher\EventCliLogger;
use Common\EventDispatcher\EventDispatcher;
use Domain\Model\Meetup\Meetup;
use Domain\Model\Meetup\MeetupId;
use Domain\Model\Meetup\ScheduledDate;
use Domain\Model\Meetup\UserIdFactory;
use Domain\Model\Meetup\WorkingTitle;
use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\Rsvp\Rsvp;
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

/*
 * In the "Membership" context
 */
$user = new User(
    $userRepository->nextIdentity(),
    'Matthias Noback',
    'matthiasnoback@gmail.com'
);
$userRepository->add($user);

/*
 * In the "Meetup Organizing" context
 */
$meetupGroup = new MeetupGroup(
    $meetupGroupRepository->nextIdentity(),
    'Akeneo Meetups'
);
$meetupGroupRepository->add($meetupGroup);

$userIdFactory = new UserIdFactory();
$organizerId = $userIdFactory->createOrganizerId((string)$user->userId());

$meetupId = MeetupId::fromString((string)Uuid::uuid4());
$meetup = Meetup::schedule(
    $meetupId,
    $meetupGroup->meetupGroupId(),
    $organizerId,
    new WorkingTitle('May Meetup'),
    ScheduledDate::fromDateTime(new \DateTimeImmutable('2017-05-05 19:00'))
);
dump($meetup);

// Somehow link these two (eventual consistency!)
$rsvpId = \Domain\Model\Rsvp\RsvpId::fromString((string)Uuid::uuid4());
$rsvp = Rsvp::yes($rsvpId, $meetupId, $organizerId->asUserId());
dump($rsvp);

//$eventDispatcher->dispatch(new DummyDomainEvent());
