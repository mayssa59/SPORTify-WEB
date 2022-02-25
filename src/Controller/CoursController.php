<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMapp;

/**
 * @Route("/cours")
 */
class CoursController extends AbstractController
{
    /**
     * @Route("/cours", name="cours_index", methods={"GET"})
     */
    public function index(Request $request):response
    {    $var=$request->query->get('users');
        if ($var!="")
        {

            $cours=$this->getDoctrine()->getRepository(cours::class)->findByIDField($var);



        }
        else
        {
            $cours = $this->getDoctrine()
                ->getRepository(Cours::class)
                ->findAll();
        }


        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
        ]);
    }
    /**
     * @Route("/recherche", name="recherche", methods={"POST", "GET"})
     */
    public function find (Request $request):response
    {
        $id = $request->request->get('request');
        if ($id!="")
        {

            $query =$this->getDoctrine()->getRepository(cours::class)->createQueryBuilder('u');
            $query->where('u.idCours LIKE :title')
                ->setParameter("title","%$id%")
                ->getQuery();


            $cours = $query->getQuery()->getResult();

        }
        else
        {
            $cours = $this->getDoctrine()
                ->getRepository(Cours::class)
                ->findAll();
        }


        return $this->json(['cours' => $cours]);
    }



    /**
     * @Route("/new", name="cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cour = new Cours();

        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCours}", name="cours_show", methods={"GET"})
     */
    public function show(Cours $cour): Response
    {
        return $this->render('cours/show.html.twig', [
            'cour' => $cour,
        ]);
    }

    /**
     * @Route("/{idCours}/edit", name="cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cours $cour): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCours}", name="cours_delete", methods={"POST"})
     */
    public function delete(Request $request, Cours $cour): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cour->getIdCours(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cours_index');
    }


}
