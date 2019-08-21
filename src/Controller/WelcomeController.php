<?php
namespace App\Controller;

use App\Api\GuzzleController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EventRepository;

class WelcomeController extends AbstractController {
    public function welcome(EventRepository $eventRepository, \App\Hello\HelloWorld $h, GuzzleController $curl) {
        $json = $curl->curlRequest('paris');
        $location = json_encode($json, true);

       return $this->render(
           'index/indexview.html.twig', [
               'event' => $eventRepository->findall(),
               'location' => $location
           ]
       );
    }
}
