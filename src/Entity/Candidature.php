<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidatureRepository::class)
 */
class Candidature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Candidats::class, inversedBy="candidatures")
     */
    private $candidat;

    /**
     * @ORM\ManyToOne(targetEntity=JobOffer::class, inversedBy="candidatures")
     */
    private $job_offer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidat(): ?Candidats
    {
        return $this->candidat;
    }

    public function setCandidat(?Candidats $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }

    public function getJobOffer(): ?JobOffer
    {
        return $this->job_offer;
    }

    public function setJobOffer(?JobOffer $job_offer): self
    {
        $this->job_offer = $job_offer;

        return $this;
    }
}
