<?php

namespace App\Controller;


use App\Entity\CategorieProduit;
use App\Form\CategorieProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query\ResultSetMapp;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @Route("/categorie/produit")
 */
class CategorieProduitController extends AbstractController
{
    /**
     * @Route("/", name="categorie_produit_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {
            $query =$this->getDoctrine()->getRepository(CategorieProduit::class)->createQueryBuilder('u');
            $query->where('u.typecategorie LIKE :title')
                ->setParameter("title","%$var%")
                ->getQuery();


            $categorieProduit = $query->getQuery()->getResult();
        }
        else {
            $categorieProduit = $this->getDoctrine()
                ->getRepository(CategorieProduit::class)
                ->findAll();
        }
        return $this->render('categorie_produit/index.html.twig', [
            'categorie_produit' => $categorieProduit,
        ]);
    }

    /**
     * @Route("/new", name="categorie_produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorieProduit = new CategorieProduit();
        $form = $this->createForm(CategorieProduitType::class, $categorieProduit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();


            if ($image)
            {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $fileName = $safeFilename.'.'.$image->guessExtension();
                try{
                    $image->move(
                        $this->getParameter('imageuser_directory'),$fileName);
                } catch (FileException $e)
                {
                }
                $categorieProduit->setImage($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorieProduit);
            $entityManager->flush();



            return $this->redirectToRoute('categorie_produit_index');
        }

        return $this->render('categorie_produit/new.html.twig', [
            'categorie_produit' => $categorieProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcategorie}", name="categorie_produit_show", methods={"GET"})
     */
    public function show(CategorieProduit $categorieProduit): Response
    {
        return $this->render('categorie_produit/show.html.twig', [
            'categorie_produit' => $categorieProduit,
        ]);
    }

    /**
     * @Route("/{idcategorie}/edit", name="categorie_produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategorieProduit $categorieProduit): Response
    {
        $form = $this->createForm(CategorieProduitType::class, $categorieProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();


            if ($image)
            {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $originalFilename;
                $fileName = $safeFilename.'.'.$image->guessExtension();
                try{
                    $image->move(
                        $this->getParameter('imageuser_directory'),$fileName);
                } catch (FileException $e)
                {
                }
                $categorieProduit->setImage($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorieProduit);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_produit_index');
        }

        return $this->render('categorie_produit/edit.html.twig', [
            'categorie_produit' => $categorieProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idcategorie}", name="categorie_produit_delete", methods={"POST"})
     */
    public function delete(Request $request, CategorieProduit $categorieProduit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieProduit->getTypecategorie(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorieProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_produit_index');
    }
}
