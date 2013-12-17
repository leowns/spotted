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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=45, nullable=true)
     */
    private $street;

    /**
     * @var \Spotted\HomeBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="City_ID", referencedColumnName="ID")
     * })
     */
    private $city;



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
     * Set street
     *
     * @param string $street
     * @return Location
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param \Spotted\HomeBundle\Entity\City $city
     * @return Location
     */
    public function setCity(\Spotted\HomeBundle\Entity\City $city = null)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return \Spotted\HomeBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
}