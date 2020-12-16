<?php

namespace App\Controller;

use App\Entity\Example;
use App\Entity\Grammar;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/grammars/")
 */
class GrammarController extends AbstractController
{
    /**
     * @Route("", name="grammar-list")
     */
    public function list(EntityManagerInterface $em)
    {
        return $this->render('grammar/list.html.twig', [
            'title' => 'Liste des règles de grammaire',
            'grammars' => $em->getRepository(Grammar::class)->findAll(),
        ]);
    }

    /**
     * @Route("{id}-{rule}", name="grammar-rule")
     */
    public function rule(Grammar $grammar): Response
    {
        return $this->render('grammar/rule.html.twig', [
            'title' => $grammar->getName(),
            'grammar' => $grammar,
        ]);
    }

    /**
     * @Route("add", name="grammar-add")
     */
    public function add(EntityManagerInterface $em)
    {
//        $grammar = new Grammar();
//        $grammar
//            ->setName('ば〜ほど')
//            ->addExample(
//                (new Example())
//                    ->setPhrase('よめば　よむほど　簡単になる。')
//                    ->setTranslation('Plus tu lis plus ça devient facile.')
//                    ->setGrammar($grammar)
//            )->addExample(
//                (new Example())
//                    ->setPhrase('よめば　よむほど　簡単になる。2')
//                    ->setTranslation('Plus tu lis plus ça devient facile. 2')
//                    ->setGrammar($grammar)
//            )->addExample(
//                (new Example())
//                    ->setPhrase('よめば　よむほど　簡単になる。3')
//                    ->setTranslation('Plus tu lis plus ça devient facile. 3')
//                    ->setGrammar($grammar)
//            );
//        $em->persist($grammar);
//        $em->flush();

        return $this->render('grammar/add.html.twig', [
            'title' => 'Nouvelle grammaire',
            'grammars' => $em->getRepository(Grammar::class)->findAll(),
        ]);
    }
}
