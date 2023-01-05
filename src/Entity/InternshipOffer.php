<?php

namespace App\Entity;

use App\Repository\InternshipOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InternshipOfferRepository::class)]
class InternshipOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'internshipOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $theme = null;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: self::class)]
    private Collection $internshipOffers;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\ManyToOne(inversedBy: 'internshipOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Duration $duration = null;

    #[ORM\ManyToMany(targetEntity: InternshipSupervisor::class, inversedBy: 'internshipOffers')]
    private Collection $internship_supervisor;

    public function __construct()
    {
        $this->internshipOffers = new ArrayCollection();
        $this->internship_supervisor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTheme(): ?self
    {
        return $this->theme;
    }

    public function setTheme(?self $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getInternshipOffers(): Collection
    {
        return $this->internshipOffers;
    }

    public function addInternshipOffer(self $internshipOffer): self
    {
        if (!$this->internshipOffers->contains($internshipOffer)) {
            $this->internshipOffers->add($internshipOffer);
            $internshipOffer->setTheme($this);
        }

        return $this;
    }

    public function removeInternshipOffer(self $internshipOffer): self
    {
        if ($this->internshipOffers->removeElement($internshipOffer)) {
            // set the owning side to null (unless already changed)
            if ($internshipOffer->getTheme() === $this) {
                $internshipOffer->setTheme(null);
            }
        }

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setDuration(?Duration $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, InternshipSupervisor>
     */
    public function getInternshipSupervisor(): Collection
    {
        return $this->internship_supervisor;
    }

    public function addInternshipSupervisor(InternshipSupervisor $internshipSupervisor): self
    {
        if (!$this->internship_supervisor->contains($internshipSupervisor)) {
            $this->internship_supervisor->add($internshipSupervisor);
        }

        return $this;
    }

    public function removeInternshipSupervisor(InternshipSupervisor $internshipSupervisor): self
    {
        $this->internship_supervisor->removeElement($internshipSupervisor);

        return $this;
    }
}
