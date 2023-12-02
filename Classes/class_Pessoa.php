<?php

include_once('./global.php');

class Pessoa extends persist{
  protected $nome;
  protected $email;
  protected $telefone;

  public function __construct(string $nome, string $email, string $telefone){
    $this -> nome = $nome;
    $this -> email = $email;
    $this -> telefone = $telefone;
  }

  static public function getFilename()
    {
        return "Pessoa.txt";
    }
}
?>