<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 */
class Theme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-world", "get-user-goodtoknows", "get-theme", "get-world-themes", "get-goodtoknows", "get-themes"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-world", "get-user-goodtoknows", "get-theme", "get-goodtoknows", "get-themes"})
     */
    private $wording;

    /**
     * @ORM\Column(type="text")
     * @Groups({"get-world", "get-theme"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\World", inversedBy="themes", cascade={"persist","remove"})
     * @Groups({"get-user-goodtoknows", "get-theme", "get-goodtoknows", "get-themes"})
     */
    private $world;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-world", "get-theme"})
     */
    private $ranking;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="theme", cascade={"persist", "remove"})
     * @Groups({"get-theme"})
     */
    private $questions;
  
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ThemeDraw", cascade={"persist","remove"})
     * @Groups({"get-world", "get-theme", "get-world-themes"})
     */
    private $themeDraw;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameType", cascade={"persist","remove"})
     * @Groups({"get-world", "get-theme"})
     */
    private $gameType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MemoryCard", mappedBy="theme", cascade={"persist","remove"})
     * @Groups({"get-theme"})
     */
    private $memoryCards;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PuzzleGame", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"get-theme"})
     */
    private $puzzleGame;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GoodToKnow", mappedBy="theme", cascade={"persist","remove"})
     */
    private $goodToKnows;

    public function __construct()
    {
        $this->memoryCards = new ArrayCollection();
        $this->goodToKnows = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWorld(): ?world
    {
        return $this->world;
    }

    public function setWorld(?world $world): self
    {
        $this->world = $world;

        return $this;
    }

    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    public function setRanking(int $ranking): self
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): ?Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setTheme($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getTheme() === $this) {
                $question->setTheme(null);
            }
        }

        return $this;
    }

    public function getThemeDraw(): ?ThemeDraw
    {
        return $this->themeDraw;
    }

    public function setThemeDraw(?ThemeDraw $themeDraw): self
    {
        $this->themeDraw = $themeDraw;

        return $this;
    }

    public function getGameType(): ?GameType
    {
        return $this->gameType;
    }

    public function setGameType(?GameType $gameType): self
    {
        $this->gameType = $gameType;

        return $this;
    }

    /**
     * @return Collection|MemoryCard[]
     */
    public function getMemoryCards(): ?Collection
    {
        return $this->memoryCards;
    }

    public function addMemoryCard(MemoryCard $memoryCard): self
    {
        if (!$this->memoryCards->contains($memoryCard)) {
            $this->memoryCards[] = $memoryCard;
            $memoryCard->setTheme($this);
        }

        return $this;
    }

    public function removeMemoryCard(MemoryCard $memoryCard): self
    {
        if ($this->memoryCards->contains($memoryCard)) {
            $this->memoryCards->removeElement($memoryCard);
            // set the owning side to null (unless already changed)
            if ($memoryCard->getTheme() === $this) {
                $memoryCard->setTheme(null);
            }
        }

        return $this;
    }

    public function getPuzzleGame(): ?PuzzleGame
    {
        return $this->puzzleGame;
    }

    public function setPuzzleGame(?PuzzleGame $puzzleGame): self
    {
        $this->puzzleGame = $puzzleGame;

        return $this;
    }

    /**
     * @return Collection|GoodToKnow[]
     */
    public function getGoodToKnows(): Collection
    {
        return $this->goodToKnows;
    }

    public function addGoodToKnow(GoodToKnow $goodToKnow): self
    {
        if (!$this->goodToKnows->contains($goodToKnow)) {
            $this->goodToKnows[] = $goodToKnow;
            $goodToKnow->setTheme($this);
        }

        return $this;
    }

    public function removeGoodToKnow(GoodToKnow $goodToKnow): self
    {
        if ($this->goodToKnows->contains($goodToKnow)) {
            $this->goodToKnows->removeElement($goodToKnow);
            // set the owning side to null (unless already changed)
            if ($goodToKnow->getTheme() === $this) {
                $goodToKnow->setTheme(null);
            }
        }

        return $this;
    }
}
