<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User {
  /**
   * @var int
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */  
  private $userId;
  
   /**
   * @var string
   * @ORM\Column(type="string", length = 64)
   */  
  private $email;
  
   /**
   * @var string
   * @ORM\Column(type="string", length = 64)
   */  
  private $hashedPassword;
  
   /**
   * @var datetime
   * @ORM\GeneratedValue
   * @ORM\Column(type="datetime")
   */  
  private $signUpDate;
  /**
   * @param string $email
   * @param string $password
   * 
   */
  
  function __construct(string $email, string $password) {
      $this->email = $email;
      $this->setPassword($password);
  }
  
  /**
   * @param string $password
   * return void
   * 
   */
  public function setPassword(string $password) {
      $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      
//       password_hash este o functie care hasuieste
      
  }
//  verificare parola cu parola hasuita
  
   /**
   * @param string $password
   * return bool
   * 
   */
    public function verifyPassword(string $password):bool {
        return password_verify($password , $this->hashedPassword);
    }
  
    function getUserId(): ?int {
        return $this->UserId;
    }

    function getEmail(): ? string{
        return $this->email;
    }

    function getHashedPassword(): ?string {
        return $this->hashedPassword;
    }

    function getSignUpDate() {
        return $this->signUpDate;
    }
    function setUserId($UserId):self {
        $this->UserId = $UserId;
        return $this;
    }

    function setHashedPassword($hashedPassword):self {
        $this->hashedPassword = $hashedPassword;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setSignUpDate(\DateTimeInterface $signUpDate): self
    {
        $this->signUpDate = $signUpDate;

        return $this;
    }



}