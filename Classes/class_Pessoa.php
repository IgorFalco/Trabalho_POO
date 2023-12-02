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


//gets e sets
  public function getNome(){
    return $this->nome;
  }

  public function setNome(string $Nome_){
    $this->nome = $Nome_;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setEmail(string $Email_){
    $this->email = $Email_;
  }

  public function getTelefone(){
    return $this->telefone;
  }

  public function setTeletone(string $Telefone_){
    $this->telefone = $Telefone_;
  }
}
?>