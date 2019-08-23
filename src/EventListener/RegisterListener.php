<?php
namespace App\EventListener;
use App\Event\RegisterEvent;

class RegisterListener
{
    public $mailer;
    public function __construct(\Swift_Mailer $swift) {
        $this->mailer = $swift;
    }
    public function sendMailToUser(RegisterEvent $e){
        // Create the message
        $message = (new \Swift_Message())
            // Add subject
            ->setSubject('Here should be a subject')

            //Put the From address
            ->setFrom(['support@mailtrap.io'])
            ->setTo(['coucou@lol.com'])
            ->setBody('yo !');

        $this->mailer->send($message);
    }
}