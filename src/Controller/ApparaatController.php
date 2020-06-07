<?php

namespace App\Controller;

use App\Entity\Apparaat;
use App\Form\ApparaatType;
use App\Repository\ApparaatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/apparaat")
 */
class ApparaatController extends AbstractController
{
    /**
     * @Route("/", name="apparaat_index", methods={"GET"})
     */
    public function index(ApparaatRepository $apparaatRepository): Response
    {
        return $this->render('apparaat/index.html.twig', [
            'apparaats' => $apparaatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="apparaat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $apparaat = new Apparaat();
        $form = $this->createForm(ApparaatType::class, $apparaat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apparaat);
            $entityManager->flush();

            return $this->redirectToRoute('apparaat_index');
        }

        return $this->render('apparaat/new.html.twig', [
            'apparaat' => $apparaat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="apparaat_show", methods={"GET"})
     */
    public function show(Apparaat $apparaat): Response
    {
        return $this->render('apparaat/show.html.twig', [
            'apparaat' => $apparaat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="apparaat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Apparaat $apparaat): Response
    {
        $form = $this->createForm(ApparaatType::class, $apparaat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apparaat_index');
        }

        return $this->render('apparaat/edit.html.twig', [
            'apparaat' => $apparaat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="apparaat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Apparaat $apparaat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apparaat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($apparaat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('apparaat_index');
    }
}
