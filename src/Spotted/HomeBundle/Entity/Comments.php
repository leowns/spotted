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
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime", nullable=true)
     */
    private $datum;

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
     * Set datum
     *
     * @param \DateTime $datum
     * @return Comments
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    
        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime 
     */
    public function getDatum()
    {
        return $this->datum;
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
     * @var string
     */
    private $notread;

    /**
     * @var \Spotted\HomeBundle\Entity\Post
     */
    private $post1;


    /**
     * Set notread
     *
     * @param string $notread
     * @return Comments
     */
    public function setNotread($notread)
    {
        $this->notread = $notread;
    
        return $this;
    }

    /**
     * Get notread
     *
     * @return string 
     */
    public function getNotread()
    {
        return $this->notread;
    }

    /**
     * Set post1
     *
     * @param \Spotted\HomeBundle\Entity\Post $post1
     * @return Comments
     */
    public function setPost1(\Spotted\HomeBundle\Entity\Post $post1 = null)
    {
        $this->post1 = $post1;
    
        return $this;
    }

    /**
     * Get post1
     *
     * @return \Spotted\HomeBundle\Entity\Post 
     */
    public function getPost1()
    {
        return $this->post1;
    }
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $read;


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
}