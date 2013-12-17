<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posttags
 *
 * @ORM\Table(name="PostTags")
 * @ORM\Entity
 */
class Posttags
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
     * @var \Spotted\HomeBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="Spotted\HomeBundle\Entity\Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Post_ID", referencedColumnName="ID")
     * })
     */
    private $post;

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
     * Set post
     *
     * @param \Spotted\HomeBundle\Entity\Post $post
     * @return Posttags
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
     * Set tags
     *
     * @param \Spotted\HomeBundle\Entity\Tags $tags
     * @return Posttags
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