<?php
  include_once('./class_pessoa.php');
  include_once('./global.php');

  class Paciente extends Pessoa {
  protected $data_nascimento;
  protected $rg;

  public function __construct($nome, $email, $telefone,         
                              $data_nascimento, $rg){
    parent::__construct($nome, $email, $telefone);
    $this -> data_nascimento = $data_nascimento;
    $this -> rg = $rg;    
  }

  public function getDataNascimento(){
    return $this->data_nascimento;
  }

  public function getrg(){
    return $this->rg;
  }

  public function setDataNascimento($nova_data){
    this->data_nascimento = $nova_data;
  }

  public function setrg($novo_rg){
    this->rg = $novo_rg;
  }
}
?>