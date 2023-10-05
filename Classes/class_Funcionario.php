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
}
