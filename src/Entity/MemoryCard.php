<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemoryCardRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MemoryCard implements ImageEntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-theme-memorycards", "get-theme"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-theme-memorycards", "get-theme"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="memoryCards")
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-theme-memorycards", "get-theme"})
     */
    private $imagePath;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
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
}
