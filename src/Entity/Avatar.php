<?php

namespace App\Entity;
use JMS\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 */
class Avatar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("get-users")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get-users")
     */
    private $image_path;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get-users")
     */
    private $libelle;

    public function getId()
    {
        return $this->id;
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
