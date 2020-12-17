<?php

namespace App\Controller;

use App\Entity\Example;
use App\Entity\Grammar;
use App\Form\ExampleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/grammars/")
 */
class GrammarController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("", name="grammar-list")
     */
    public function list()
    {
        return $this->render('grammar/list.html.twig', [
            'title' => 'Liste des règles de grammaire',
            'grammars' => $this->em->getRepository(Grammar::class)->findAll(),
        ]);
    }

    /**
     * @Route("{id}-{rule}", name="grammar-rule")
     */
    public function rule(Request $request, Grammar $grammar): Response
    {
        $example = (new Example())->setGrammar($grammar);
        $example_form = $this->createForm(ExampleFormType::class, $example);

        $example_form->handleRequest($request);
        if ($example_form->isSubmitted() && $example_form->isValid()) {
            $this->em->persist($example);
            $this->em->flush();

            return $this->redirect($request->getRequestUri());
        }

        return $this->render('grammar/rule.html.twig', [
            'title' => $grammar->getName(),
            'grammar' => $grammar,
            'example_form' => $example_form->createView(),
        ]);
    }

    /**
     * @Route("add", name="grammar-add")
     */
    public function add()
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
//        $this->em->persist($grammar);
//        $this->em->flush();

        return $this->render('grammar/add.html.twig', [
            'title' => 'Nouvelle grammaire',
            'grammars' => $this->em->getRepository(Grammar::class)->findAll(),
        ]);
    }
}
