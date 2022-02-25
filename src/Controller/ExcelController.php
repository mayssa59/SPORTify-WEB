<?php

namespace App\Controller;

use App\Entity\Evennement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\StreamedResponse;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExcelController extends AbstractController
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
     * @Route("excel", name="excel")
     */
    public function index(): Response
    {
        return $this->render('excel/index.html.twig', [
            'controller_name' => 'ExcelController',
        ]);
    }

    private function getData(): array
    {
        /**
         * @var $evennement Evennement[]
         */
        $list = [];
        $evennements = $this->entityManager->getRepository(Evennement::class)->findAll();

        foreach ($evennements as $evennement) {
            $list[] = [
                $evennement->getIdEvennement(),
                $evennement->getNomEvennement(),
                $evennement->getNbplaces(),
                $evennement->getDescription(),
                $evennement->getDate(),
                $evennement->getNomSalle()
            ];
        }
        return $list;
    }


    /**
     * @Route("/export",  name="export")
     */
    public function export()
    {


        $streamedResponse = new StreamedResponse();
        $streamedResponse->setCallback(function () {

            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setTitle('Liste des Evennements');

            $sheet->setCellValue('A1', 'IdEvennement');
            $sheet->setCellValue('B1', 'NomEvennement');
            $sheet->setCellValue('C1', 'Nbplaces');
            $sheet->setCellValue('D1', 'Description');
            $sheet->setCellValue('E1', 'Date');
            $sheet->setCellValue('F1', 'Nom_Salle');

            // Increase row cursor after header write
            $sheet->fromArray($this->getData(), null, 'A2', true);

            $writer = new Xlsx($spreadsheet);

            $writer->save('sportifyEvents.xlsx');

        });

        $streamedResponse->setStatusCode(Response::HTTP_OK);
        $streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $streamedResponse->headers->set('Content-Disposition', 'attachment; filename="sportifyEvents.xlsx"');

        return $streamedResponse->send();

        //return $this->redirectToRoute('evennement_index');

    }

}