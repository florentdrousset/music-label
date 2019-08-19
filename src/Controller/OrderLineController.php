<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Form\OrderLineType;
use App\Repository\OrderLineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order/line")
 */
class OrderLineController extends AbstractController
{
    /**
     * @Route("/", name="order_line_index", methods={"GET"})
     */
    public function index(OrderLineRepository $orderLineRepository): Response
    {
        return $this->render('order_line/index.html.twig', [
            'order_lines' => $orderLineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="order_line_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $orderLine = new OrderLine();
        $form = $this->createForm(OrderLineType::class, $orderLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orderLine);
            $entityManager->flush();

            return $this->redirectToRoute('order_line_index');
        }

        return $this->render('order_line/new.html.twig', [
            'order_line' => $orderLine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_line_show", methods={"GET"})
     */
    public function show(OrderLine $orderLine): Response
    {
        return $this->render('order_line/show.html.twig', [
            'order_line' => $orderLine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_line_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OrderLine $orderLine): Response
    {
        $form = $this->createForm(OrderLineType::class, $orderLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_line_index');
        }

        return $this->render('order_line/edit.html.twig', [
            'order_line' => $orderLine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_line_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OrderLine $orderLine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderLine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orderLine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_line_index');
    }
}
