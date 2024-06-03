<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
#[ORM\Table(name: 'Products', schema: 'public')]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read', 'write'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private ?Category $id_category = null;

    /**
     * @var Collection<int, ListProductUser>
     */
    #[ORM\ManyToMany(targetEntity: ListProductUser::class, mappedBy: 'id_product')]
    private Collection $listProductUsers;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?bool $gluten_free = null;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?bool $vegan = null;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?bool $vegetarian = null;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?bool $lactose_free = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read', 'write'])]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['read', 'write'])]
    private ?string $logo_link = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private ?Company $id_company = null;

    public function __construct()
    {
        $this->listProductUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdCategory(): ?Category
    {
        return $this->id_category;
    }

    public function setIdCategory(?Category $id_category): static
    {
        $this->id_category = $id_category;

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
            $listProductUser->addIdProduct($this);
        }

        return $this;
    }

    public function removeListProductUser(ListProductUser $listProductUser): static
    {
        if ($this->listProductUsers->removeElement($listProductUser)) {
            $listProductUser->removeIdProduct($this);
        }

        return $this;
    }

    public function isGlutenFree(): ?bool
    {
        return $this->gluten_free;
    }

    public function setGlutenFree(bool $gluten_free): static
    {
        $this->gluten_free = $gluten_free;

        return $this;
    }

    public function isVegan(): ?bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): static
    {
        $this->vegan = $vegan;

        return $this;
    }

    public function isVegetarian(): ?bool
    {
        return $this->vegetarian;
    }

    public function setVegetarian(bool $vegetarian): static
    {
        $this->vegetarian = $vegetarian;

        return $this;
    }

    public function isLactoseFree(): ?bool
    {
        return $this->lactose_free;
    }

    public function setLactoseFree(bool $lactose_free): static
    {
        $this->lactose_free = $lactose_free;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getIdCompany(): ?Company
    {
        return $this->id_company;
    }

    public function setIdCompany(Company $id_company): static
    {
        $this->id_company = $id_company;

        return $this;
    }
}
