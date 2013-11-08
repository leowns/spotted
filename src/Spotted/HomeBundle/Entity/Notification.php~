<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="Notification")
 * @ORM\Entity
 */
class Notification
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="read", type="boolean", nullable=true)
     */
    private $read;

    /**
     * @var \Spotted\HomeBundle\Entity\Comments
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\Comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Comments_ID", referencedColumnName="ID")
     * })
     */
    private $comments;



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
     * Set date
     *
     * @param \DateTime $date
     * @return Notification
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
     * @param boolean $read
     * @return Notification
     */
    public function setRead($read)
    {
        $this->read = $read;
    
        return $this;
    }

    /**
     * Get read
     *
     * @return boolean 
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set comments
     *
     * @param \Spotted\HomeBundle\Entity\Comments $comments
     * @return Notification
     */
    public function setComments(\Spotted\HomeBundle\Entity\Comments $comments = null)
    {
        $this->comments = $comments;
    
        return $this;
    }

    /**
     * Get comments
     *
     * @return \Spotted\HomeBundle\Entity\Comments 
     */
    public function getComments()
    {
        return $this->comments;
    }
}