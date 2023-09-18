<?php

  include_once("global.php");
  include_once('./class_funcionario.php');

  class Dentista extends Funcionario{

    private $especialidade = [];
    private $CRO;

    public function __construct($nome, $email, $telefone, $cpf, $logradouro, $numero, $bairro, $cidade, $estado, $salariofixo, $especialidade, $CRO){
      parent::__construct($nome, $email, $telefone, $cpf, $logradouro, $numero, $bairro, $cidade, $estado, $salariofixo);
      $this -> especialidade = $especialidade;
      $this -> CRO = $CRO;
    }
  }
?>