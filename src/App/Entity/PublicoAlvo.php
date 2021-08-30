<?php 

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * Campanha
 *
 * @ORM\Table(name="publico_alvo")
 * @ORM\Entity(repositoryClass="App\Repository\PublicoAlvoRepository")
 */
class PublicoAlvo implements BaseEntityInterface {

    /**
     * @var int
     * @Type("int")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

     /**
     * @var string
     * @Type("string")
     * 
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     * @Type("string")
     * 
     * @ORM\Column(name="descricao", type="text", length=65535, nullable=false)
     */
    private $descricao;

    /**
     * @var boolean
     * @Type("boolean")
     * 
     * @ORM\Column(name="status", type="boolean", length=1, nullable=false)
     */
    private $status;

    /**
     * @var Campanha
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Campanha")
     * @ORM\JoinColumn(name="campanha_id", referencedColumnName="id")
     */
    private $campanha;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of campanha
     */ 
    public function getCampanha()
    {
        return $this->campanha;
    }

    /**
     * Set the value of campanha
     *
     * @return  self
     */ 
    public function setCampanha($campanha)
    {
        $this->campanha = $campanha;

        return $this;
    }


}