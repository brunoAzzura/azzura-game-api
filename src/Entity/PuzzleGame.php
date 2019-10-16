<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PuzzleGameRepository")
 */
class PuzzleGame
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $timeLimit;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $nbCases;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $imagePuzzlePath;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PuzzlePiece", mappedBy="puzzleGame")
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $puzzlePieces;

    public function __construct()
    {
        $this->puzzlePieces = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTimeLimit(): ?int
    {
        return $this->timeLimit;
    }

    public function setTimeLimit(int $timeLimit): self
    {
        $this->timeLimit = $timeLimit;

        return $this;
    }

    public function getNbCases(): ?int
    {
        return $this->nbCases;
    }

    public function setNbCases(int $nbCases): self
    {
        $this->nbCases = $nbCases;

        return $this;
    }

    public function getImagePuzzlePath(): ?string
    {
        return $this->imagePuzzlePath;
    }

    public function setImagePuzzlePath(string $imagePuzzlePath): self
    {
        $this->imagePuzzlePath = $imagePuzzlePath;

        return $this;
    }

    /**
     * @return Collection|PuzzlePiece[]
     */
    public function getPuzzlePieces(): Collection
    {
        return $this->puzzlePieces;
    }

    public function addPuzzlePiece(PuzzlePiece $puzzlePiece): self
    {
        if (!$this->puzzlePieces->contains($puzzlePiece)) {
            $this->puzzlePieces[] = $puzzlePiece;
            $puzzlePiece->setPuzzleGame($this);
        }

        return $this;
    }

    public function removePuzzlePiece(PuzzlePiece $puzzlePiece): self
    {
        if ($this->puzzlePieces->contains($puzzlePiece)) {
            $this->puzzlePieces->removeElement($puzzlePiece);
            // set the owning side to null (unless already changed)
            if ($puzzlePiece->getPuzzleGame() === $this) {
                $puzzlePiece->setPuzzleGame(null);
            }
        }

        return $this;
    }
}
