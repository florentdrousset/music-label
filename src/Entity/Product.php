<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $production_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Streaming", mappedBy="product_id")
     */
    private $streamings;

    public function __construct()
    {
        $this->streamings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProductionDate(): ?\DateTimeInterface
    {
        return $this->production_date;
    }

    public function setProductionDate(\DateTimeInterface $production_date): self
    {
        $this->production_date = $production_date;

        return $this;
    }

    /**
     * @return Collection|Streaming[]
     */
    public function getStreamings(): Collection
    {
        return $this->streamings;
    }

    public function addStreaming(Streaming $streaming): self
    {
        if (!$this->streamings->contains($streaming)) {
            $this->streamings[] = $streaming;
            $streaming->setProductId($this);
        }

        return $this;
    }

    public function removeStreaming(Streaming $streaming): self
    {
        if ($this->streamings->contains($streaming)) {
            $this->streamings->removeElement($streaming);
            // set the owning side to null (unless already changed)
            if ($streaming->getProductId() === $this) {
                $streaming->setProductId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
