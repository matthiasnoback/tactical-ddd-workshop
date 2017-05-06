<?php
declare(strict_types = 1);

use Common\EventDispatcher\EventCliLogger;
use Common\EventDispatcher\EventDispatcher;
use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroup;
use MeetupOrganizing\Domain\Model\User\User;
use MeetupOrganizing\Infrastructure\Persistence\InMemoryMeetupGroupRepository;
use MeetupOrganizing\Infrastructure\Persistence\InMemoryUserRepository;

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

// dispatch domain events
//$eventDispatcher->dispatch(new \stdClass());
