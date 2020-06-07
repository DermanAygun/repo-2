<?php

namespace App\Controller;

use App\Entity\Apparaat;
use App\Entity\Locatie;
use App\Entity\Onderdeel;
use App\Form\AfvalLocatieType;
use App\Form\ApparaatRegistrerenType;
use App\Form\LocatieType;
use App\Form\OnderdeelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/afval-registreren", name="afvalRegisteren", methods={"GET","POST"})
     */
    public function afvalRegisteren(Request $request): Response
    {
        $locatie = new Locatie();
        $form = $this->createForm(AfvalLocatieType::class, $locatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($locatie);
            $entityManager->flush();

            return $this->redirectToRoute('default');
        }

        return $this->render('default/afval_registreren.html.twig', [
            'locatie' => $locatie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/apparaat-registreren", name="apparaatRegisteren", methods={"GET","POST"})
     */
    public function apparaatRegistreren(Request $request): Response
    {
        $apparaat = new Apparaat();
        $form = $this->createForm(ApparaatRegistrerenType::class, $apparaat);
        $form->handleRequest($request);

        $date = new \DateTime('now');

        if ($form->isSubmitted() && $form->isValid()) {

            $apparaat->setDatumInname($date);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apparaat);
            $entityManager->flush();

            return $this->redirectToRoute('onderdeelRegistreren');
        }

        return $this->render('default/apparaat_registreren.html.twig', [
            'apparaat' => $apparaat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/onderdeel-registreren", name="onderdeelRegistreren", methods={"GET","POST"})
     */
    public function onderdeelRegistreren(Request $request): Response
    {
        $onderdeel = new Onderdeel();
        $form = $this->createForm(OnderdeelType::class, $onderdeel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($onderdeel);
            $entityManager->flush();

            return $this->redirectToRoute('default');
        }

        return $this->render('default/onderdeel_registreren.html.twig', [
            'onderdeel' => $onderdeel,
            'form' => $form->createView(),
        ]);
    }


}
