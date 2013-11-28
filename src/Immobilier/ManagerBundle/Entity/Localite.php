<?php

namespace Immobilier\ManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localite
 *
 * @ORM\Table(name="localite")
 * @ORM\Entity
 */
class Localite
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
     * @ORM\Column(name="delegation_id", type="integer", nullable=false)
     * @ManyToOne(targetEntity="Delegation")
     * @JoinColumn(name="delegation_id", referencedColumnName="name")
     */
    private $delegationId;
    private $delegation;


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
     * @return Localite
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
     * Set delegationId
     *
     * @param integer $delegationId
     * @return Localite
     */
    public function setDelegationId($delegationId)
    {
        $this->delegationId = $delegationId;
    
        return $this;
    }

    /**
     * Get delegationId
     *
     * @return integer 
     */
    public function getDelegationId()
    {
        return $this->delegationId;
    }
}