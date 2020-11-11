<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Example;
use App\Entity\Grammar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function number(EntityManagerInterface $em): Response
    {
        $grammar = new Grammar();
        $grammar
            ->setName('ば〜ほど')
            ->addExample(
                (new Example())
                    ->setPhrase('よめば　よむほど　簡単になる。')
                    ->setTranslation('Plus tu lis plus ça devient facile.')
                    ->setGrammar($grammar)
            );
    $em->persist($grammar);
    $em->flush();

        return $this->render('base.html.twig', [
            'title' => 'ようこそ！',
        ]);
    }
}
