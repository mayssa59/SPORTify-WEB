<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Categories;
use App\Entity\Cours;
use App\Entity\Blog;
use App\Entity\Evennement;
use App\Entity\Reclamation;
use App\Entity\Salledesport;
use App\Entity\Produits;
use App\Entity\CategorieProduit;


use App\Form\BlogType;
use App\Form\CategorieProduitType;
use App\Form\CategoriesType;
use App\Form\CoursType;
use App\Form\EvennementType;
use App\Form\ProduitsType;
use App\Form\ReclamationType;
use App\Form\SalledesportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');

    }
    /**
     * @Route("/front", name="front")
     */
    public function front(): Response
    {



        return $this->render('Front/index.html.twig');
    }
    /**
     * @Route("/course", name="course")
     */
    public function course(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {
            $cours = $this->getDoctrine()->getRepository(cours::class)->findBy(array('typeCours' => $var));
            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
        }
        else
        {
            $cours = $this->getDoctrine()
                ->getRepository(Cours::class)
                ->findAll();
            $categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
        }


        return $this->render('Front/cours.html.twig', [
            'cours' => $cours,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/blogs", name="blogs")
     */

    public function blogs(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {
            $blogs = $this->getDoctrine()->getRepository(blog::class)->findBy(array('titre' => $var));
        }
        else
        {
            $blogs = $this->getDoctrine()
                ->getRepository(blog::class)
                ->findAll();
        }


        return $this->render('Front/blog.html.twig', [
            'blogs' => $blogs,
        ]);
    }


    /**
     * @Route("/Salle", name="Salle")
     */
    public function Salle(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {
            $Salles = $this->getDoctrine()->getRepository(Salledesport::class)->findBy(array('nomSalle' => $var));
        }
        else
        {
            $Salles = $this->getDoctrine()
                ->getRepository(Salledesport::class)
                ->findAll();
        }


        return $this->render('Front/Salle.html.twig', [
            'Salles' => $Salles,
        ]);
    }

    /**
     * @Route("/product", name="product")
     */
    public function product(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {
            $produits = $this->getDoctrine()->getRepository(Produits::class)->findBy(array('libelle' => $var));
        }
        else
        {
            $produits = $this->getDoctrine()
                ->getRepository(Produits::class)
                ->findAll();
            $CategorieProduit = $this->getDoctrine()
                ->getRepository(CategorieProduit::class)
                ->findAll();
        }


        return $this->render('Front/produits.html.twig', [
            'produits' => $produits,
            'CategorieProduit' => $CategorieProduit,

        ]);
    }


    /**
     * @Route("/event", name="event")
     */
    public function event(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {
            $evennement= $this->getDoctrine()->getRepository(evennement::class)->findBy(array('nomSalle' => $var));
        }
        else
        {
            $evennement = $this->getDoctrine()
                ->getRepository(evennement::class)
                ->findAll();
        }


        return $this->render('Front/evennement.html.twig', [
            'evennement' => $evennement,
        ]);
    }

    /**
     * @Route("/subscription", name="subscription")
     */
    public function subscription(Request $request): Response
    {
        $var=$request->query->get('users');
        if ($var!="")
        {
            $abonnements= $this->getDoctrine()->getRepository(Abonnement::class)->findBy(array('typeAbonnement' => $var));
        }
        else
        {
            $abonnements = $this->getDoctrine()
                ->getRepository(Abonnement::class)
                ->findAll();
        }


        return $this->render('Front/abonnement.html.twig', [
            'abonnements' => $abonnements,
        ]);
    }

    /**
     * @Route("/homeClient", name="homeClient")
     */
    public function indexClient(): Response
    {
        return $this->render('templateClient.html.twig');

    }

    /**
     * @Route("/coursClient", name="coursClient_index", methods={"GET"})
     */
    public function indexCoursClient(Request $request):response
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


        return $this->render('Client/indexCours.html.twig', [
            'cours' => $cours,
        ]);
    }

    /**
     * @Route("/blogClient", name="blogClient_index", methods={"GET"})
     */
    public function indexBlogClient(Request $request):response
    {    $var=$request->query->get('users');
        if ($var!="")
        {

            $query =$this->getDoctrine()->getRepository(Blog::class)->createQueryBuilder('u');
            $query->where('u.titre LIKE :titre')
                ->setParameter("titre","%$var%")
                ->getQuery();


            $blog = $query->getQuery()->getResult();

        }
        else
        {
            $blog = $this->getDoctrine()
                ->getRepository(Blog::class)
                ->findAll();
        }


        return $this->render('Client/indexBlog.html.twig', [
            'blog' => $blog,
        ]);
    }

    /**
     * @Route("/salledesportClient", name="salledesportClient_index", methods={"GET"})
     */
    public function indexSalleClient(Request $request): Response
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


        return $this->render('Client/indexSalle.html.twig', [
            'salledesport' => $Salle,
        ]);
    }

    /**
     * @Route("/produitClient", name="produitClient_index", methods={"GET"})
     */
    public function indexProduitClient(Request $request):response
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
        return $this->render('Client/indexProduit.html.twig', [
            'produits' => $produits,
            'cv' => $cv,
            'cn' => $cn,
            'ce' => $ce,
            'cs' => $cs
        ]);
    }

    /**
     * @Route("/evenementClient", name="evennementClient_index", methods={"GET"})
     */
    public function indexEvenementClient(Request $request):response
    {
        $var = $request->query->get('users');
        if ($var != "") {

            $evennements = $this->getDoctrine()->getRepository(Evennement::class)->findByTypeField($var);

        } else {
            $evennements = $this->getDoctrine()
                ->getRepository(Evennement::class)
                ->findAll();
        }
        return $this->render('Client/indexEvenement.html.twig', [
            'evennements' => $evennements,
        ]);
    }


    /**
     * @Route("/reclamationCLient", name="addreclamationClient_index")
     */
    public function addreclamationClient(Request $request): Response
    {


        $reclamation = new Reclamation();
        $form=$this->createForm(ReclamationType::class,$reclamation);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if($form->isValid())
            {
                $em=$this->getDoctrine()->getManager();
                $em->persist($reclamation);
                $em->flush();

                return $this->redirectToRoute('homeClient');


            }
        }

        return $this->render('Client/addreclamationClient.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/homeProp", name="homeProp")
     */
    public function indexProp(): Response
    {
        return $this->render('templateProp.html.twig');

    }


    /**
     * @Route("/newBlogProp", name="blogProp_new", methods={"GET","POST"})
     */
    public function newBlogProp(Request $request): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
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
                $blog->setImage($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blog);
            $entityManager->flush();

            return $this->redirectToRoute('homeProp');
        }

        return $this->render('Prop/addBlog.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newSalleProp", name="SalleProp_new", methods={"GET","POST"})
     */
    public function newSalleProp(Request $request): Response
    {
        $Salle = new Salledesport();

        $form = $this->createForm(SalledesportType::class, $Salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Salle);
            $entityManager->flush();

            return $this->redirectToRoute('homeProp');
        }

        return $this->render('Prop/addSalle.html.twig', [
            'Salle' => $Salle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newCoursProp", name="coursProp_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('homeProp');
        }

        return $this->render('Prop/addCours.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newCategorieProp", name="categoriesProp_new", methods={"GET","POST"})
     */
    public function newCategorieProp(Request $request): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
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
                $category->setImage($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('homeProp');
        }

        return $this->render('Prop/addCategorie.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newProduitsProp", name="produitsProp_new", methods={"GET","POST"})
     */
    public function newProduitsProp(Request $request): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('homeProp');
        }

        return $this->render('Prop/addProduits.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/newCategorieProduitProp", name="categorie_produitProp_new", methods={"GET","POST"})
     */
    public function newCategorieProduitProp(Request $request): Response
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



            return $this->redirectToRoute('homeProp');
        }

        return $this->render('Prop/addCategorieProduit.html.twig', [
            'categorie_produit' => $categorieProduit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newEvenementProp", name="evennementProp_new", methods={"GET","POST"})
     */
    public function newEvenementProp(Request $request): Response
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
            return $this->redirectToRoute('homeProp');
        }

        return $this->render('Prop/addEvenement.html.twig', [
            'evennement' => $evennement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newReclamationProp", name="add_reclamationProp")
     */
    public function addreclamation(Request $request): Response
    {


        $reclamation = new Reclamation();
        $form=$this->createForm(ReclamationType::class,$reclamation);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if($form->isValid())
            {
                $em=$this->getDoctrine()->getManager();
                $em->persist($reclamation);
                $em->flush();

                return $this->redirectToRoute('homeProp');


            }
        }

        return $this->render('Prop/addReclamation.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
