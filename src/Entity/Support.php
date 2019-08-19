<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupportRepository")
 */
class Support
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
    private $support_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderLine", mappedBy="support")
     */
    private $command_id;

    public function __construct()
    {
        $this->command_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupportType(): ?string
    {
        return $this->support_type;
    }

    public function setSupportType(string $support_type): self
    {
        $this->support_type = $support_type;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|OrderLine[]
     */
    public function getCommandId(): Collection
    {
        return $this->command_id;
    }

    public function addCommandId(OrderLine $commandId): self
    {
        if (!$this->command_id->contains($commandId)) {
            $this->command_id[] = $commandId;
            $commandId->setSupport($this);
        }

        return $this;
    }

    public function removeCommandId(OrderLine $commandId): self
    {
        if ($this->command_id->contains($commandId)) {
            $this->command_id->removeElement($commandId);
            // set the owning side to null (unless already changed)
            if ($commandId->getSupport() === $this) {
                $commandId->setSupport(null);
            }
        }

        return $this;
    }
}
