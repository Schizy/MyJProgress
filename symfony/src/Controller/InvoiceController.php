<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'invoice')]
    public function index(): Response
    {
        $view =  $this->renderView('invoice/invoice.html.twig', [
            'my' => [
                'name' => $_ENV['MY_NAME'],
                'address' => $_ENV['MY_ADDRESS'],
                'city' => $_ENV['MY_CITY'],
                'siret' => $_ENV['MY_SIRET'],
                'tva' => $_ENV['MY_TVA'],
                'bank' => $_ENV['MY_BANK'],
            ],
            'client' => [
                'name' => $_ENV['CLIENT_NAME'],
                'address' => $_ENV['CLIENT_ADDRESS'],
                'city' => $_ENV['CLIENT_CITY'],
                'siret' => $_ENV['CLIENT_SIRET'],
            ],
        ]);


        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
//        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        exit;
    }
}
