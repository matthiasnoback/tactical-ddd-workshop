<?php
declare(strict_types = 1);

use Application\Meetup\ScheduleMeetup;
use Application\Meetup\ScheduleMeetupHandler;
use Domain\Model\Meetup\Meetup;
use Domain\Model\Meetup\MeetupId;
use Domain\Model\Meetup\MeetupScheduled;
use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\Rsvp\Rsvp;
use Domain\Model\Rsvp\RsvpId;
use Domain\Model\User\User;
use Infrastructure\DomainEvents\DomainEventCliLogger;
use Infrastructure\DomainEvents\DomainEventDispatcher;
use Infrastructure\Persistence\InMemoryMeetupGroupRepository;
use Infrastructure\Persistence\InMemoryMeetupRepository;
use Infrastructure\Persistence\InMemoryUserRepository;
use Ramsey\Uuid\Uuid;

require __DIR__ . '/vendor/autoload.php';

function debug($message)
{
    echo str_repeat('#', 50) . "\n";
    echo "   $message\n";
    echo str_repeat('#', 50) . "\n";
}

$userRepository = new InMemoryUserRepository();
$meetupGroupRepository = new InMemoryMeetupGroupRepository();

$eventDispatcher = new DomainEventDispatcher();
$eventDispatcher->subscribeToAllEvents(new DomainEventCliLogger());
$eventDispatcher->registerSubscriber(MeetupScheduled::class, function (MeetupScheduled $event) {
    debug('Create RSVP for organizer');
    $rsvp = Rsvp::yes(
        RsvpId::fromString(Uuid::uuid4()->toString()),
        $event->id(),
        $event->organizerId()
    );

    dump($rsvp);

    debug('Persist RSVP');
});

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

$meetupRepository = new InMemoryMeetupRepository();

$scheduleMeetup = new ScheduleMeetup();
$scheduleMeetup->meetupGroupId = (string)$meetupGroup->meetupGroupId();
$scheduleMeetup->meetupId = (string)$meetupRepository->nextIdentity();
$scheduleMeetup->organizerId = (string)$user->userId();
$scheduleMeetup->scheduledFor = '2017-01-27 12:30';
$scheduleMeetup->workingTitle = 'PHPBenelux post-workshop social';

dump($scheduleMeetup);

$scheduleMeetupHandler = new ScheduleMeetupHandler(
    $userRepository,
    $meetupGroupRepository,
    $meetupRepository,
    $eventDispatcher
);
$scheduleMeetupHandler->__invoke($scheduleMeetup);
