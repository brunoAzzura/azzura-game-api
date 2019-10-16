<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorldDrawRepository")
 */
class WorldDraw
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-worlds", "get-world", "get-user-worldScore"})
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-worlds", "get-world", "get-world"})
     */
    private $positionX;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-worlds", "get-world"})
     */
    private $positionY;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-worlds", "get-world", "get-user-worldScore"})
     */
    private $imagePath;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-worlds", "get-world", "get-theme"})
     */
    private $background;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-worlds", "get-world"})
     */
    private $logoPath;

    public function getId()
    {
        return $this->id;
    }

    public function getPositionX(): ?int
    {
        return $this->positionX;
    }

    public function setPositionX(int $positionX): self
    {
        $this->positionX = $positionX;

        return $this;
    }

    public function getPositionY(): ?int
    {
        return $this->positionY;
    }

    public function setPositionY(int $positionY): self
    {
        $this->positionY = $positionY;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(string $logoPath): self
    {
        $this->logoPath = $logoPath;

        return $this;
    }



}
