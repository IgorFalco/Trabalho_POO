<?php

include_once('global.php');

class Funcionario extends Pessoa
{
  protected $cpf;
  protected $endereco = [];
  protected $salariofixo;

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $logradouro, string $numero, string $bairro, string $cidade, string $estado, float $salariofixo)
  {
    parent::__construct($nome, $email, $telefone);
    $this->cpf = $cpf;
    $this->endereco = [
      'logradouro' => $logradouro,
      'numero' => $numero,
      'bairro' => $bairro,
      'cidade' => $cidade,
      'estado' => $estado
    ];
    $this->salariofixo = $salariofixo;
  }

  public function getCPF(): string
  {
    return $this->cpf;
  }

  public function getEndereco(): array
  {
    return $this->endereco;
  }

  public function getSalarioFix(): float
  {
    return $this->salariofixo;
  }

  public function setCPF(string $novo_cpf)
  {
    $this->cpf = $novo_cpf;
  }

  public function setEndereco(string $novo_logradouro, string $novo_numero, string $novo_bairro, string $nova_cidade, string $novo_estado)
  {
    $this->endereco = [
      'logradouro' => $novo_logradouro,
      'numero' => $novo_numero,
      'bairro' => $novo_bairro,
      'cidade' => $nova_cidade,
      'estado' => $novo_estado
    ];
  }

  public function setSalarioFixo(float $novo_salariofixo)
  {
    $this->salariofixo = $novo_salariofixo;
  }
  
}
