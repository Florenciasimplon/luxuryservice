<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
class Clients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name_Society;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_Activite;




    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSociety(): ?string
    {
        return $this->Name_Society;
    }

    public function setNameSociety(string $Name_Society): self
    {
        $this->Name_Society = $Name_Society;

        return $this;
    }

    public function getTypeActivite(): ?string
    {
        return $this->type_Activite;
    }

    public function setTypeActivite(string $type_Activite): self
    {
        $this->type_Activite = $type_Activite;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNameSociety();
    }
}
