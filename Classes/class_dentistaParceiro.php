<?php

include_once('./global.php');

class DentistaParceiro extends Dentista
{

  protected $comissao;
  protected $percComissao;

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $cro, string $especialidade, float $percComissao, string $logradouro, string $numero, string $bairro, string $cidade, string $estado)
  {
    parent::__construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $logradouro, $numero, $bairro, $cidade, $estado);
    $this->percComissao = $percComissao;
  }

  public function getComissao(): float
  {
    return $this->comissao;
  }

  public function getPercComissao(): float
  {
    return $this->percComissao;
  }

  public function addComissao(float $nova_comissao)
  {
    $this->comissao += $this->percComissao * $nova_comissao;
  }

  public function resetComissao()
  {
    $this->comissao = 0.0;
  }
}
