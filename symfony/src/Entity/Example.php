<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExampleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Example extends AbstractEntity
{
    const STATES = [
        self::REJECTED,
        self::PENDING,
        self::SUBMITTED,
    ];

    const REJECTED = 0;

    const PENDING = 1;

    const SUBMITTED = 2;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Grammar", inversedBy="examples")
     */
    private $grammar;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $phrase;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $translation;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $state = self::PENDING;

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

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     *
     * @return Example
     */
    public function setState(int $state): Example
    {
        if (in_array($state, self::STATES)) {
            $this->state = $state;
        }

        return $this;
    }
}
