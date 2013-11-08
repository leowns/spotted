<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    private $geschlecht;



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
     * Set geschlecht
     *
     * @param string $geschlecht
     * @return User
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

}