<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProdusefavoriteRepository")
 */
class Produsefavorite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $favoriteId;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $productId;

    /**
     * Produsefavorite constructor.
     * @param $userId
     * @param $productId
     */
    public function  __construct($userId, $productId)
    {
        $this->userId = $userId;
        $this->productId = $productId;
    }


    public function getFavoriteId(): ?int
    {
        return $this->favoriteId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }
}
