<?php 

namespace App\DTO;

use DateTime;
use JMS\Serializer\Annotation\Type;

class CampanhaDto {

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
     * @var Datetime
     * @Type("DateTime<'Y-m-d'>")
     */
    private $dataIni;

    /**
     * @var Datetime
     * @Type("DateTime<'Y-m-d'>")
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