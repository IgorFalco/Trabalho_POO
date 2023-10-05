<?php

include_once('./global.php');

class Pessoa extends persist{
  protected $nome;
  protected $email;
  protected $telefone;

  public function __construct(string $nome, string $email, string $telefone){
    parent::__construct();
    $this -> nome = $nome;
    $this -> email = $email;
    $this -> telefone = $telefone;
  }
}
?>