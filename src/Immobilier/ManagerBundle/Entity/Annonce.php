<?php

namespace Immobilier\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Immobilier\ManagerBundle\Entity\Pays;
use Immobilier\ManagerBundle\Entity\Type;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity
 */
class Annonce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="categpry", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="categpry", referencedColumnName="name")
     */
    private $categpry;

    /**
     * @var integer
     *
     * @ORM\Column(name="nature", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Nature")
     * @ORM\JoinColumn(name="nature", referencedColumnName="name")
     */
    private $nature;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_type", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="annonces")
     * @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * * @Assert\Type(type="Immobilier\ManagerBundle\Entity\Type")
     */
    private $idType;

    /**
     * @var integer
     *
     * @ORM\Column(name="photo", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Photo", inversedBy="annonces")
     * @ORM\JoinColumn(name="photo", referencedColumnName="name")
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="surface", type="string", length=50, nullable=false)
     */
    private $surface;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pays", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="annonces")
     * @ORM\JoinColumn(name="id_pays", referencedColumnName="id")
     * @Assert\Type(type="Immobilier\ManagerBundle\Entity\Pays")
     */
    private $idPays;

    /**
     * @var integer
     *
     * @ORM\Column(name="gouvernorat", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Gouvernorat")
     * @ORM\JoinColumn(name="gouvernorat", referencedColumnName="name")
     */
    private $gouvernorat;

    /**
     * @var integer
     *
     * @ORM\Column(name="delegation", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Delegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="name")
     */
    private $delegation;

    /**
     * @var integer
     *
     * @ORM\Column(name="localite", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Localite")
     * @ORM\JoinColumn(name="localite", referencedColumnName="name")
     */
    private $localite;

    /**
     * @var integer
     *
     * @ORM\Column(name="user", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="name")
     */
    private $user;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categpry
     *
     * @param integer $categpry
     * @return Annonce
     */
    public function setCategpry($categpry)
    {
        $this->categpry = $categpry;
    
        return $this;
    }

    /**
     * Get categpry
     *
     * @return integer 
     */
    public function getCategpry()
    {
        return $this->categpry;
    }

    /**
     * Set rubrique
     *
     * @param integer $rubrique
     * @return Annonce
     */
    public function setRubrique($rubrique)
    {
        $this->rubrique = $rubrique;
    
        return $this;
    }

    /**
     * Get rubrique
     *
     * @return integer 
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * Set nature
     *
     * @param integer $nature
     * @return Annonce
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
    
        return $this;
    }

    /**
     * Get nature
     *
     * @return integer 
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set idType
     *
     * @param integer $type
     * @return Annonce
     */
    public function setIdType($type)
    {
        $this->idType = $type;
    
        return $this;
    }

    /**
     * Get IdType
     *
     * @return integer 
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set photo
     *
     * @param integer $photo
     * @return Annonce
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return integer 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set surface
     *
     * @param string $surface
     * @return Annonce
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;
    
        return $this;
    }

    /**
     * Get surface
     *
     * @return string 
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set pays
     *
     * @param integer $pays
     * @return Annonce
     */
    public function setIdPays($pays)
    {
        $this->idPays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return integer 
     */
    public function getIdPays()
    {
        return $this->idPays;
    }

    /**
     * Set gouvernorat
     *
     * @param integer $gouvernorat
     * @return Annonce
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;
    
        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return integer 
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set delegation
     *
     * @param integer $delegation
     * @return Annonce
     */
    public function setDelegation($delegation)
    {
        $this->delegation = $delegation;
    
        return $this;
    }

    /**
     * Get delegation
     *
     * @return integer 
     */
    public function getDelegation()
    {
        return $this->delegation;
    }

    /**
     * Set localite
     *
     * @param integer $localite
     * @return Annonce
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;
    
        return $this;
    }

    /**
     * Get localite
     *
     * @return integer 
     */
    public function getLocalite()
    {
        return $this->localite;
    }

    /**
     * Set user
     *
     * @param integer $user
     * @return Annonce
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }
}