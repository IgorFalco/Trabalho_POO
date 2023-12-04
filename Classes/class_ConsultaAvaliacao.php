<?php

include_once('global.php');

class ConsultaAvaliacao extends persist
{
    private $paciente;
    private $dentistaAvaliador;
    private $valorConsulta;
    private $Data;
    private $Horario;
    private $duracao_min;


    public function __construct(Paciente $paciente, Dentista $dentistaAvaliador, float $valorConsulta, DateTime $data_horario, string $Horario)
    {
        $this->paciente = $paciente;
        $this->dentistaAvaliador = $dentistaAvaliador;
        $this->valorConsulta = $valorConsulta;
        $this->Data = $data_horario;
        $this->Horario = $Horario;
        $this->duracao_min = clone $data_horario;
        $this->duracao_min->add(new DateInterval('PT30M'));
        $this->save();
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

    public function getData(): DateTime
    {
        return $this->Data;
    }
    public function getHorario(): string
    {
        return $this->Horario;
    }

    public function getDuracao(): DateTime
    {
        return $this->duracao_min;
    }

    public function gerarOrcamento(array $procedimentos_realizados): Orcamento
    {
        $orcamento = new Orcamento($this->paciente, $this->dentistaAvaliador, $this->Data, $procedimentos_realizados);
        return $orcamento;
    }
}
