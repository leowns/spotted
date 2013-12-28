<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="Comments")
 * @ORM\Entity
 */
class Comments
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
     * @ORM\Column(name="read", type="blob", nullable=false)
     */
    private $read;

    /**
     * @var \Spotted\HomeBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Post_ID", referencedColumnName="ID")
     * })
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
     * Set text
     *
     * @param string $text
     * @return Comments
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
     * @return Comments
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
     * Set read
     *
     * @param string $read
     * @return Comments
     */
    public function setRead($read)
    {
        $this->read = $read;
    
        return $this;
    }

    /**
     * Get read
     *
     * @return string 
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set post
     *
     * @param \Spotted\HomeBundle\Entity\Post $post
     * @return Comments
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
    /**
     * @var \Spotted\HomeBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Spotted\HomeBundle\Entity\User $user
     * @return Comments
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