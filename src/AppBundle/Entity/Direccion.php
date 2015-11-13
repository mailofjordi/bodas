<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Direccion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DireccionRepository")
 */
class Direccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="norte", type="integer")
     */
    private $norte;

    /**
     * @var integer
     *
     * @ORM\Column(name="sur", type="integer")
     */
    private $sur;

    /**
     * @var integer
     *
     * @ORM\Column(name="este", type="integer")
     */
    private $este;

    /**
     * @var integer
     *
     * @ORM\Column(name="oeste", type="integer")
     */
    private $oeste;

    /**
    * Constructor of this class
    *
    */
    public function __construct($norte, $sur, $este, $oeste)
    {
        $this->norte = $norte;
        $this->sur = $sur;
        $this->este = $este;
        $this->oeste = $oeste;
    }

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
     * Set norte
     *
     * @param integer $norte
     *
     * @return Direccion
     */
    public function setNorte($norte)
    {
        $this->norte = $norte;

        return $this;
    }

    /**
     * Get norte
     *
     * @return integer
     */
    public function getNorte()
    {
        return $this->norte;
    }

    /**
     * Set sur
     *
     * @param integer $sur
     *
     * @return Direccion
     */
    public function setSur($sur)
    {
        $this->sur = $sur;

        return $this;
    }

    /**
     * Get sur
     *
     * @return integer
     */
    public function getSur()
    {
        return $this->sur;
    }

    /**
     * Set este
     *
     * @param integer $este
     *
     * @return Direccion
     */
    public function setEste($este)
    {
        $this->este = $este;

        return $this;
    }

    /**
     * Get este
     *
     * @return integer
     */
    public function getEste()
    {
        return $this->este;
    }

    /**
     * Set oeste
     *
     * @param integer $oeste
     *
     * @return Direccion
     */
    public function setOeste($oeste)
    {
        $this->oeste = $oeste;

        return $this;
    }

    /**
     * Get oeste
     *
     * @return integer
     */
    public function getOeste()
    {
        return $this->oeste;
    }
    
    public function __toString()
    {
        return " N: " . $this->norte . " S: " . $this->sur . " E: " . $this->este . " O: " . $this->oeste;
    }
}
