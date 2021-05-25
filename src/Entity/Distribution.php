<?php

namespace App\Entity;

use App\Repository\DistributionRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=DistributionRepository::class)
 */
class Distribution
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Type("int")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private string $externalId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private string $format;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Type("string")
     */
    private string $downloadUrl;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Type("string")
     */
    private ?string $payload = null;

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

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function setPayload(string $payload): void
    {
        $this->payload = $payload;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }
}
