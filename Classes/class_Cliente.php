<?php

include_once('global.php');

class Cliente extends Pessoa
{
  private $cpf;
  private $rg;
  private $pacientes = [];

  public function __construct(string $nome, string $email, string $telefone, string $cpf, string $rg, array $_pacientes)
  {
    parent::__construct($nome, $email, $telefone);
    $this->cpf = $cpf;
    $this->rg = $rg;
    foreach ($_pacientes as $item) {
      $this->pacientes[] = $item;
    }
  }

  public function getcpf(): string
  {
    return $this->cpf;
  }

  public function getrg(): string
  {
    return $this->rg;
  }

  public function getPacientes(): array
  {
    return $this->pacientes;
  }

  public function setcpf(string $cpf)
  {
    $this->cpf = $cpf;
  }

  public function setrg(string $rg)
  {
    $this->rg = $rg;
  }

  public function AddPaciente(Paciente $_novoPaciente)
  {
    $this->pacientes[] = $_novoPaciente;
  }

  public function ExcluirPacientePeloID(int $idPaciente)
  {
    foreach ($this->pacientes as $indice => $paciente) {
      if ($paciente->getID() === $idPaciente) {
        unset($this->pacientes[$indice]);
        break;
      }
    }
  }
}
