<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="customer_id")
     */
    private $orders;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\News", mappedBy="customer_id")
     */
    private $news;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\News", inversedBy="customers")
     */
    private $id_news;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->id_news = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomerId($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getCustomerId() === $this) {
                $order->setCustomerId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->addCustomerId($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->contains($news)) {
            $this->news->removeElement($news);
            $news->removeCustomerId($this);
        }

        return $this;
    }

    /**
     * @return Collection|News[]
     */
    public function getIdNews(): Collection
    {
        return $this->id_news;
    }

    public function addIdNews(News $idNews): self
    {
        if (!$this->id_news->contains($idNews)) {
            $this->id_news[] = $idNews;
        }

        return $this;
    }

    public function removeIdNews(News $idNews): self
    {
        if ($this->id_news->contains($idNews)) {
            $this->id_news->removeElement($idNews);
        }

        return $this;
    }
}
