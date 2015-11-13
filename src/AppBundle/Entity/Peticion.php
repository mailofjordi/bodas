<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Direccion;

/**
 * Peticion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PeticionRepository")
 */
class Peticion
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
     * @var string
     *
     * @ORM\Column(name="idSimulador", type="string", length=255)
     */
    private $idSimulador;

    /**
     * @var integer
     *
     * @ORM\Column(name="num", type="integer")
     */
    private $num;

     /**
     * @var Direccion
     *
     * @ORM\ManyToOne(targetEntity="Direccion")
     * @ORM\JoinColumn(name="id_direccion", referencedColumnName="id")
     */
    protected $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="recorrido", type="integer")
     */
    private $recorrido;

    /**
    * Constructor of this class
    *
    */
    public function __construct($idSimulador, $num, Direccion $direccion, $recorrido)
    {
        if (!is_numeric($num)) {
            throw new NumHaveToBeInteger();            
        }
        
        $this->idSimulador = $idSimulador;
        $this->num = $num;
        $this->direccion = $direccion;
        $this->recorrido = $recorrido;
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
     * Set idSimulador
     *
     * @param string $idSimulador
     *
     * @return Peticion
     */
    public function setIdSimulador($idSimulador)
    {
        $this->idSimulador = $idSimulador;

        return $this;
    }

    /**
     * Get idSimulador
     *
     * @return string
     */
    public function getIdSimulador()
    {
        return $this->idSimulador;
    }

    /**
     * Set num
     *
     * @param integer $num
     *
     * @return Peticion
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return integer
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set recorrido
     *
     * @param integer $recorrido
     *
     * @return Peticion
     */
    public function setRecorrido($recorrido)
    {
        $this->recorrido = $recorrido;

        return $this;
    }

    /**
     * Get recorrido
     *
     * @return integer
     */
    public function getRecorrido()
    {
        return $this->recorrido;
    }

    /**
     * Set direccion
     *
     * @param \AppBundle\Entity\Direccion $direccion
     *
     * @return Peticion
     */
    public function setDireccion(\AppBundle\Entity\Direccion $direccion = null)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return \AppBundle\Entity\Direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }
    
    public function __toString()
    {
        return "idSimulador: " . $this->idSimulador . " Num: " . $this->num . " Dir: " . $this->direccion . " Recorrido: " . $this->recorrido;
    }
}
