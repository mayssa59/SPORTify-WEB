<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits_index", methods={"GET"})
     */
    public function index(Request $request):response
    {
        $var = $request->query->get('users');



        if ($var != "") {

            $query = $this->getDoctrine()->getRepository(produits::class)->createQueryBuilder('u');
            $query->where('u.libelle LIKE :title')
                ->setParameter("title", "%$var%")
                ->getQuery();


            $produits = $query->getQuery()->getResult();

        } else {
            $produits = $this->getDoctrine()
                ->getRepository(Produits::class)
                ->findAll();
        }


        $cv=0;
        $cn=0;
        $ce=0;
        $cs=0;
        foreach ($produits as $produit) {
            if ($produit->getType()=="vetements"){
                $cv+=$produit->getQuantites();
            }else if ($produit->getType()=="nutritions"){
                $cn+=$produit->getQuantites();
            }else if ($produit->getType()=="equipements"){
                $ce+=$produit->getQuantites();
            }else{
                $cs+=$produit->getQuantites();
            }
        }
        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
            'cv' => $cv,
            'cn' => $cn,
            'ce' => $ce,
            'cs' => $cs
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

            $query =$this->getDoctrine()->getRepository(produits::class)->createQueryBuilder('u');
            $query->where('u.libelle LIKE :title')
                ->setParameter("title","%libelle%")
                ->getQuery();


            $produits = $query->getQuery()->getResult();

        }
        else
        {
            $produits = $this->getDoctrine()
                ->getRepository(produits::class)
                ->findAll();
        }


        return $this->json(['produits' => $produits]);
    }



    /**
     * @Route("/new", name="produits_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produits_show", methods={"GET"})
     */
    public function show(Produits $produit): Response
    {

        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produits_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produits $produit): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produits_delete", methods={"POST"})
     */
    public function delete(Request $request, Produits $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produits_index');
    }

}
