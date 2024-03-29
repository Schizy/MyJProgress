<?php

namespace App\Entity;

use App\Repository\KanjiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KanjiRepository::class)
 */
class Kanji
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $kanji;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isJoyo;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $commonStat;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $kunyomi = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $onyomi = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $kunExample;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $onExample;

    public function generateKunExample(): bool
    {
        foreach ($this->kunyomi as $kun) {
            if (str_contains($kun, '.')) {
                $this->kunExample = str_replace('&#12289', '', substr_replace($kun,$this->kanji, 0,  strpos($kun, '.')+1));
                return true;
            }
        }

        return false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKanji(): ?string
    {
        return $this->kanji;
    }

    public function setKanji(string $kanji): self
    {
        $this->kanji = $kanji;

        return $this;
    }

    public function getIsJoyo(): ?bool
    {
        return $this->isJoyo;
    }

    public function setIsJoyo(bool $isJoyo): self
    {
        $this->isJoyo = $isJoyo;

        return $this;
    }

    public function getCommonStat(): ?int
    {
        return $this->commonStat;
    }

    public function setCommonStat(?int $commonStat): self
    {
        $this->commonStat = $commonStat;

        return $this;
    }

    public function getKunyomi(): ?array
    {
        return $this->kunyomi;
    }

    public function setKunyomi(?array $kunyomi): self
    {
        $this->kunyomi = $kunyomi;

        return $this;
    }

    public function getOnyomi(): ?array
    {
        return $this->onyomi;
    }

    public function setOnyomi(?array $onyomi): self
    {
        $this->onyomi = $onyomi;

        return $this;
    }

    public function getKunExample(): ?string
    {
        return $this->kunExample;
    }

    public function setKunExample(?string $kunExample): self
    {
        $this->kunExample = $kunExample;

        return $this;
    }

    public function getOnExample(): ?string
    {
        return $this->onExample;
    }

    public function setOnExample(?string $onExample): self
    {
        $this->onExample = $onExample;

        return $this;
    }
}
