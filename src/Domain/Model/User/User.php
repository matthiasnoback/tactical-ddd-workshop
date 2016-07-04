<?php
declare(strict_types=1);

namespace Domain\Model\User;

final class User
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $emailAddress;

    public function __construct(UserId $userId, string $name, string $emailAddress)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return UserId
     */
    public function userId() : UserId
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function emailAddress()
    {
        return $this->emailAddress;
    }
}
