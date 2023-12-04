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
        $this->save();
    }

    public function abrirAgendaPadrao(DateTime $dataInicio, DateTime $dataFim, array $horarios, array $dias = null)
    {
        $traducaoDias = array(
            'Monday'    => 'Segunda-feira',
            'Tuesday'   => 'Terça-feira',
            'Wednesday' => 'Quarta-feira',
            'Thursday'  => 'Quinta-feira',
            'Friday'    => 'Sexta-feira',
            'Sunday'  => 'Sábado',
            'Saturday'    => 'Domingo',
        );

        $intervalo = new DateInterval('P1D');
        $periodo = new DatePeriod($dataInicio, $intervalo, $dataFim->modify('+1 day'));

        $indiceDia = 0; // Índice para controlar o array de dias

        foreach ($periodo as $data) {
            $dataFormatada = $data->format('Y-m-d');
            $dataDia = $data->format('l');
            $diaTraduzido = $traducaoDias[$dataDia];

            // Verifica se há dias específicos fornecidos
            if ($dias === null || in_array($diaTraduzido, $dias)) {
                $horariosDia = $horarios[$indiceDia % count($horarios)]; // Obtém os horários para o dia atual

                foreach ($horariosDia as $horario) {
                    $chave = $dataFormatada . ' ' . $horario;
                    $this->agendaPadrao[$chave] = $horario;
                }

                $indiceDia++; // Incrementa o índice para o próximo dia
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

    public function agendarConsulta(ConsultaAvaliacao $consulta): bool
    {

        if ($this->verificaDisponibilidade($consulta->getData(), $consulta->getHorario())) {
            $dataFormatada = $consulta->getData()->format('Y-m-d');
            unset($this->agendaPadrao[$dataFormatada . ' ' . $consulta->getHorario()]);
            $this->agendaMensal[$dataFormatada . ' ' . $consulta->getHorario()] = "Marcado";
            return true;
        } else {
            echo "Data indisponível!";
            return false;
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
