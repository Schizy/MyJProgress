<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrammarRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Grammar extends AbstractEntity
{
    /**
     * @ORM\Column(type="string")
     * @Groups("grammar:list")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Example", mappedBy="grammar", cascade={"persist", "remove"}))
     * @Groups("grammar:list")
     */
    private $examples = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return Grammar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExamples()
    {
        return $this->examples;
    }

    /**
     * @param Example $example
     *
     * @return Grammar
     */
    public function addExample(Example $example)
    {
        $this->examples[] = $example;

        return $this;
    }
}
