<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $Type_Activite;

    /**
     * @ORM\OneToMany(targetEntity=InfoAdminClients::class, mappedBy="id_client", orphanRemoval=true)
     */
    private $infoAdminClients;

    /**
     * @ORM\OneToMany(targetEntity=JobOffer::class, mappedBy="client")
     */
    private $jobOffers;

    public function __construct()
    {
        $this->infoAdminClients = new ArrayCollection();
        $this->jobOffers = new ArrayCollection();
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
        return $this->Type_Activite;
    }

    public function setTypeActivite(string $Type_Activite): self
    {
        $this->Type_Activite = $Type_Activite;

        return $this;
    }

    /**
     * @return Collection|InfoAdminClients[]
     */
    public function getInfoAdminClients(): Collection
    {
        return $this->infoAdminClients;
    }

    public function addInfoAdminClient(InfoAdminClients $infoAdminClient): self
    {
        if (!$this->infoAdminClients->contains($infoAdminClient)) {
            $this->infoAdminClients[] = $infoAdminClient;
            $infoAdminClient->setIdClient($this);
        }

        return $this;
    }

    public function removeInfoAdminClient(InfoAdminClients $infoAdminClient): self
    {
        if ($this->infoAdminClients->removeElement($infoAdminClient)) {
            // set the owning side to null (unless already changed)
            if ($infoAdminClient->getIdClient() === $this) {
                $infoAdminClient->setIdClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JobOffer[]
     */
    public function getJobOffers(): Collection
    {
        return $this->jobOffers;
    }

    public function addJobOffer(JobOffer $jobOffer): self
    {
        if (!$this->jobOffers->contains($jobOffer)) {
            $this->jobOffers[] = $jobOffer;
            $jobOffer->setClient($this);
        }

        return $this;
    }

    public function removeJobOffer(JobOffer $jobOffer): self
    {
        if ($this->jobOffers->removeElement($jobOffer)) {
            // set the owning side to null (unless already changed)
            if ($jobOffer->getClient() === $this) {
                $jobOffer->setClient(null);
            }
        }

        return $this;
    }
}
