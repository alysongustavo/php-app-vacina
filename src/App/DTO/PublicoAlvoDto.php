<?php 

declare(strict_types=1);

namespace App\DTO;

use JMS\Serializer\Annotation\Type;
use App\Entity\BaseEntityInterface;

class PublicoAlvoDto implements BaseEntityInterface{

    /**
     * @var int
     * @Type("int")
     */
    private $id;

   /**
     * @var string
     * @Type("string")
     */
    private $titulo;

     /**
     * @var string
     * @Type("string")
     */
    private $descricao;

     /**
     * @var boolean
     * @Type("boolean")
     */
    private $status;

    /**
     * @var int
     * @Type("int")
     */
    private $campanhaId;

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of titulo
     *
     * @return  string
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @param  string  $titulo
     *
     * @return  self
     */ 
    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of descricao
     *
     * @return  string
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @param  string  $descricao
     *
     * @return  self
     */ 
    public function setDescricao(string $descricao)
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
     * Get the value of campanhaId
     *
     * @return  int
     */ 
    public function getCampanhaId()
    {
        return $this->campanhaId;
    }

    /**
     * Set the value of campanhaId
     *
     * @param  int  $campanhaId
     *
     * @return  self
     */ 
    public function setCampanhaId(int $campanhaId)
    {
        $this->campanhaId = $campanhaId;

        return $this;
    }
}