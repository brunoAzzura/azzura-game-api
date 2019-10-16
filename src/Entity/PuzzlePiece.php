<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PuzzlePieceRepository")
 */
class PuzzlePiece implements ImageEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $imagePath;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-theme-puzzle", "get-theme"})
     */
    private $pieceOrder;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PuzzleGame", inversedBy="puzzlePieces")
     */
    private $puzzleGame;

    public function getId()
    {
        return $this->id;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): ImageEntityInterface
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getPieceOrder(): ?int
    {
        return $this->pieceOrder;
    }

    public function setPieceOrder(int $pieceOrder): self
    {
        $this->pieceOrder = $pieceOrder;

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
}
