<?php

namespace Immobilier\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//use Immobilier\ManagerBundle\Entity\Gouvernorat;


/**
 * Delegation
 *
 * @ORM\Table(name="delegation")
 * @ORM\Entity
 */
class Delegation
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
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_gouvernorat", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Gouvernorat")
     * @ORM\JoinColumn(name="id_gouvernorat", referencedColumnName="id")
     *
     *
     */
    private $idGouvernorat;


    public function __toString()
    {
        return (string) $this->getId();
    }


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
     * Set name
     *
     * @param string $name
     * @return Delegation
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set idGouvernorat
     *
     * @param integer $idGouvernorat
     * @return Delegation
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
}