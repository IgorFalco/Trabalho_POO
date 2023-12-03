<?php

include_once('./global.php');

class ConsultaAvaliacao{
    protected $paciente;
    protected $descricao;
    protected $valorConsulta;
    protected $especialidades = [];
    protected $Data_Horario;
    protected $duracao_min = 30;


    public function __construct(Paciente $_paciente, string $_descricao, float $_valorConsulta, $_especialidades, DateTime $data_horario_)
    {
        $this->paciente = $_paciente;
        $this->descricao = $_descricao;
        $this->valorConsulta = $_valorConsulta;
        $this->especialidades = $_especialidades;
        $this->Data_Horario = $data_horario_;
        

    }

    //sets e gets
    public function getPaciente(){
        return $this->paciente;
    }

    public function setPaciente(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao(string $descricao_){
        $this->descricao = $descricao_;
    }

    public function getValorConsulta(){
        return $this->valorConsulta;
    }

    public function setValorConsulta(float $valorConsulta_){
        $this->valorConsulta = $valorConsulta_;
    }

    public function getEspecialidades(){
        return $this->especialidades;
    }

    public function setEspecialidades(array $especialidades_){
        $this->especialidades = $especialidades_;
    }

    public function getData_Horario(): DateTime{
        return $this->Data_Horario;
    }

    public function setData_Horario(DateTime $data_horario_){
        $this->Data_Horario = $data_horario_;
    }

    public function getDuracao(){
        return $this->duracao_min;
    }

    public function gerarOrcamento(int $id, Dentista $dentista_exec, DateTime $data_orcamento, $procedimentos_realizados)
    {
        $orcamento = new Orcamento($id, $this->paciente, $dentista_exec, $data_orcamento, $procedimentos_realizados);
        return $orcamento;
    }
}
