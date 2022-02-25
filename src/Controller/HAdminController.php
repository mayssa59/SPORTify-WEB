<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Date;
use App\Entity\Reclamation;

use App\Entity\Utilisateur;

use App\Form\ReclamationType;
use App\Form\PaiementType;
use App\Entity\Paiement;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Dompdf\Dompdf;
use Dompdf\Options;


class HAdminController extends AbstractController
{
    /**
     * @Route("/back", name="back")
     */
    public function index(): Response
    {
        return $this->render('back/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/back/viewreclamation", name="view_reclamation")
     */
    public function viewreclamation(): Response
    {
        $em=$this->getDoctrine()->getManager();

        $reclam=$em->getRepository(Reclamation::class)->findAll();

        return $this->render('back/viewreclamation.html.twig', [
            'reclam' => $reclam,
        ]);
    }

    /**
     * @Route("/back/generatePDF", name="generatePDF")
     */
    public function generatePDF(): Response
    {
        $em=$this->getDoctrine()->getManager();

        $reclam=$em->getRepository(Reclamation::class)->findAll();


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('back/viewreclamation.html.twig', [
            'reclam' => $reclam,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("état des réclamations", ["Attachment" => true]);


        return $this->render('back/viewreclamation.html.twig', [
            'reclam' => $reclam,
        ]);


    }


    /**
     * @Route("/back/generatePDF2", name="generatePDF2")
     */
    public function generatePDF2(): Response
    {
        $em=$this->getDoctrine()->getManager();

        $paiement=$em->getRepository(Paiement::class)->findAll();


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('back/viewpaiement.html.twig', [
            'paiement' => $paiement,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("état des paiement globale", ["Attachment" => true]);


        return $this->render('back/viewpaiement.html.twig', [
            'paiement' => $paiement,
        ]);


    }

    /**
     * @Route("/back/deletreclam/{id}", name="delete_reclamation")
     */
    public function deletereclamation(int $id): Response
    {
        $em=$this->getDoctrine()->getManager();

        $reclam=$em->getRepository(Reclamation::class)->find($id);

        $em->remove($reclam);
        $em->flush();


        return $this->redirectToRoute('view_reclamation');
    }

    /**
     * @Route("/back/editreclam/{id}", name="edit_reclamation")
     */
    public function editreclamation(Request $request,int $id): Response
    {
        $em=$this->getDoctrine()->getManager();

        $reclam=$em->getRepository(Reclamation::class)->find($id);
        $form=$this->createForm(ReclamationType::class,$reclam)->remove('ajouter');
        $form->add('Modifier',SubmitType::class,array('attr'=>array('class'=>'btn btn-success')));

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if($form->isValid())
            {
                $em=$this->getDoctrine()->getManager();

                $em->flush();

                return $this->redirectToRoute('view_reclamation');


            }
        }


        return $this->render('back/updatereclamation.html.twig', [
            'form' => $form->createView(),'reclam'=>$reclam
        ]);
    }



    /**
     * @Route("/back/addreclamation", name="add_reclamation")
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

                return $this->redirectToRoute('view_reclamation');


            }
        }

        return $this->render('back/addreclamation.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/back/addpaiement", name="add_paiement")
     */
    public function addpaiement(Request $request): Response
    {

        $paiement = new Paiement();
        $form=$this->createForm(PaiementType::class,$paiement);

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if($form->isValid())
            {
                $em=$this->getDoctrine()->getManager();

                $duree = $form->get('duree')->getData();

                //$duree=$paiement->getDuree();

                if($duree==1)
                    $paiement->setPrix(60);
                else if($duree==3)
                    $paiement->setPrix(150);
                else if($duree==6)
                    $paiement->setPrix(250);
                else if($duree==12)
                    $paiement->setPrix(400);


                $dt= date('Y-m-d');
                $paiement->setDatepaiement(new \DateTime($dt));

                $em->persist($paiement);
                $em->flush();



                return $this->redirectToRoute('view_paiement');


            }
        }

        return $this->render('back/addpaiement.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/back/viewpaiement", name="view_paiement")
     */
    public function viewpaiement(): Response
    {
        $em=$this->getDoctrine()->getManager();

        $paiement=$em->getRepository(Paiement::class)->findAll();

        return $this->render('back/viewpaiement.html.twig', [
            'paiement' => $paiement,
        ]);

    }


    /**
     * @Route("/back/editpaiement/{id}", name="edit_paiement")
     */
    public function editepaiement(Request $request,int $id): Response
    {
        $em=$this->getDoctrine()->getManager();

        $paiement=$em->getRepository(Paiement::class)->find($id);
        $form=$this->createForm(PaiementType::class,$paiement)->remove('ajouter');
        $form->add('Modifier',SubmitType::class,array('attr'=>array('class'=>'btn btn-success')));

        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if($form->isValid())
            {
                $duree = $form->get('duree')->getData();

                //$duree=$paiement->getDuree();

                if($duree==1)
                    $paiement->setPrix(60);
                else if($duree==3)
                    $paiement->setPrix(150);
                else if($duree==6)
                    $paiement->setPrix(250);
                else if($duree==12)
                    $paiement->setPrix(400);


                $dt= date('Y-m-d');
                $paiement->setDatepaiement(new \DateTime($dt));

                $em->flush();

                return $this->redirectToRoute('view_paiement');


            }
        }

        return $this->render('back/updatepaiment.html.twig', [
            'form' => $form->createView(),'paiement'=>$paiement
        ]);

    }


    /**
     * @Route("/back/deletepaiement/{id}", name="delete_paiement")
     */
    public function deletepaiement(int $id): Response
    {
        $em=$this->getDoctrine()->getManager();

        $paiement=$em->getRepository(Paiement::class)->find($id);

        $em->remove($paiement);
        $em->flush();


        return $this->redirectToRoute('view_paiement');
    }






}
