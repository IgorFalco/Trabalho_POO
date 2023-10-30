<?php

include_once('global.php');

class Dentista extends Pessoa
{
  protected $cpf;
  protected $cro;
  protected $especialidade = [];
  protected $endereco = [];

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $cro, Especialidades $especialidade, string $logradouro, string $numero, string $bairro, string $cidade, string $estado)
  {
    parent::__construct($nome, $email, $telefone);
    $this->endereco = [
      'logradouro' => $logradouro,
      'numero' => $numero,
      'bairro' => $bairro,
      'cidade' => $cidade,
      'estado' => $estado
    ];
    $this->cpf = $cpf;
    $this->cro = $cro;
    $this->especialidade = $especialidade;
  }

  public function getCPF(): string
  {
    return $this->cpf;
  }

  public function getCRO(): string
  {
    return $this->cro;
  }

  public function getEspec(): array
  {
    return $this->especialidade->getEspec();
  }

  public function getEndereco(): array
  {
    return $this->endereco;
  }

  public function setCPF(string $novo_cpf)
  {
    $this->cpf = $novo_cpf;
  }

  public function setCRO(string $novo_cro)
  {
    $this->cro = $novo_cro;
  }

  public function setEspec(Especialidades $nova_espec)
  {
    $this->especialidade = $nova_espec;
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
}
