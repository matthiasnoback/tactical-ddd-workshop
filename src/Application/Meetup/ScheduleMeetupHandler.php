<?php
declare(strict_types = 1);

namespace Application\Meetup;

use Domain\Model\Meetup\Meetup;
use Domain\Model\Meetup\MeetupId;
use Domain\Model\Meetup\MeetupRepository;
use Domain\Model\MeetupGroup\MeetupGroupId;
use Domain\Model\MeetupGroup\MeetupGroupRepository;
use Domain\Model\User\UserId;
use Domain\Model\User\UserRepository;
use Infrastructure\DomainEvents\DomainEventDispatcher;

final class ScheduleMeetupHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var MeetupGroupRepository
     */
    private $meetupGroupRepository;

    /**
     * @var MeetupRepository
     */
    private $meetupRepository;
    /**
     * @var DomainEventDispatcher
     */
    private $eventDispatcher;

    public function __construct(UserRepository $userRepository, MeetupGroupRepository $meetupGroupRepository, MeetupRepository $meetupRepository, DomainEventDispatcher $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->meetupGroupRepository = $meetupGroupRepository;
        $this->meetupRepository = $meetupRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(ScheduleMeetup $command)
    {
        $organizer = $this->userRepository->getById(UserId::fromString($command->organizerId));
        $meetupGroup = $this->meetupGroupRepository->getById(MeetupGroupId::fromString($command->meetupGroupId));

        $meetup = Meetup::schedule(
            MeetupId::fromString($command->meetupId),
            $command->workingTitle,
            new \DateTimeImmutable($command->scheduledFor),
            $organizer->userId(),
            $meetupGroup->meetupGroupId()
        );

        debug('Persist meetup');

        $this->meetupRepository->add($meetup);

        dump($meetup);

        foreach ($meetup->recordedEvents() as $event) {
            $this->eventDispatcher->dispatch($event);
        }
    }
}
