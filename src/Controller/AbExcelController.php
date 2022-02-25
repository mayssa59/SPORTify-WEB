<?php

namespace App\Controller;

use App\Entity\Abonnement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class AbExcelController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/ab/excel", name="ab_excel")
     */
    public function index(): Response
    {
        return $this->render('ab_excel/index.html.twig', [
            'controller_name' => 'AbExcelController',
        ]);
    }

    private function getData(): array
    {
        /**
         * @var $abonnements Abonnement[]
         */
        $list = [];
        $abonnements = $this->entityManager->getRepository(Abonnement::class)->findAll();

        foreach ($abonnements as $abonnement) {
            $list[] = [
                $abonnement->getIdAbonnement(),
                $abonnement->getTypeAbonnement(),
                $abonnement->getPrixAbonnement(),
                $abonnement->getSurnomUser(),
                $abonnement->getDatecreation()
            ];
        }
        return $list;
    }

    /**
     * @Route("/exporterAb",  name="exporterAb")
     */
    public function exporterAb()
    {
        $streamedResponse = new StreamedResponse();
        $streamedResponse->setCallback(function () {

            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setTitle('Liste des Abonnements');

            $sheet->setCellValue('A1','IdAbonnement');
            $sheet->setCellValue('B1','TypeAbonnement');
            $sheet->setCellValue('C1','PrixAbonnement');
            $sheet->setCellValue('D1','surnomUser');
            $sheet->setCellValue('E1','DateCreation');

            // Increase row cursor after header write
            $sheet->fromArray($this->getData(),null, 'A2', true);

            $writer = new Xlsx($spreadsheet);

            $writer->save('sportifySubscriptions.xlsx');
        });

        $streamedResponse->setStatusCode(Response::HTTP_OK);
        $streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $streamedResponse->headers->set('Content-Disposition', 'attachment; filename="sportifySubscriptions.xlsx"');

        return $streamedResponse->send();

        //return $this->redirectToRoute('abonnement_index');
    }
}