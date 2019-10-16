<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChallengeRepository")
 */
class Challenge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-challenges", "get-challenge"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-challenges", "get-challenge"})
     */
    private $wording;

    /**
     * @ORM\Column(type="text")
     * @Groups({"get-challenges", "get-challenge"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="challenge")
     * @Groups({"get-challenge"})
     */
    private $questions;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"get-challenges", "get-challenge"})
     */
    private $introductionText;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"get-challenges", "get-challenge"})
     */
    private $endingText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get-challenges", "get-challenge"})
     */
    private $imagePresentationPath;

    public function __construct()
    {
        $this->Questions = new ArrayCollection();
    }

    public function getId(): ?int
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

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setChallenge($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->Questions->contains($question)) {
            $this->Questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getChallenge() === $this) {
                $question->setChallenge(null);
            }
        }

        return $this;
    }

    public function getIntroductionText(): ?string
    {
        return $this->introductionText;
    }

    public function setIntroductionText(?string $introductionText): self
    {
        $this->introductionText = $introductionText;

        return $this;
    }

    public function getEndingText(): ?string
    {
        return $this->endingText;
    }

    public function setEndingText(?string $endingText): self
    {
        $this->endingText = $endingText;

        return $this;
    }

    public function getImagePresentationPath(): ?string
    {
        return $this->imagePresentationPath;
    }

    public function setImagePresentationPath(?string $imagePresentationPath): self
    {
        $this->imagePresentationPath = $imagePresentationPath;

        return $this;
    }
}
