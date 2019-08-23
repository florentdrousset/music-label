<?php


namespace App\Event;
use Symfony\Contracts\EventDispatcher\Event;

final class RegisterEvent extends Event
{
    public const NAME = 'user.register';
    private $user;
    public function __construct(\App\Entity\User $user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }
}