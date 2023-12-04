<?php

include_once('global.php');

class Paciente extends Pessoa
{
    private $data_nascimento;
    private $rg;
    private $idPaciente;
    private $responsavelFinanceiro;
    private $orcamentos = [];

    public function __construct(string $nome, string $email, string $telefone, DateTime $data_nascimento, string $rg, Cliente $responsavel, array $orcamentos = null)
    {
        parent::__construct($nome, $email, $telefone);
        $this->data_nascimento = $data_nascimento;
        $this->rg = $rg;
        $this->idPaciente = uniqid('', true);
        $this->responsavelFinanceiro = $responsavel;
        if ($orcamentos != null)
            $this->orcamentos = $orcamentos;
    }

    static public function getFilename()
    {
        return 'Pacientes.txt';
    }


    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    public function getResponsavel()
    {
        return $this->responsavelFinanceiro;
    }

    public function getOrcamentos()
    {
        return $this->orcamentos;
    }

    public function addOrcamento(Orcamento $orcamento_)
    {
        array_push($this->orcamentos, $orcamento_);
    }
}
