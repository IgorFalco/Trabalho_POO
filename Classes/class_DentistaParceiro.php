<?php

include_once('./global.php');

class DentistaParceiro extends Dentista
{

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $cro, Especialidades $especialidade, float $porcentagem_, string $logradouro, string $numero, string $bairro, string $cidade, string $estado)
  {
    parent::__construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $porcentagem_, $logradouro, $numero, $bairro, $cidade, $estado);
  }

}
