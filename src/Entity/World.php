<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorldRepository")
 */
class World
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-worlds", "get-world", "get-user-goodtoknows", "get-user-worldScore", "get-theme", "get-goodtoknows", "get-themes"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-worlds", "get-world", "get-user-goodtoknows", "get-user-worldScore", "get-goodtoknows", "get-themes"})
     */
    private $wording;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-worlds", "get-world"})
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get-worlds", "get-world"})
     */
    private $ranking;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Theme", mappedBy="world")
     * @Groups({"get-world"})
     */
    private $themes;

    // * @DeserializeEntity(type="App\Entity\WorldDraw", idField="id", idGetter="getId", setter="setWorldDraw")
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\WorldDraw", cascade={"persist", "remove"})
     * @Groups({"get-worlds", "get-world", "get-theme", "get-user-worldScore"})
     */
    private $worldDraw;

    // /**
    //  * @ORM\OneToMany(targetEntity="App\Entity\GoodToKnow", mappedBy="world")
    //  */
    // private $goodToKnows;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
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
     * @return Collection|Theme[]
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
            $theme->setWorld($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->themes->contains($theme)) {
            $this->themes->removeElement($theme);
            // set the owning side to null (unless already changed)
            if ($theme->getWorld() === $this) {
                $theme->setWorld(null);
            }
        }

        return $this;
    }

    public function getWorldDraw(): ?WorldDraw
    {
        return $this->worldDraw;
    }

    public function setWorldDraw(?WorldDraw $worldDraw): self
    {
        $this->worldDraw = $worldDraw;

        return $this;
    }

    // /**
    //  * @return Collection|GoodToKnow[]
    //  */
    // public function getGoodToKnows(): Collection
    // {
    //     return $this->goodToKnows;
    // }

    // public function addGoodToKnow(GoodToKnow $goodToKnow): self
    // {
    //     if (!$this->goodToKnows->contains($goodToKnow)) {
    //         $this->goodToKnows[] = $goodToKnow;
    //         $goodToKnow->setWorld($this);
    //     }

    //     return $this;
    // }

    // public function removeGoodToKnow(GoodToKnow $goodToKnow): self
    // {
    //     if ($this->goodToKnows->contains($goodToKnow)) {
    //         $this->goodToKnows->removeElement($goodToKnow);
    //         // set the owning side to null (unless already changed)
    //         if ($goodToKnow->getWorld() === $this) {
    //             $goodToKnow->setWorld(null);
    //         }
    //     }

    //     return $this;
    // }


}
