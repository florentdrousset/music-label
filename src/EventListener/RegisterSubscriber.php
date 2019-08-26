<?php


namespace App\EventListener;
use App\Event\RegisterEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RegisterSubscriber implements EventSubscriberInterface
{
    public $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function displayRegistrationMessage() {
        $this->session->getFlashBag()->add('success', 'Vous êtes enregistré ! Bienvenue.');;
    }

    public function responseDump(KernelEvent $e) {
        //dd($e->getResponse());
    }
    public static function getSubscribedEvents() {
       return [
           RegisterEvent::NAME => ['displayRegistrationMessage', 3],
           //KernelEvents::RESPONSE => ['responseDump', 10]
       ];
    }
}