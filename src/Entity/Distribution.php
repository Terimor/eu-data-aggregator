<?php

namespace App\Entity;

use App\Repository\DistributionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DistributionRepository::class)
 */
class Distribution
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $format;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $downloadUrl;

    /**
     * @ORM\ManyToOne(targetEntity=Dataset::class, inversedBy="distributions")
     * @ORM\JoinColumn(nullable=false)
     */
    private Dataset $dataset;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDownloadUrl(): ?string
    {
        return $this->downloadUrl;
    }

    public function setDownloadUrl(string $downloadUrl): self
    {
        $this->downloadUrl = $downloadUrl;

        return $this;
    }

    public function getDataset(): Dataset
    {
        return $this->dataset;
    }

    public function setDataset(Dataset $dataset): self
    {
        $this->dataset = $dataset;

        return $this;
    }
}
