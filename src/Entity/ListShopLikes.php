<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ListShopLikesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ListShopLikesRepository::class)]
#[ORM\Table(name: 'List_shop_likes', schema: 'public')]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
class ListShopLikes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?bool $userlike = null;

    /**
     * @var Collection<int, Shops>
     */
    #[ORM\ManyToMany(targetEntity: Shops::class, inversedBy: 'listShopLikes')]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private Collection $id_shop;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'listShopLikes')]
    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private Collection $id_user;

    public function __construct()
    {
        $this->id_shop = new ArrayCollection();
        $this->id_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isUserlike(): ?bool
    {
        return $this->userlike;
    }

    public function setUserlike(bool $userlike): static
    {
        $this->userlike = $userlike;

        return $this;
    }

    /**
     * @return Collection<int, Shops>
     */
    public function getIdShop(): Collection
    {
        return $this->id_shop;
    }

    public function addIdShop(Shops $idShop): static
    {
        if (!$this->id_shop->contains($idShop)) {
            $this->id_shop->add($idShop);
        }

        return $this;
    }

    public function removeIdShop(Shops $idShop): static
    {
        $this->id_shop->removeElement($idShop);

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
