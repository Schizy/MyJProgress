<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrammarRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Grammar extends AbstractEntity
{
    /**
     * @ORM\Column(type="string")
     * @Groups("grammar:list")
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Example", mappedBy="grammar", cascade={"persist", "remove"}))
     * @Groups("grammar:list")
     * @Assert\Valid
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

    /**
     * @param Example[] $examples
     */
    public function setExamples(array $examples)
    {
        foreach ($examples as $example) {
            $example->setGrammar($this);
            $this->addExample($example);
        }
    }
}
