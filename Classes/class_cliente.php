<?php

include_once('./class_pessoa.php');
include_once('./global.php');

class Cliente extends Pessoa
{
  private $cpf;
  private $rg;

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $rg)
  {
    parent::__construct($nome, $email, $telefone);
    $this->cpf = $cpf;
    $this->rg = $rg;
  }

  public function getcpf(): string
  {
    return $this->cpf;
  }

  public function getrg(): string
  {
    return $this->rg;
  }

  public function setcpf(string $cpf)
  {
    $this->cpf = $cpf;
  }

  public function setrg(string $rg)
  {
    $this->rg = $rg;
  }
}
