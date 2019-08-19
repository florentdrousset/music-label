<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderLine", mappedBy="order_id")
     */
    private $support_id;

    public function __construct()
    {
        $this->support_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCustomerId(): ?Customer
    {
        return $this->customer_id;
    }

    public function setCustomerId(?Customer $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * @return Collection|OrderLine[]
     */
    public function getSupportId(): Collection
    {
        return $this->support_id;
    }

    public function addSupportId(OrderLine $supportId): self
    {
        if (!$this->support_id->contains($supportId)) {
            $this->support_id[] = $supportId;
            $supportId->setOrderId($this);
        }

        return $this;
    }

    public function removeSupportId(OrderLine $supportId): self
    {
        if ($this->support_id->contains($supportId)) {
            $this->support_id->removeElement($supportId);
            // set the owning side to null (unless already changed)
            if ($supportId->getOrderId() === $this) {
                $supportId->setOrderId(null);
            }
        }

        return $this;
    }
}
