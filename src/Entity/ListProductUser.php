<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ListProductUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ListProductUserRepository::class)]
#[ORM\Table(name: 'List_product_user', schema: 'public')]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
class ListProductUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?int $id = null;

    /**
     * @var Collection<int, Products>
     */
    #[ORM\ManyToMany(targetEntity: Products::class, inversedBy: 'listProductUsers')]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private Collection $id_product;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'listProductUsers')]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private Collection $id_user;

    public function __construct()
    {
        $this->id_product = new ArrayCollection();
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getIdProduct(): Collection
    {
        return $this->id_product;
    }

    public function addIdProduct(Products $idProduct): static
    {
        if (!$this->id_product->contains($idProduct)) {
            $this->id_product->add($idProduct);
        }

        return $this;
    }

    public function removeIdProduct(Products $idProduct): static
    {
        $this->id_product->removeElement($idProduct);

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(Users $idUser): static
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user->add($idUser);
        }

        return $this;
    }

    public function removeIdUser(Users $idUser): static
    {
        $this->id_user->removeElement($idUser);

        return $this;
    }
}
