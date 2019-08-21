<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EventRepository;

class WelcomeController extends AbstractController {
    public function welcome(EventRepository $eventRepository, \App\Hello\HelloWorld $h) {
       return $this->render(
           'index/indexView.html.twig', [
               'event' => $eventRepository->findAll(),
               'message' => $h->yo()
           ]
       );
    }
}
