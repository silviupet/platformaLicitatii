<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LicitatieRepository")
 */
class Licitatie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $licitatieId;


    /**
     * @ORM\Column(type="integer")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $pretLicitat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataPretLicitat;
    
    public function __construct(int $productId, int $userId, int $pretLicitat,  \datetime $dataPretLicitat) {
        
        $this->productId = $productId;
        $this->userId = $userId;
        $this->pretLicitat = $pretLicitat;
        $this->dataPretLicitat = $dataPretLicitat;
}

   

    public function getLicitatieId(): ?int
    {
        return $this->licitatieId;
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

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    

    

    public function getPretLicitat(): ?int
    {
        return $this->pretLicitat;
    }

    public function setPretLicitat(int $pretLicitat): self
    {
        $this->pretLicitat = $pretLicitat;

        return $this;
    }

    public function getDataPretLicitat(): \datetime          
    {
        return $this->dataPretLicitat;
    }

    public function setDataPretLicitat(\datetime $dataPretLicitat): self
    {
        $this->dataPretLicitat = $dataPretLicitat;

        return $this;
    }
     
}
