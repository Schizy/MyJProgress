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
        $grammar = new Grammar();
        $grammar
            ->setName('ば〜ほど')
            ->addExample(
                (new Example())
                    ->setPhrase('よめば　よむほど　簡単になる。')
                    ->setTranslation('Plus tu lis plus ça devient facile.')
                    ->setGrammar($grammar)
            )->addExample(
                (new Example())
                    ->setPhrase('よめば　よむほど　簡単になる。2')
                    ->setTranslation('Plus tu lis plus ça devient facile. 2')
                    ->setGrammar($grammar)
            )->addExample(
                (new Example())
                    ->setPhrase('よめば　よむほど　簡単になる。3')
                    ->setTranslation('Plus tu lis plus ça devient facile. 3')
                    ->setGrammar($grammar)
            );
        $em->persist($grammar);
        $em->flush();

        $rules = $em->getRepository(Grammar::class)->findBy([], ['id' => 'desc'], 5);

        return $this->render('home/home.html.twig', [
            'title' => 'ようこそ！',
            'rules' => $rules,
        ]);
    }
}
