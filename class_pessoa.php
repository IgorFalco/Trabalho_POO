<?php
include_once('./global.php');

class Pessoa {
  protected $nome;
  protected $email;
  protected $telefone;

  public function __construct($nome, $email, $telefone){
    $this -> nome = $nome;
    $this -> email = $email;
    $this -> telefone = $telefone;
  }
}
?>