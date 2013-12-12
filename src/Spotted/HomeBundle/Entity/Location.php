<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="Location")
 * @ORM\Entity
 */
class Location
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var \Spotted\HomeBundle\Entity\Ort
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\Ort")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ort_ID", referencedColumnName="ID")
     * })
     */
    private $ort;



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
     * @return Location
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
     * Set ort
     *
     * @param \Spotted\HomeBundle\Entity\Ort $ort
     * @return Location
     */
    public function setOrt(\Spotted\HomeBundle\Entity\Ort $ort = null)
    {
        $this->ort = $ort;
    
        return $this;
    }

    /**
     * Get ort
     *
     * @return \Spotted\HomeBundle\Entity\Ort 
     */
    public function getOrt()
    {
        return $this->ort;
    }
    /**
     * @var integer
     */
    private $ortId;


    /**
     * Set ortId
     *
     * @param integer $ortId
     * @return Location
     */
    public function setOrtId($ortId)
    {
        $this->ortId = $ortId;
    
        return $this;
    }

    /**
     * Get ortId
     *
     * @return integer 
     */
    public function getOrtId()
    {
        return $this->ortId;
    }
}