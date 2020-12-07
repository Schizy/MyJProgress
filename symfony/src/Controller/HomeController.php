<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Example;
use App\Entity\Grammar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em): Response
    {
        return $this->render('home/home.html.twig', [
            'title' => 'ようこそ！',
            'rules' => $em->getRepository(Grammar::class)->findBy([], ['id' => 'desc'], 5),
        ]);
    }
}
