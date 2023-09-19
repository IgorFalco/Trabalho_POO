<?php

  include_once ('class_pessoa.php');
  include_once ('class_dentista.php');

  class DentistaCeletista extends Dentista {
    
    protected $salario;

    public function __construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $salario, $logradouro, $numero, $bairro, $cidade, $estado){
      parent::__construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $logradouro, $numero, $bairro, $cidade, $estado);
      $this->salario = $salario;
    }

    public function getSalario(){
      return $this -> salario;
    }

    public function setSalario($novo_salario){
      $this->salario = $novo_salario;
    }
  }
?>