<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Example
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Grammar", inversedBy="examples")
     */
    private $grammar;

    /**
     * @ORM\Column(type="string")
     */
    private $phrase;

    /**
     * @ORM\Column(type="string")
     */
    private $translation;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGrammar()
    {
        return $this->grammar;
    }

    /**
     * @param mixed $grammar
     *
     * @return Example
     */
    public function setGrammar($grammar)
    {
        $this->grammar = $grammar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @param mixed $phrase
     *
     * @return Example
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param mixed $translation
     *
     * @return Example
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }
}
