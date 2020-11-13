<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Example;
use App\Entity\Grammar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrammarController extends AbstractController
{
    /**
     * @Route("/grammar/{id}-{rule}", name="grammar-rule")
     */
    public function rule(Grammar $grammar): Response
    {
        return $this->render('grammar/rule.html.twig', [
            'title' => $grammar->getName(),
            'grammar' => $grammar,
        ]);
    }
}
