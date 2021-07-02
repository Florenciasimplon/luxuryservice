<?php

namespace App\Entity;

use App\Repository\CandidatsRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Bool_;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CandidatsRepository::class)
 */
class Candidats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $current_location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Assert\NotBlank
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $short_description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity=JobCategory::class, inversedBy="candidats")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $job_candidat;

    /**
     * @ORM\ManyToOne(targetEntity=Experience::class, inversedBy="candidats")
     */
    private $experience;

   
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passport;

    /**
     * @ORM\OneToMany(targetEntity=InfoAdminCandidat::class, mappedBy="candidat")
     */
    private $infoAdminCandidats;

    /**
     * @ORM\OneToMany(targetEntity=Candidature::class, mappedBy="candidat")
     */
    private $candidatures;

    /**
     * @ORM\ManyToOne(targetEntity=Gender::class, inversedBy="candidats")
     */
    private $gender;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="candidat", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthplace;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $availability;

    public function __construct()
    {
        $this->infoAdminCandidats = new ArrayCollection();
        $this->candidatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCurrentLocation(): ?string
    {
        return $this->current_location;
    }

    public function setCurrentLocation(string $current_location): self
    {
        $this->current_location = $current_location;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

   

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getJobCandidat(): ?JobCategory
    {
        return $this->job_candidat;
    }

    public function setJobCandidat(?JobCategory $job_candidat): self
    {
        $this->job_candidat = $job_candidat;

        return $this;
    }

    public function getExperience(): ?Experience
    {
        return $this->experience;
    }

    public function setExperience(?Experience $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(string $passport): self
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * @return Collection|InfoAdminCandidat[]
     */
    public function getInfoAdminCandidats(): Collection
    {
        return $this->infoAdminCandidats;
    }

    public function addInfoAdminCandidat(InfoAdminCandidat $infoAdminCandidat): self
    {
        if (!$this->infoAdminCandidats->contains($infoAdminCandidat)) {
            $this->infoAdminCandidats[] = $infoAdminCandidat;
            $infoAdminCandidat->setCandidat($this);
        }

        return $this;
    }

    public function removeInfoAdminCandidat(InfoAdminCandidat $infoAdminCandidat): self
    {
        if ($this->infoAdminCandidats->removeElement($infoAdminCandidat)) {
            // set the owning side to null (unless already changed)
            if ($infoAdminCandidat->getCandidat() === $this) {
                $infoAdminCandidat->setCandidat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Candidature[]
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures[] = $candidature;
            $candidature->setCandidat($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getCandidat() === $this) {
                $candidature->setCandidat(null);
            }
        }

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        // set the owning side of the relation if necessary
        if ($user->getCandidat() !== $this) {
            $user->setCandidat($this);
        }

        $this->user = $user;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getBirthdate(): ? DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(?bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }
    public function toArray(){
        return ['gender'=>$this->getGender(),
                'firstname'=>$this->getFirstName(), 
                'lastname'=>$this->getLastName(), 
                'adress' => $this->getAdress(), 
                'country' => $this->getCountry(),
                'nationality' => $this->getNationality(),
                'cv' => $this->getCv(),
                'Picture' => $this->getPicture(),
                'current_location' => $this->getCurrentLocation(),
                'birthdate' => $this->getBirthDate(),
                'birthplace' => $this->getBirthPlace(),
                'short_description' => $this->getShortDescription(),
                'experience' => $this->getExperience(),
                'job_candidat' => $this->getJobCandidat(),
                'passport' => $this->getPassport()
            ];
    }
    
    public function isProfileComplete()
    {
        return $this->getProfileCompletionPercent() === 100;
    }

    public function getProfileCompletionPercent()
    {
        $filledFieldCount = 0;
        $fields = $this->toArray();

        foreach($fields as $field) {
            if (!empty($field)) {
                $filledFieldCount++;
            }
        }

        return $filledFieldCount * 100 / count($fields);
    }
}
