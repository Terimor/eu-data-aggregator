<?php

namespace App\Entity;

use App\Repository\DatasetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=DatasetRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Dataset
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Type("integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Type("string")
     */
    private string $externalId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private string $countryCode;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Type("string")
     */
    private ?string $descriptionEn;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Type("string")
     */
    private ?string $descriptionDe;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Type("string")
     */
    private ?string $descriptionFr;

    /**
     * @ORM\OneToMany(targetEntity=Distribution::class, mappedBy="dataset", cascade={"remove", "persist"})
     * @Serializer\Type("ArrayCollection<App\Entity\Distribution>")
     */
    private Collection $distributions;

    public function __construct()
    {
        $this->distributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(?string $descriptionEn): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getDescriptionDe(): ?string
    {
        return $this->descriptionDe;
    }

    public function setDescriptionDe(?string $descriptionDe): self
    {
        $this->descriptionDe = $descriptionDe;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->descriptionFr;
    }

    public function setDescriptionFr(?string $descriptionFr): self
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return Collection|Distribution[]
     */
    public function getDistributions(): Collection
    {
        return $this->distributions;
    }

    public function addDistribution(Distribution $distribution): self
    {
        if (!$this->distributions->contains($distribution)) {
            $this->distributions[] = $distribution;
            $distribution->setDataset($this);
        }

        return $this;
    }

    /**
     * @ORM\PreFlush()
     */
    public function doOnPreFlush(): void
    {
        foreach ($this->getDistributions() as $distribution) {
            $distribution->setDataset($this);
        }
    }
}
