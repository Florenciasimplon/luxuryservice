<?php

namespace App\Entity;

use App\Repository\InfoAdminCandidatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfoAdminCandidatRepository::class)
 */
class InfoAdminCandidat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_create;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_undated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_deleted;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $files;

    /**
     * @ORM\ManyToOne(targetEntity=Candidats::class, inversedBy="infoAdminCandidats")
     */
    private $candidat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(\DateTimeInterface $date_create): self
    {
        $this->date_create = $date_create;

        return $this;
    }

    public function getDateUndated(): ?\DateTimeInterface
    {
        return $this->date_undated;
    }

    public function setDateUndated(\DateTimeInterface $date_undated): self
    {
        $this->date_undated = $date_undated;

        return $this;
    }

    public function getDateDeleted(): ?\DateTimeInterface
    {
        return $this->date_deleted;
    }

    public function setDateDeleted(\DateTimeInterface $date_deleted): self
    {
        $this->date_deleted = $date_deleted;

        return $this;
    }

    public function getFiles(): ?string
    {
        return $this->files;
    }

    public function setFiles(string $files): self
    {
        $this->files = $files;

        return $this;
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
}
