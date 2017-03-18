<?php
declare(strict_types = 1);

use Application\OrganizerRsvpYesWhenMeetupScheduled;
use Common\EventDispatcher\EventCliLogger;
use Common\EventDispatcher\EventDispatcher;
use Domain\Model\Meetup\MeetupId;
use Domain\Model\Meetup\MeetupScheduled;
use Domain\Model\MeetupGroup\MeetupGroup;
use Domain\Model\User\User;
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

$eventDispatcher->registerSubscriber(
    MeetupScheduled::class,
    new OrganizerRsvpYesWhenMeetupScheduled()
);
$meetup = \Domain\Model\Meetup\Meetup::schedule(
    MeetupId::fromString((string)Uuid::uuid4()),
    $meetupGroup->meetupGroupId(),
    $user->userId(),
    'Lunchmeeting bij Het Broodlokaal',
    new \DateTimeImmutable('12:30')
);
foreach ($meetup->recordedEvents() as $event) {
    $eventDispatcher->dispatch($event);
}
$meetup->clearEvents();

dump($meetup);
