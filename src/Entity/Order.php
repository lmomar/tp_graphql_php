<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Orm\Table(value="`order`")
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="Client",inversedBy="orders",cascade={"remove"})
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ? string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
