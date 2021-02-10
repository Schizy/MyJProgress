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
    public function addExample(Example $example): self
    {
        $this->examples[] = $example;

        return $this;
    }

    /**
     * @param Example[] $examples
     *
     * @return Grammar
     */
    public function setExamples(array $examples): self
    {
        foreach ($examples as $newOrModifiedExample) {
            if (!$newOrModifiedExample->getId()) {
                $this->addExample($newOrModifiedExample->setGrammar($this));
                continue;
            }

            foreach ($this->examples as $example) {
                if ($example->getId() == $newOrModifiedExample->getId()) {
                    $example
                        ->setPhrase($newOrModifiedExample->getPhrase())
                        ->setTranslation($newOrModifiedExample->getTranslation());
                }
            }
        }

        return $this;
    }
}
