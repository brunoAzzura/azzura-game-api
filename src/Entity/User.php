<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username")
 */
class User implements UserInterface
{
    //@toto : possibilité d'associer un groupe lors de la deserialization (POST)

    Const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    //@todo : ajouter des propriétés !
    // voir https://symfony.com/doc/current/security/guard_authentication.html

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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("get-users")
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\GoodToKnow", inversedBy="users")
     */
    private $goodToKnows;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     * @Assert\NotBlank(groups={"Default"})
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Groups("get-users")
     */
    private $username;

    // * @Assert\Regex(
    //     *  pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
    //     *  message="Password must ...",
    //     *  groups={"Default"} 
    //     * )

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"Deserialize"})
     * @Assert\NotBlank(groups={"Default"})
     */
    private $password;

    // @Serializer\Exclude()
    /**
     * @ORM\Column(type="simple_array")
     * @Groups("get-users")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorldScore", mappedBy="user")
     */
    private $worldScores;

    /**
     * @ORM\Column(type="smallint")
     * @Groups("get-users")
     */
    private $ranking;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAvatar", mappedBy="user")
     * @Groups("get-users")
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Certificate", mappedBy="User")
     */
    private $certificates;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BonusInvestment", inversedBy="users")
     */
    private $bonusInvestments;

    public function __construct()
    {
        $this->goodToKnows = new ArrayCollection();
        $this->worldScores = new ArrayCollection();
        $this->avatar = new ArrayCollection();
        $this->certificates = new ArrayCollection();
        $this->bonusInvestments = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function removeAllBonus() {
        $this->goodToKnows = [];
        $this->bonusInvestments = [];
    }

    /**
     * @return Collection|GoodToKnow[]
     */
    public function getGoodToKnows(): Collection
    {
        return $this->goodToKnows;
    }

    public function addGoodToKnow(GoodToKnow $goodToKnow): self
    {
        if (!$this->goodToKnows->contains($goodToKnow)) {
            $this->goodToKnows[] = $goodToKnow;
        }

        return $this;
    }

    public function removeGoodToKnow(GoodToKnow $goodToKnow): self
    {
        if ($this->goodToKnows->contains($goodToKnow)) {
            $this->goodToKnows->removeElement($goodToKnow);
        }

        return $this;
    }

    public function getSalt()
    {
    }
    public function eraseCredentials()
    {
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|WorldScore[]
     */
    public function getWorldScores(): Collection
    {
        return $this->worldScores;
    }

    public function addWorldScore(WorldScore $worldScore): self
    {
        if (!$this->worldScores->contains($worldScore)) {
            $this->worldScores[] = $worldScore;
            $worldScore->setUser($this);
        }

        return $this;
    }

    public function removeWorldScore(WorldScore $worldScore): self
    {
        if ($this->worldScores->contains($worldScore)) {
            $this->worldScores->removeElement($worldScore);
            // set the owning side to null (unless already changed)
            if ($worldScore->getUser() === $this) {
                $worldScore->setUser(null);
            }
        }

        return $this;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function setCredit(int $credit): self
    {
        $this->credit = $credit;

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
     * @return Collection|UserAvatar[]
     */
    public function getAvatar(): Collection
    {
        return $this->avatar;
    }

    public function addAvatar(UserAvatar $avatar): self
    {
        if (!$this->avatar->contains($avatar)) {
            $this->avatar[] = $avatar;
            $avatar->setUser($this);
        }

        return $this;
    }

    public function removeAvatar(UserAvatar $avatar): self
    {
        if ($this->avatar->contains($avatar)) {
            $this->avatar->removeElement($avatar);
            // set the owning side to null (unless already changed)
            if ($avatar->getUser() === $this) {
                $avatar->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Certificate[]
     */
    public function getCertificates(): Collection
    {
        return $this->certificates;
    }

    public function addCertificate(Certificate $certificate): self
    {
        if (!$this->certificates->contains($certificate)) {
            $this->certificates[] = $certificate;
            $certificate->setUser($this);
        }

        return $this;
    }

    public function removeCertificate(Certificate $certificate): self
    {
        if ($this->certificates->contains($certificate)) {
            $this->certificates->removeElement($certificate);
            // set the owning side to null (unless already changed)
            if ($certificate->getUser() === $this) {
                $certificate->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BonusInvestment[]
     */
    public function getBonusInvestments(): Collection
    {
        return $this->bonusInvestments;
    }

    public function addBonusInvestment(BonusInvestment $bonusInvestment): self
    {
        if (!$this->bonusInvestments->contains($bonusInvestment)) {
            $this->bonusInvestments[] = $bonusInvestment;
        }

        return $this;
    }

    public function removeBonusInvestment(BonusInvestment $bonusInvestment): self
    {
        if ($this->bonusInvestments->contains($bonusInvestment)) {
            $this->bonusInvestments->removeElement($bonusInvestment);
        }

        return $this;
    }
}
