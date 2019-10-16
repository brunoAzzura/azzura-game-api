<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GoodToKnowRepository")
 */
class GoodToKnow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"user", "get-user-goodtoknows", "get-goodtoknows"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"user", "get-user-goodtoknows", "get-bonus", "get-goodtoknows"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"user", "get-user-goodtoknows", "get-bonus", "get-goodtoknows"})
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"user", "get-user-goodtoknows", "get-bonus", "get-goodtoknows"})
     */
    private $wording;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Groups({"user", "get-user-goodtoknows", "get-bonus", "get-goodtoknows"})
     */
    private $info;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="goodToKnows")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="goodToKnows")
     * @Serializer\Groups({"user", "get-user-goodtoknows", "get-goodtoknows"})
     */
    private $theme;

    public function __construct()
    {
        $this->goodToKnows = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addGoodToKnow($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeGoodToKnow($this);
        }

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

    /**
     * Get the value of info
     */ 
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set the value of info
     *
     * @return  self
     */ 
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }
}
