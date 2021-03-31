<?php

namespace App\DataFixtures;

use App\Entity\Example;
use App\Entity\Grammar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GrammarFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $grammar = (new Grammar())->setName('ば〜ほど');
        $grammar->addExample(
            (new Example())
                ->setGrammar($grammar)
                ->setPhrase('この本を読めば読むほど面白くなる。')
                ->setTranslation('Plus tu lis plus ça devient facile')
        );

        $manager->persist($grammar);
        $manager->flush();
    }
}
