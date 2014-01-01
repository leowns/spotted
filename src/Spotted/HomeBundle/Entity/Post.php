<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="Post")
 * @ORM\Entity
 */
class Post
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
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=45, nullable=false)
     */
    private $gender;

    /**
     * @var \Spotted\HomeBundle\Entity\Location
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Location_ID", referencedColumnName="ID")
     * })
     */
    private $location;

    /**
     * @var \Spotted\HomeBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_ID", referencedColumnName="ID")
     * })
     */
    private $user;

    /**
     * @var \Spotted\HomeBundle\Entity\Tags
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\Tags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tags_ID", referencedColumnName="ID")
     * })
     */
    private $tags;
	

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
     * Set text
     *
     * @param string $text
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Post
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }


    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set location
     *
     * @param \Spotted\HomeBundle\Entity\Location $location
     * @return Post
     */
    public function setLocation(\Spotted\HomeBundle\Entity\Location $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return \Spotted\HomeBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set user
     *
     * @param \Spotted\HomeBundle\Entity\User $user
     * @return Post
     */
    public function setUser(\Spotted\HomeBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Spotted\HomeBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set tags
     *
     * @param \Spotted\HomeBundle\Entity\Tags $tags
     * @return Post
     */
    public function setTags(\Spotted\HomeBundle\Entity\Tags $tags = null)
    {
        $this->tags = $tags;
    
        return $this;
    }

    /**
     * Get tags
     *
     * @return \Spotted\HomeBundle\Entity\Tags 
     */
    public function getTags()
    {
        return $this->tags;
    }
}