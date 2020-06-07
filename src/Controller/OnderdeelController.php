<?php

namespace App\Controller;

use App\Entity\Onderdeel;
use App\Form\OnderdeelType;
use App\Repository\OnderdeelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/onderdeel")
 */
class OnderdeelController extends AbstractController
{
    /**
     * @Route("/", name="onderdeel_index", methods={"GET"})
     */
    public function index(OnderdeelRepository $onderdeelRepository): Response
    {
        return $this->render('onderdeel/index.html.twig', [
            'onderdeels' => $onderdeelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="onderdeel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $onderdeel = new Onderdeel();
        $form = $this->createForm(OnderdeelType::class, $onderdeel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($onderdeel);
            $entityManager->flush();

            return $this->redirectToRoute('onderdeel_index');
        }

        return $this->render('onderdeel/new.html.twig', [
            'onderdeel' => $onderdeel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="onderdeel_show", methods={"GET"})
     */
    public function show(Onderdeel $onderdeel): Response
    {
        return $this->render('onderdeel/show.html.twig', [
            'onderdeel' => $onderdeel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="onderdeel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Onderdeel $onderdeel): Response
    {
        $form = $this->createForm(OnderdeelType::class, $onderdeel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('onderdeel_index');
        }

        return $this->render('onderdeel/edit.html.twig', [
            'onderdeel' => $onderdeel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="onderdeel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Onderdeel $onderdeel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$onderdeel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($onderdeel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('onderdeel_index');
    }
}
