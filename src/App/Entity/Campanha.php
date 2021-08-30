<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Campanha
 *
 * @ORM\Table(name="campanha")
 * @ORM\Entity(repositoryClass="App\Repository\CampanhaRepository")
 */
class Campanha implements BaseEntityInterface
{
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
     * @NotBlank(groups={"insert", "update"}, message="O campo titulo é obrigatório!")
     * 
     */
    private $titulo;

    /**
     * @var string
     * @Type("string")
     * 
     * @ORM\Column(name="descricao", type="text", length=65535, nullable=false)
     * @NotBlank(groups={"insert", "update"}, message="O campo descricao é obrigatório!")
     */
    private $descricao;

    /**
     * @var \Datetime
     * @Type("DateTime<'Y-m-d'>")
     * @ORM\Column(name="dataIni", type="date", nullable=false)
     */
    private $dataIni;

    /**
     * @var \Datetime|null
     * @Type("DateTime<'Y-m-d'>")
     *
     * @ORM\Column(name="dataFim", type="date", nullable=true)
     */
    private $dataFim;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDataIni($dataIni){
        $this->dataIni = $dataIni;
    }

    public function getDataIni(){
        return $this->dataIni;
    }

    public function setDataFim($dataFim){
        $this->dataFim = $dataFim;
    }

    public function getDataFim(){
        return $this->dataFim;
    }


}
