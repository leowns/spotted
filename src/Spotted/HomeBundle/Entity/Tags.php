<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table(name="Tags")
 * @ORM\Entity
 */
class Tags
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
     * @ORM\Column(name="Bezeichnung", type="string", length=45, nullable=true)
     */
    private $bezeichnung;
	/**
     * @var string
     *
     * @ORM\Column(name="iconclass", type="string", length=45,nullable=true)
     */
	private $iconclass;



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
     * Set id
     *
     * @return Tags 
     */
	 public function setId($id) {
	 
		 $this->id= $id;
		 return $this;
	 
	 }
	

    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     * @return Tags
     */
    public function setBezeichnung($bezeichnung)
    {
        $this->bezeichnung = $bezeichnung;
    
        return $this;
    }

    /**
     * Get bezeichnung
     *
     * @return string 
     */
    public function getBezeichnung()
    {
        return $this->bezeichnung;
    }
	/**
     * Set iconclass
     *
     * @param string $iconclass
     * @return Tags
     */
    public function setIconclass($iconclass)
    {
        $this->iconclass = $iconclass;
    
        return $this;
    }

    /**
     * Get iconclass
     *
     * @return string 
     */
    public function getIconclass()
    {
        return $this->iconclass;
    }
    /**
     * @var \Spotted\HomeBundle\Entity\Post
     */
    private $post;


    /**
     * Set post
     *
     * @param \Spotted\HomeBundle\Entity\Post $post
     * @return Tags
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