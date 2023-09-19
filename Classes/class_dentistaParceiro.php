<?php

  include_once ('class_pessoa.php');
  include_once ('class_dentista.php');

  class DentistaParceiro extends Dentista {
    
    protected $comissao;
    protected $percComissao;

    public function __construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $percComissao, $logradouro, $numero, $bairro, $cidade, $estado){
      parent::__construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $logradouro, $numero, $bairro, $cidade, $estado);
      $this->percComissao = $percComissao;
    }

    public function getComissao(){
      return $this -> comissao;
    }

    public function getPercComissao(){
      return $this -> percComissao;
    }

    public function addComissao($nova_comissao){
      $this->comissao += $this->percComissao * $nova_comissao;
    }

    public function resetComissao(){
      $this->comissao = 0;
    }
  }
?>