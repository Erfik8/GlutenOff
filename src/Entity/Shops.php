<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ShopsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ShopsRepository::class)]
#[ORM\Table(name: 'Shops', schema: 'public')]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
class Shops
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read', 'write'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'shops')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private ?Adresses $id_adress = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read', 'write'])]
    private ?string $google_share_link = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read', 'write'])]
    private ?string $photo_link = null;

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

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read', 'write'])]
    private ?string $google_embeded_link = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read', 'write'])]
    private ?string $logo_link = null;

    /**
     * @var Collection<int, ListShopLikes>
     */
    #[ORM\ManyToMany(targetEntity: ListShopLikes::class, mappedBy: 'id_shop')]
    private Collection $listShopLikes;

    public function __construct()
    {
        $this->listShopLikes = new ArrayCollection();
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

    public function getIdAdress(): ?Adresses
    {
        return $this->id_adress;
    }

    public function setIdAdress(?Adresses $id_adress): static
    {
        $this->id_adress = $id_adress;

        return $this;
    }

    public function getGoogleShareLink(): ?string
    {
        return $this->google_share_link;
    }

    public function setGoogleShareLink(?string $google_share_link): static
    {
        $this->google_share_link = $google_share_link;

        return $this;
    }

    public function getPhotoLink(): ?string
    {
        return $this->photo_link;
    }

    public function setPhotoLink(?string $photo_link): static
    {
        $this->photo_link = $photo_link;

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

    public function getGoogleEmbedeLink(): ?string
    {
        return $this->google_embede_link;
    }

    public function setGoogleEmbedeLink(?string $google_embede_link): static
    {
        $this->google_embede_link = $google_embede_link;

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
            $listShopLike->addIdShop($this);
        }

        return $this;
    }

    public function removeListShopLike(ListShopLikes $listShopLike): static
    {
        if ($this->listShopLikes->removeElement($listShopLike)) {
            $listShopLike->removeIdShop($this);
        }

        return $this;
    }
}
