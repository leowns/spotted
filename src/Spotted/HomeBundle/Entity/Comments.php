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
}