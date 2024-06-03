<?php

namespace App\Entity;


use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\Table(name: 'Users', schema: 'public')]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read', 'write'])]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read', 'write'])]
    private ?string $password = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read', 'write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read', 'write'])]
    private ?string $surname = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, name: 'id_user_type')]
    #[Groups(['read', 'write'])]
    private ?UserType $id_user_type = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read', 'write'])]
    private ?string $logo_link = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['read', 'write'])]
    private ?\DateTimeInterface $premium_ending_date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, name: 'id_city')]
    #[Groups(['read', 'write'])]
    private ?City $id_city = null;

    /**
     * @var Collection<int, ListProductUser>
     */
    #[ORM\ManyToMany(targetEntity: ListProductUser::class, mappedBy: 'id_user')]
    private Collection $listProductUsers;

    /**
     * @var Collection<int, ListShopLikes>
     */
    #[ORM\ManyToMany(targetEntity: ListShopLikes::class, mappedBy: 'id_user')]
    private Collection $listShopLikes;

    public function __construct()
    {
        $this->listProductUsers = new ArrayCollection();
        $this->listShopLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getIdUserType(): ?UserType
    {
        return $this->id_user_type;
    }

    public function setIdUserType(?UserType $id_user_type): static
    {
        $this->id_user_type = $id_user_type;

        return $this;
    }

    public function getLogoLink(): ?string
    {
        return $this->logo_link;
    }

    public function setLogoLink(?string $logo_link): static
    {
        $this->logo_link = $logo_link;

        return $this;
    }

    public function getPremiumEndingDate(): ?\DateTimeInterface
    {
        return $this->premium_ending_date;
    }

    public function setPremiumEndingDate(?\DateTimeInterface $premium_ending_date): static
    {
        $this->premium_ending_date = $premium_ending_date;

        return $this;
    }

    public function getIdCity(): ?City
    {
        return $this->id_city;
    }

    public function setIdCity(?City $id_city): static
    {
        $this->id_city = $id_city;

        return $this;
    }

    /**
     * @return Collection<int, ListProductUser>
     */
    public function getListProductUsers(): Collection
    {
        return $this->listProductUsers;
    }

    public function addListProductUser(ListProductUser $listProductUser): static
    {
        if (!$this->listProductUsers->contains($listProductUser)) {
            $this->listProductUsers->add($listProductUser);
            $listProductUser->addIdUser($this);
        }

        return $this;
    }

    public function removeListProductUser(ListProductUser $listProductUser): static
    {
        if ($this->listProductUsers->removeElement($listProductUser)) {
            $listProductUser->removeIdUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ListShopLikes>
     */
    public function getListShopLikes(): Collection
    {
        return $this->listShopLikes;
    }

    public function addListShopLike(ListShopLikes $listShopLike): static
    {
        if (!$this->listShopLikes->contains($listShopLike)) {
            $this->listShopLikes->add($listShopLike);
            $listShopLike->addIdUser($this);
        }

        return $this;
    }

    public function removeListShopLike(ListShopLikes $listShopLike): static
    {
        if ($this->listShopLikes->removeElement($listShopLike)) {
            $listShopLike->removeIdUser($this);
        }

        return $this;
    }

    public function getRoles(): array
    {
        $roles[] = 'IS_AUTHENTICATED_FULLY';

        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
        // Implement the eraseCredentials method here
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
}
