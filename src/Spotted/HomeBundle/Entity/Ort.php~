<?php

namespace Spotted\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ort
 *
 * @ORM\Table(name="Ort")
 * @ORM\Entity
 */
class Ort
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set bezeichnung
     *
     * @param string $bezeichnung
     * @return Ort
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
}