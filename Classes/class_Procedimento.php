<?php

include_once('./global.php');

class Procedimento extends persist{

    protected $nome_proced;
    protected $descricao_proced;
    protected $valor_proced;

    public function _construct(string $nome_proced, string $descricao_proced, int $valor_proced){
        parent::__construct();
        $this->nome_proced = $nome_proced;
        $this->descricao_proced = $descricao_proced;
        $this->valor_proced = $valor_proced;
    }



    //getters
    public function getNomeProced(){
        return $this->nome_proced;
    }

    public function getDescricaoProced(){
        return $this->descricao_proced;
    }

    public function getValorProced(){
        return $this->valor_proced;
    }



    //setters
    public function setNomeProced($nome_proced){
        $this->nome_proced = $nome_proced;
    }

    public function setDescricaoProced($descricao_proced){
        $this->descricao_proced = $descricao_proced;
    }

    public function setValorProced($valor_proced){
        $this->valor_proced = $valor_proced;
    }


}
