<?php

namespace App\Entity;

use App\Repository\UserTypeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTypeRepository::class)]
#[ORM\Table(name: '"User_type"', schema: 'public')]
class UserType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $value = null;

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

    public function getVlue(): ?int
    {
        return $this->vlue;
    }

    public function setVlue(int $vlue): static
    {
        $this->vlue = $vlue;

        return $this;
    }
}
