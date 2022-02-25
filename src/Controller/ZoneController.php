<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Zone;
use App\Form\ZoneType;
/**
 * @Route("/zone")
 */
class ZoneController extends AbstractController
{
    /**
     * @Route("/zone", name="zone", methods={"GET"})
     */
    public function index(): Response
    {
        $zone = $this->getDoctrine()
            ->getRepository(Zone::class)
            ->findAll();
        return $this->render('zone/index.html.twig', [
            'zone' => $zone,
        ]);
    }

    /**
     * @Route("/Table", name="Table", methods={"POST", "GET"})
     */
    public function Table():response
    {
            // array of CmsUser username and name values

        $zone = $this->getDoctrine()
            ->getRepository(Zone::class)
            ->findAll();



        return $this->json(['zone' => $zone]);
    }

    /**
     * @Route("/new", name="zone_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $zone = new Zone();
        $form = $this->createForm(ZoneType::class, $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zone);
            $entityManager->flush();

            return $this->redirectToRoute('zone');
        }

        return $this->render('zone/new.html.twig', [
            'zone' => $zone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{region}", name="zone_show", methods={"GET"})
     */
    public function show(Zone $zone): Response
    {
        return $this->render('zone/show.html.twig', [
            'zone' => $zone,
        ]);
    }



    /**
     * @Route("/{region}", name="zone_delete", methods={"POST"})
     */
    public function delete(Request $request, Zone $zone): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zone->getRegion(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($zone);
            $entityManager->flush();
        }

        return $this->redirectToRoute('zone');
    }
    /**
     * @Route("/{region}/edit", name="zone_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Zone $zone): Response
    {
        $form = $this->createForm(ZoneType::class, $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zone');
        }

        return $this->render('zone/edit.html.twig', [
            'zone' => $zone,
            'form' => $form->createView(),
        ]);
    }
}
