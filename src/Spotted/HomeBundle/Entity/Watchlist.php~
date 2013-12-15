<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Watchlist
 */
class Watchlist
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Spotted\HomeBundle\Entity\User
     */
    private $user;

    /**
     * @var \Spotted\HomeBundle\Entity\Post
     */
    private $post;


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
     * Set user
     *
     * @param \Spotted\HomeBundle\Entity\User $user
     * @return Watchlist
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
     * Set post
     *
     * @param \Spotted\HomeBundle\Entity\Post $post
     * @return Watchlist
     */
    public function setPost(\Spotted\HomeBundle\Entity\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \Spotted\HomeBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}