<?php


namespace App\Controller;
use App\Repository\EventRepository;
use App\Repository\StreamingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller;
use App\Repository\ProductRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    function test(EventRepository $eventRepository, ProductRepository $productRepository, ArtistRepository $artistRepository) {
        return $this->render('admin/adminView.html.twig', [
            //'artist' => $eventRepository->findByEvents(),
            'artists' => $artistRepository->findByExampleField(),
            'genres' => $productRepository->tunesByGenre()
        ]);
    }
}