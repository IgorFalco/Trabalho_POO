<?php

include_once('global.php');

class Agenda extends persist
{
    private $dentista;
    private $agendaPadrao = [];
    private $agendaMensal = [];

    public function __construct(Dentista $dentista)
    {
        $this->dentista = $dentista;
    }

    public function abrirAgendaPadrao(DateTime $dataInicio, DateTime $dataFim, array $horarios)
    {

        $intervalo = new DateInterval('P1D');
        $periodo = new DatePeriod($dataInicio, $intervalo, $dataFim->modify('+1 day'));

        foreach ($periodo as $data) {
            $dataFormatada = $data->format('Y-m-d');

            foreach ($horarios as $horario) {
                $chave = $dataFormatada . ' ' . $horario;
                $this->agendaPadrao[$chave] = $horario;
            }
        }
    }

    public function fecharAgendaPadrao(DateTime $dataInicio, DateTime $dataFim)
    {
        $intervalo = new DateInterval('P1D');
        $periodo = new DatePeriod($dataInicio, $intervalo, $dataFim->modify('+1 day'));

        foreach ($periodo as $data) {
            $dataFormatada = $data->format('Y-m-d');

            foreach ($this->agendaPadrao as $chave => $horario) {
                // Verificar se a chave contém a data específica
                if (strpos($chave, $dataFormatada) !== false) {
                    unset($this->agendaPadrao[$chave]);
                }
            }
        }
    }

    public function agendarConsulta(DateTime $dia, string $horario)
    {

        if ($this->verificaDisponibilidade($dia, $horario)) {
            $dataFormatada = $dia->format('Y-m-d');
            unset($this->agendaPadrao[$dataFormatada . ' ' . $horario]);
            $this->agendaMensal[$dataFormatada . ' ' . $horario] = "Marcado";
        } else {
            echo "Data indisponível!";
        }
    }

    public function verificaDisponibilidade(DateTime $inicio, string $horario): bool
    {
        $disponivel = false;
        $dataFormatada = $inicio->format('Y-m-d');

        if (isset($this->agendaMensal[$dataFormatada . ' ' . $horario])) {
            $disponivel = false;
        } elseif (isset($this->agendaPadrao[$dataFormatada . ' ' . $horario])) {
            $disponivel = true;
        } else {
            $disponivel = false;
        }
        return $disponivel;
    }

    public function getAgendaPadrao()
    {
        return $this->agendaPadrao;
    }

    public function getAgendaMensal()
    {
        return $this->agendaMensal;
    }

    public function getDentista()
    {
        return $this->dentista;
    }


    public static function getFilename()
    {
        return "Agenda.txt"; // Substitua com o nome desejado do arquivo de dados
    }
}
