<?php

namespace App\Controller;

use App\Entity\Grammar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/")]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('homepage', [
            '_locale' => $this->getParameter('kernel.default_locale'),
        ]);
    }

    #[Route("/{_locale<%app.supported_locales%>}/", name:"homepage")]
    public function home(EntityManagerInterface $em): Response
    {
        return $this->render('home/home.html.twig', [
            'rules' => $em->getRepository(Grammar::class)->findBy([], ['id' => 'desc'], 5),
        ]);
    }
}
