<?php

include_once('global.php');

class Cliente extends Pessoa
{
    private $cpf;
    private $rg;
    private $pacientes;

    public function __construct(string $nome, string $email, string $telefone, string $cpf, string $rg, array $_pacientes)
    {
        parent::__construct($nome, $email, $telefone);
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->pacientes = $_pacientes;
        $this->save();
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getRg(): string
    {
        return $this->rg;
    }

    public function getPacientes(): array
    {
        return $this->pacientes;
    }

    public function addPaciente(Paciente $paciente)
    {
        $this->pacientes[] = $paciente;
    }
}
