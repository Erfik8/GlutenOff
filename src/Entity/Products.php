<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
#[ORM\Table(name: '"Products"', schema: 'public')]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $id_category = null;

    /**
     * @var Collection<int, ListProductUser>
     */
    #[ORM\ManyToMany(targetEntity: ListProductUser::class, mappedBy: 'id_product')]
    private Collection $listProductUsers;

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
}
