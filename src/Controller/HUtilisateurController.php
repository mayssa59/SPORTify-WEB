<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reclamation;
use App\Entity\Utilisateur;
use App\Entity\Paiement;
use App\Form\ReclamationType;





class HUtilisateurController extends AbstractController
{
    /**
     * @Route("/front/{id}", name="frontH")
     */
    public function index(int $id,Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();

        $utilisateur=$em->getRepository(Utilisateur::class)->find($id);

        $reclam=$em->getRepository(Reclamation::class)->findBy(array('Utilisateur' => $utilisateur));

        $paiement=$em->getRepository(Paiement::class)->findBy(array('Utilisateur' => $utilisateur));

        $reclamation = new Reclamation();
        $form1=$this->createForm(ReclamationType::class,$reclamation)->remove('Utilisateur');



        if($request->isMethod('POST'))
        {
            $form1->handleRequest($request);

            if($form1->isValid())
            {
                $reclamation->setUtilisateur($utilisateur);
                $em->persist($reclamation);
                $em->flush();

                return $this->redirectToRoute('front',['id'=>$id]);


            }
        }



        return $this->render('utilisateur/index.html.twig', [
            'reclam' => $reclam,'paiement'=>$paiement,'form1' => $form1->createView()
        ]);
    }




}
