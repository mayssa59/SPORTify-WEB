<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Salledesport;
use App\Form\SalledesportType;


/**
 * @Route("/salledesport")
 */
class SalledesportController extends AbstractController
{
    /**
     * @Route("/salledesport", name="salledesport_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {

            $query =$this->getDoctrine()->getRepository(Salledesport::class)->createQueryBuilder('u');
            $query->where('u.nomSalle LIKE :title')
                ->setParameter("title","%$var%")
                ->getQuery();


            $Salle= $query->getQuery()->getResult();

        }
        else
        {
            $Salle = $this->getDoctrine()
                ->getRepository(Salledesport::class)
                ->findAll();
        }


        return $this->render('salledesport/index.html.twig', [
            'salledesport' => $Salle,
        ]);
    }

    /**
     * @Route("/recherche", name="recherche", methods={"POST", "GET"})
     */
    public function recherche(Request $request):response
    {
        $id = $request->request->get('request');
        if ($id!="")
        {

            $query =$this->getDoctrine()->getRepository(Salledesport::class)->createQueryBuilder('u');
            $query->where('u.nomSalle LIKE :title')
                ->setParameter("title","%$id%")
                ->getQuery();


            $Salle = $query->getQuery()->getResult();

        }
        else
        {
            $Salle = $this->getDoctrine()
                ->getRepository(Salledesport::class)
                ->findAll();
        }


        return $this->json(['Salle' => $Salle]);
    }


    /**
     * @Route("/new", name="Salle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $Salle = new Salledesport();

        $form = $this->createForm(SalledesportType::class, $Salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Salle);
            $entityManager->flush();

            return $this->redirectToRoute('salledesport_index');
        }

        return $this->render('salledesport/new.html.twig', [
            'Salle' => $Salle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSalle}", name="Salle_show", methods={"GET"})
     */
    public function show(Salledesport $Salle): Response
    {
        return $this->render('salledesport/show.html.twig', [
            'Salle' => $Salle,
        ]);
    }

    /**
     * @Route("/{idSalle}/edit", name="Salle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Salledesport $Salle): Response
    {
        $form = $this->createForm(SalledesportType::class, $Salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salledesport_index');
        }

        return $this->render('salledesport/edit.html.twig', [
            'Salle' => $Salle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSalle}", name="Salle_delete", methods={"POST"})
     */
    public function delete(Request $request, Salledesport $Salle): Response
    {
        if ($this->isCsrfTokenValid('delete' . $Salle->getIdSalle(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Salle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salledesport_index');
    }


}
