<?php

namespace App\Entity;
use JMS\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThemeDrawRepository")
 */
class ThemeDraw
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-world", "get-world-themes", "get-theme"})
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-world", "get-theme", "get-world-themes"})
     */
    private $positionX;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-world", "get-theme", "get-world-themes"})
     */
    private $positionY;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-world", "get-theme", "get-world-themes"})
     */
    private $image_path;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-world", "get-theme", "get-world-themes"})
     */
    private $image_success_path;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-world", "get-theme", "get-world-themes"})
     */
    private $image_error_path;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-world", "get-theme", "get-world-themes"})
     */
    private $width;

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
        return $this->image_path;
    }

    public function setImagePath(string $image_path): self
    {
        $this->image_path = $image_path;

        return $this;
    }

    public function getImageSuccessPath(): ?string
    {
        return $this->image_success_path;
    }

    public function setImageSuccessPath(string $image_success_path): self
    {
        $this->image_success_path = $image_success_path;

        return $this;
    }

    public function getImageErrorPath(): ?string
    {
        return $this->image_error_path;
    }

    public function setImageErrorPath(string $image_error_path): self
    {
        $this->image_error_path = $image_error_path;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }
}
