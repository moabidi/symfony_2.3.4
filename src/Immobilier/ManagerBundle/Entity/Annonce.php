<?php

namespace Immobilier\ManagerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=100, nullable=false)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_rubrique", type="integer", length=2, nullable=false)
     */
    private $idRubrique;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_category", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     */
    private $idCategory;

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
     * @Assert\Type(type="Immobilier\ManagerBundle\Entity\Type")
     */
    private $idType;

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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

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
     * @ORM\Column(name="idGouvernorat", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Gouvernorat")
     * @ORM\JoinColumn(name="idGouvernorat", referencedColumnName="name")
     */
    private $idGouvernorat;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDelegation", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Delegation")
     * @ORM\JoinColumn(name="idDelegation", referencedColumnName="name")
     */
    private $idDelegation;

    /**
     * @var integer
     *
     * @ORM\Column(name="idLocalite", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Localite")
     * @ORM\JoinColumn(name="idLocalite", referencedColumnName="name")
     */
    private $idLocalite;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="name")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=20, nullable=false)
     */
    private $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=20, nullable=false)
     */
    private $lat;

    private $created;
    private $updated;
    private $photos;

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Annonce
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->title;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Annonce
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Annonce
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Set idRubrique
     *
     * @param integer $idRubrique
     * @return Annonce
     */
    public function setIdRubrique($idRubrique)
    {
        $this->idRubrique = $idRubrique;

        return $this;
    }

    /**
     * Get idRubrique
     *
     * @return integer
     */
    public function getIdRubrique()
    {
        return $this->idRubrique;
    }

    /**
     * Set idCategory
     *
     * @param integer $idCategory
     * @return Annonce
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    
        return $this;
    }

    /**
     * Get idCategory
     *
     * @return integer 
     */
    public function getIdCategory()
    {
        return $this->idCategory;
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
     * Set description
     *
     * @param string $description
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set idGouvernorat
     *
     * @param integer $idGouvernorat
     * @return Annonce
     */
    public function setIdGouvernorat($idGouvernorat)
    {
        $this->idGouvernorat = $idGouvernorat;
    
        return $this;
    }

    /**
     * Get idGouvernorat
     *
     * @return integer 
     */
    public function getIdGouvernorat()
    {
        return $this->idGouvernorat;
    }

    /**
     * Set idDelegation
     *
     * @param integer $idDelegation
     * @return Annonce
     */
    public function setIdDelegation($idDelegation)
    {
        $this->idDelegation = $idDelegation;
    
        return $this;
    }

    /**
     * Get idDelegation
     *
     * @return integer 
     */
    public function getIdDelegation()
    {
        return $this->idDelegation;
    }

    /**
     * Set idLocalite
     *
     * @param integer $idLocalite
     * @return Annonce
     */
    public function setIdLocalite($idLocalite)
    {
        $this->idLocalite = $idLocalite;
    
        return $this;
    }

    /**
     * Get idLocalite
     *
     * @return integer 
     */
    public function getIdLocalite()
    {
        return $this->idLocalite;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return Annonce
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set lng
     *
     * @param integer $lng
     * @return Annonce
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return integer
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set lat
     *
     * @param integer $lat
     * @return Annonce
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lng
     *
     * @return integer
     */
    public function getLat()
    {
        return $this->lat;
    }

    public function setLatLng($latlng)
    {
        $this->setLat($latlng['lat']);
        $this->setLng($latlng['lng']);
        return $this;
    }

    /**
     * @Assert\NotBlank()
     * @OhAssert\LatLng()
     */
    public function getLatLng()
    {
        return array('lat'=>$this->getLat(),'lng'=>$this->getLng());
    }

    public function getCreated()
    {
        return $this->created;
    }
    public function setCreated($time)
    {
        $this->created = $time;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($time)
    {
        $this->updated = $time;
    }

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getPhotos()
    {
        return $this->photos;
    }
}