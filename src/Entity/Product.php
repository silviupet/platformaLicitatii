<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\DBAL\Types\DateTimeType;




/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product implements \JsonSerializable
{
//    pt randare josn ca sa aiba acces la proprietatile private ale entitatii product
     public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $productId;

   

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     */
    private $productDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"})
     */
    private $photoA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"})
     */
    private $photoB;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"})
     */
    private $photoC;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"})
     */
    private $photoD;

    /**
     * @ORM\Column(type="string", length=255,nullable=true )
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"})
     */
    private $photoE;

    /**
     * @ORM\Column(type="string", length=255,nullable=true )
     * @Assert\File(mimeTypes={ "image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"})
     */
    private $photoF;

    /**
     * @ORM\Column(type="string")
     */
    private $category;
    
     /**
     * @ORM\Column(type="integer")
     */
    private $pretPornire;
    
     /**
     * @ORM\Column(type="integer")
     */
    private $ultimulPretLicitat;
    
    /**
     * @ORM\Column(type="datetime")
     * 
     * @var \DateTime
     */
    private $dataStop;
    
    public function getPretPornire(): ?int
    {
        return $this->pretPornire;
       
    }
    public function setPretPornire(int $pretPornire): self
    {
        $this->pretPornire = $pretPornire;

        return $this;
    }
    
   public function getUltimulPretLicitat(): ?int
    {
        return $this->ultimulPretLicitat;
       
    }
    public function setUltimulPretLicitat(int $ultimulPretLicitat): self
    {
        $this->ultimulPretLicitat = $ultimulPretLicitat;

        return $this;
    }
    public function getDataStop(): ?\datetime
    {               
        return $this->dataStop;
    }

    public function setDataStop(\DateTime $dataStop) : self
    {
        $this->dataStop = $dataStop;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProductTitle(): ?string
    {
        return $this->productTitle;
    }

    public function setProductTitle(string $productTitle): self
    {
        $this->productTitle = $productTitle;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function setProductDescription(string $productDescription): self
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    public function getPhotoA()
    //        se scoate : ?string da eroare 
    {
        return $this->photoA;
    }

    public function setPhotoA($photoA)
//       se scoate (string $photoB): self da eroare         
    {
        $this->photoA = $photoA;

        return $this;
    }

    public function getPhotoB()
//        se scoate : ?string da eroare 
    {
        return $this->photoB;
    }

    public function setPhotoB($photoB)
//        se scoate (string $photoB): self da eroare 
    {
        $this->photoB = $photoB;

        return $this;
    }

    public function getPhotoC()
    {
        return $this->photoC;
    }

    public function setPhotoC($photoC)
    {
        $this->photoC = $photoC;

        return $this;
    }

    public function getPhotoD()
    {
        return $this->photoD;
    }

    public function setPhotoD($photoD)
    {
        $this->photoD = $photoD;

        return $this;
    }

    public function getPhotoE()
    {
        return $this->photoE;
    }

    public function setPhotoE($photoE)
    {
        $this->photoE = $photoE;

        return $this;
    }

    public function getPhotoF()
    {
        return $this->photoF;
    }

    public function setPhotoF($photoF)
    {
        $this->photoF = $photoF;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('photoA', new Assert\File([
            'maxSize' => '10240k',
            'mimeTypesMessage' => 'Please upload a valid photo',
            'mimeTypes'=> ["image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"]
           
        ]));
        $metadata->addPropertyConstraint('photoB', new Assert\File([
            'maxSize' => '10240k',
            'mimeTypesMessage' => 'Please upload a valid Photo',
            'mimeTypes'=> ["image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"]
        ]));
        $metadata->addPropertyConstraint('photoC', new Assert\File([
            'maxSize' => '10240k',
            'mimeTypesMessage' => 'Please upload a valid photo',
            'mimeTypes'=> ["image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"]
        ]));
        $metadata->addPropertyConstraint('photoD', new Assert\File([
            'maxSize' => '10240k',
            'mimeTypesMessage' => 'Please upload a valid photo',
            'mimeTypes'=> ["image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"]
        ]));
        $metadata->addPropertyConstraint('photoE', new Assert\File([
            'maxSize' => '10240k',
            'mimeTypesMessage' => 'Please upload a valid pgoto',
            'mimeTypes'=> ["image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"]
        ]));
        $metadata->addPropertyConstraint('photoF', new Assert\File([
            'maxSize' => '10240k',
            'mimeTypesMessage' => 'Please upload a valid photo',
            'mimeTypes'=> ["image/jpeg" , "image/png" , "image/tiff" , "image/svg+xml"]
        ]));
        
        $metadata->addPropertyConstraint('category', new Assert\Choice([
            'choices' => ['autovehicole', 'mobilier' , 'electronice' , 'altele'],
            'message' => 'Choose a valid option.',
    ]));
        
        $metadata->addPropertyConstraint('pretPornire', new Assert\Positive());
        
        $metadata->addPropertyConstraint('dataStop', new Assert\DateTime());
        
       
}

}