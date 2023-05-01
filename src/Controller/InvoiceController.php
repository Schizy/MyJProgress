<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'invoice')]
    public function invoice(): Response
    {
        //Die to avoid toolbar
        die($this->renderView('invoice/invoice.html.twig', $this->viewParams()));
    }

    #[Route('/invoice/pdf', name: 'invoicePdf')]
    public function invoicePdf(): Response
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->renderView('invoice/invoice.html.twig', $this->viewParams()));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4')->render();

        $dompdf->stream();
        exit;
    }

    private function viewParams(): array
    {
        return [
            'tjm' => $_ENV['TJM'],
            'numberOfDays' => 14,
            'invoiceNumber' => "031",
            'invoiceDate' => '28/04/2023',
            'invoiceEndDate' => '20/05/2023',
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
        ];
    }
}
