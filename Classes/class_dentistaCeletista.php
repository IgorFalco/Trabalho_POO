<?php

include_once('./global.php');

class DentistaCeletista extends Dentista
{

  protected $salario;

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $cro, string $especialidade, float $salario, string $logradouro, string $numero, string $bairro, string $cidade, string $estado)
  {
    parent::__construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $logradouro, $numero, $bairro, $cidade, $estado);
    $this->salario = $salario;
  }

  public function getSalario()
  {
    return $this->salario;
  }

  public function setSalario($novo_salario)
  {
    $this->salario = $novo_salario;
  }
}
