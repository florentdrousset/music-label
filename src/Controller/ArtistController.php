<?php

namespace App\Controller;

use App\Api\WikiController;
use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/artist")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/", name="artist_index", methods={"GET"})
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        return $this->render('artist/index.html.twig', [
            'artists' => $artistRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="artist", methods={"GET"})
     */
    public function oneArtist(Artist $artist, WikiController $wiki): Response
    {
        $json = $wiki->curlRequest($artist->getName());
        $artistDesc = json_decode($json, true);
        $artistDesc = $artistDesc[2][0];
        return $this->render('artist/artistIndex.html.twig', [
            'artist' => $artist,
            'artistDesc' => $artistDesc
        ]);
    }

    /**
     * @Route("/new", name="artist_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            //on previent doctrine qu'il faut prendre en compte cette objet
            $entityManager->flush();
            //on remplit la base de données.
            $this->addFlash('success', 'Artiste ajouté');

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_show", methods={"GET"})
     */
    public function show(Artist $artist): Response
    {
        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artist_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Artist $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Artist $artist): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artist_index');
    }

    /**
     * @Route("/{id}/same-style", name="artist_style", methods={"GET","POST"})
     */
    public function sameStyle(ArtistRepository $ar, Artist $artist) {
        $list = $ar->findBy(
            ['genre' => $artist->getGenre()]
        );
        $filteredList = array_map(function($item) {
            return ['id' => $item->getId(),
                'name' => $item->getName(),
                'href' => $this->generateUrl('artist', ['id' => $item->getId()])
            ];
        }, $list);
        return new JsonResponse($filteredList);
    }
}
