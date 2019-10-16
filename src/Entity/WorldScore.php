<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorldScoreRepository")
 */
class WorldScore
{

    const SCORE_SUCCESS_WORLD = 4;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"user", "get-user-worldScore"})
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     * @Serializer\Groups({"user", "get-user-worldScore"})
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\World")
     * @Serializer\Groups({"user", "get-user-worldScore"})
     */
    private $world;

    /**
     * @ORM\Column(type="boolean")
     * @Serializer\Groups({"user", "get-user-worldScore"})
     */
    private $completed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="worldScores")
     */
    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getWorld(): ?World
    {
        return $this->world;
    }

    public function setWorld(?World $world): self
    {
        $this->world = $world;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    

    /**
     * Get the value of completed
     */ 
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set the value of completed
     *
     * @return  self
     */ 
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }
}
