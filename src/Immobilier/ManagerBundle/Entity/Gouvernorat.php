<?php

namespace Immobilier\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Immobilier\ManagerBundle\Entity\Pays;

/**
 * Gouvernorat
 *
 * @ORM\Table(name="gouvernorat")
 * @ORM\Entity
 */
class Gouvernorat
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pays", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="gouvernorats")
     * @ORM\JoinColumn(name="id_pays", referencedColumnName="id")
     *
     * @Assert\Type(type="Immobilier\ManagerBundle\Entity\Pays")
     */
    private $idPays;


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
     * @return Gouvernorat
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
     * Set idPays
     *
     * @param integer $idPays
     * @return Gouvernorat
     */
    public function setIdPays(Pays $Pays = null)
    {
        $this->idPays = $Pays;
    }

    /**
     * Get idPays
     *
     * @return integer 
     */
    public function getIdPays()
    {
        return $this->idPays;
    }
}