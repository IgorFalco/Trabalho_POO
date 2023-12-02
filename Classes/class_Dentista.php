<?php

include_once('./global.php');

class Dentista extends Pessoa
{
  protected $cpf;
  protected $cro;
  protected $especialidade = [];
  protected $endereco = [];
  protected $procedimentos_realizados = [];

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $cro, Especialidades $especialidade_, float $porcentagem, string $logradouro, string $numero, string $bairro, string $cidade, string $estado)
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
    $this->especialidade[$especialidade_->getEspec()] = $porcentagem;
  }





  //gets e sets
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

  public function addEspec(Especialidades $nova_espec, float $porcentagem)
  {
    $this->especialidade[$nova_espec->getEspec()] = $porcentagem;
  }

  public function deletEspec(Especialidades $espec_){
    unset($this->especialidade[$espec_->getEspec()]);
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

  public function addProcedimento(ExecucaoDoProcedimento $execproc){
    array_push($this->procedimentos_realizados, $execproc);
  }

  public function clearProcedimento(ExecucaoDoProcedimento $execproc){
    $this->procedimentos_realizados = [];
  }
}
