<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $geschlecht;

    /**
     * @var \Spotted\HomeBundle\Entity\Location
     */
    private $location;

    /**
     * @var \Spotted\HomeBundle\Entity\Tags
     */
    private $tags;

    /**
     * @var \Spotted\HomeBundle\Entity\User
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
     * Set geschlecht
     *
     * @param string $geschlecht
     * @return Post
     */
    public function setGeschlecht($geschlecht)
    {
        $this->geschlecht = $geschlecht;
    
        return $this;
    }

    /**
     * Get geschlecht
     *
     * @return string 
     */
    public function getGeschlecht()
    {
        return $this->geschlecht;
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
}
