<?php

include_once('./global.php');
class Paciente extends Pessoa
{
  protected $data_nascimento;
  protected $rg;
  protected $id;
  protected $responsavel;
  protected $orcamentos = [];

  public function __construct(string $nome, string $email, string $telefone, DateTime $data_nascimento, string $rg, int $id_ ,Cliente $responsavel_)
  {
    parent::__construct($nome, $email, $telefone);
    $this->data_nascimento = $data_nascimento;
    $this->rg = $rg;
    $this->id = $id_;
    $this->responsavel = $responsavel_;
  }

  public function getDataNascimento(): DateTime
  {
    return $this->data_nascimento;
  }

  public function getrg(): string
  {
    return $this->rg;
  }

  public function getResponsavel(): int
  {
    return $this->responsavel;
  }

  public function getID(){
    return $this->id;
  }

  public function setID(int $id_){
    $this->id = $id_;
  }

  public function setDataNascimento(DateTime $nova_data)
  {
    $this->data_nascimento = $nova_data;
  }

  public function setrg(string $novo_rg)
  {
    $this->rg = $novo_rg;
  }

  public function setResponsavel(Cliente $responsavel_){
    $this->responsavel = $responsavel_;
  }

  public function addOrcamento(Orcamento $orcamento_){
    array_push($this->orcamento, $orcamento_);
  }
}
