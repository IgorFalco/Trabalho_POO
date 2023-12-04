<?php

include_once('global.php');

class ConsultaAvaliacao extends persist
{
    private $paciente;
    private $dentistaAvaliador;
    private $valorConsulta;
    private $Data_Horario;
    private $duracao_min;


    public function __construct(Paciente $paciente, Dentista $dentistaAvaliador, float $valorConsulta, DateTime $data_horario)
    {
        $this->paciente = $paciente;
        $this->dentistaAvaliador = $dentistaAvaliador;
        $this->valorConsulta = $valorConsulta;
        $this->Data_Horario = $data_horario;
        $this->duracao_min = clone $data_horario;
        $this->duracao_min->add(new DateInterval('PT30M'));
    }

    static public function getFilename()
    {
        return "Consultas.txt";
    }

    //sets e gets
    public function getPaciente(): Paciente
    {
        return $this->paciente;
    }

    public function getValorConsulta(): float
    {
        return $this->valorConsulta;
    }

    public function getData_Horario(): DateTime
    {
        return $this->Data_Horario;
    }

    public function getDuracao(): DateTime
    {
        return $this->duracao_min;
    }

    public function gerarOrcamento(array $procedimentos_realizados): Orcamento
    {
        $orcamento = new Orcamento($this->paciente, $this->dentistaAvaliador, $this->Data_Horario, $procedimentos_realizados);
        return $orcamento;
    }
}
