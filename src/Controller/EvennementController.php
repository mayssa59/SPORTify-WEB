<?php

namespace App\Controller;

use App\Entity\Evennement;
use App\Form\EvennementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evennement")
 */
class EvennementController extends AbstractController
{
    /**
     * @Route("/", name="evennement_index", methods={"GET"})
     */
    public function index(Request $request):response
    {
        $var = $request->query->get('users');
        if ($var != "") {

            $evennements = $this->getDoctrine()->getRepository(Evennement::class)->findByTypeField($var);

        } else {
            $evennements = $this->getDoctrine()
                ->getRepository(Evennement::class)
                ->findAll();
        }
        return $this->render('evennement/index.html.twig', [
            'evennements' => $evennements,
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
            $query =$this->getDoctrine()->getRepository(evennement::class)->createQueryBuilder('u');
            $query->where('u.nomEvennement LIKE :title')
                ->setParameter("title","%nomEvennement%")
                ->getQuery();

            $evennements = $query->getQuery()->getResult();
        }
        else
        {
            $evennements = $this->getDoctrine()
                ->getRepository(evennement::class)
                ->findAll();
        }
        return $this->json(['evennements' => $evennements]);
    }


    /**
     * @Route("/new", name="evennement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evennement = new Evennement();
        $form = $this->createForm(EvennementType::class, $evennement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evennement);
            $entityManager->flush();
            $session = $request->getSession();
            $session->set('notif', 'fait');
            return $this->redirectToRoute('evennement_index');
        }

        return $this->render('evennement/new.html.twig', [
            'evennement' => $evennement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEvennement}", name="evennement_show", methods={"GET"})
     */
    public function show(Evennement $evennement): Response
    {
        return $this->render('evennement/show.html.twig', [
            'evennement' => $evennement,
        ]);
    }

    /**
     * @Route("/{idEvennement}/edit", name="evennement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evennement $evennement): Response
    {
        $form = $this->createForm(EvennementType::class, $evennement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evennement_index');
        }

        return $this->render('evennement/edit.html.twig', [
            'evennement' => $evennement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEvennement}", name="evennement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evennement $evennement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evennement->getIdEvennement(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evennement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evennement_index');
    }
}
