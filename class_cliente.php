<?php 

include_once('./class_pessoa.php');
include_once('./global.php');

class Cliente extends Pessoa {
  protected $cpf;
  protected $rg;

  public function __construct($nome, $email, $telefone, $cpf, $rg){
    parent::__construct($nome, $email, $telefone);
    $this -> cpf = $cpf;
    $this -> rg = $rg;    
  }

  public function getcpf(){
    return $this->cpf;
  }

  public function getrg(){
    return $this->rg;
  }

  public function setcpf($cpf){
    $this->cpf = $cpf;
  }

  public function setrg($rg){
    $this->rg = $rg;
  }
}
?>