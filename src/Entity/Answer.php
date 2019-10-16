<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-challenge", "get-questions", "get-theme", "get-answer"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=255)
     * @Groups({"get-challenge", "get-questions", "get-theme", "get-answer"})
     */
    private $wording;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     * @Groups({"get-challenge", "get-questions", "get-theme", "get-answer"})
     */
    private $valid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers", cascade={"persist"})
     */
    private $question;

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

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
