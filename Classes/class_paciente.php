<?php
include_once('./class_pessoa.php');
include_once('./global.php');

class Paciente extends Pessoa
{
  private $data_nascimento;
  private $rg;

  public function __construct(string $nome, string $email, string $telefone, DateTime $data_nascimento, string $rg)
  {
    parent::__construct($nome, $email, $telefone);
    $this->data_nascimento = $data_nascimento;
    $this->rg = $rg;
  }

  public function getDataNascimento(): DateTime
  {
    return $this->data_nascimento;
  }

  public function getrg(): string
  {
    return $this->rg;
  }

  public function setDataNascimento(DateTime $nova_data)
  {
    $this->data_nascimento = $nova_data;
  }

  public function setrg(string $novo_rg)
  {
    $this->rg = $novo_rg;
  }
}
