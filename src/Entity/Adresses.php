<?php

namespace App\Entity;

use App\Repository\AdressesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdressesRepository::class)]
#[ORM\Table(name: '"Adresses"', schema: 'public')]
class Adresses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $street = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $postal_code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $accomodation = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id_city = null;

    /**
     * @var Collection<int, Shops>
     */
    #[ORM\OneToMany(targetEntity: Shops::class, mappedBy: 'id_adress')]
    private Collection $shops;

    public function __construct()
    {
        $this->shops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getAccomodation(): ?string
    {
        return $this->accomodation;
    }

    public function setAccomodation(string $accomodation): static
    {
        $this->accomodation = $accomodation;

        return $this;
    }

    public function getIdCity(): ?string
    {
        return $this->id_city;
    }

    public function setIdCity(string $id_city): static
    {
        $this->id_city = $id_city;

        return $this;
    }

    /**
     * @return Collection<int, Shops>
     */
    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function addShop(Shops $shop): static
    {
        if (!$this->shops->contains($shop)) {
            $this->shops->add($shop);
            $shop->setIdAdress($this);
        }

        return $this;
    }

    public function removeShop(Shops $shop): static
    {
        if ($this->shops->removeElement($shop)) {
            // set the owning side to null (unless already changed)
            if ($shop->getIdAdress() === $this) {
                $shop->setIdAdress(null);
            }
        }

        return $this;
    }
}
