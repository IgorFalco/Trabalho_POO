<?php

include_once('global.php');

class ConsultaAvaliacao{
    public $paciente;
    public $descricao;
    public $valorConsulta;
    public $especialidades = [];
    public $orcamento;

    private $data;
    private $horario;
    private $duracao;
    private $dentistaAvaliador;

    public function __construct(Paciente $_paciente, string $_descricao, float $_valorConsulta, Especialidades $_especialidades, DateTime $_data, DateTime $_horario, Dentista $_dentistaAvaliador)
    {
        $this->paciente = $_paciente;
        $this->descricao = $_descricao;
        $this->valorConsulta = $_valorConsulta;
        $this->especialidades = $_especialidades;

        $this->data = $_data;
        $this->horario = $_horario;
        $this->duracao = "30 minutos";
        $this->dentistaAvaliador = $_dentistaAvaliador;

    }

    public function gerarOrcamento(Orcamento $_orcamento)
    {
        $this->orcamento = $_orcamento;
    }
}
