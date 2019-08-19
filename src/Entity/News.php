<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
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
    private $thematic;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_published;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Customer", inversedBy="news")
     */
    private $customer_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Customer", mappedBy="id_news")
     */
    private $customers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="news")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="news")
     */
    private $usersId;

    public function __construct()
    {
        $this->customer_id = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->usersId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThematic(): ?string
    {
        return $this->thematic;
    }

    public function setThematic(string $thematic): self
    {
        $this->thematic = $thematic;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDatePublished(): ?\DateTimeInterface
    {
        return $this->date_published;
    }

    public function setDatePublished(\DateTimeInterface $date_published): self
    {
        $this->date_published = $date_published;

        return $this;
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomerId(): Collection
    {
        return $this->customer_id;
    }

    public function addCustomerId(Customer $customerId): self
    {
        if (!$this->customer_id->contains($customerId)) {
            $this->customer_id[] = $customerId;
        }

        return $this;
    }

    public function removeCustomerId(Customer $customerId): self
    {
        if ($this->customer_id->contains($customerId)) {
            $this->customer_id->removeElement($customerId);
        }

        return $this;
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->addIdNews($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->contains($customer)) {
            $this->customers->removeElement($customer);
            $customer->removeIdNews($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addNews($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeNews($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsersId(): Collection
    {
        return $this->usersId;
    }

    public function addUsersId(User $usersId): self
    {
        if (!$this->usersId->contains($usersId)) {
            $this->usersId[] = $usersId;
            $usersId->addNews($this);
        }

        return $this;
    }

    public function removeUsersId(User $usersId): self
    {
        if ($this->usersId->contains($usersId)) {
            $this->usersId->removeElement($usersId);
            $usersId->removeNews($this);
        }

        return $this;
    }
}
