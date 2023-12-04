<?php
include_once('global.php');

class ExecucaoDoProcedimento extends persist
{

    private $tratamento;
    private $procedimento_realizado;
    private $data;
    private $horario;
    private $dentistaExecutor;
    private $status;

    public function __construct(Tratamento $tratamento, Procedimento $procedimento, DateTime $data, DateTime $horario, Dentista $dentistaExecutor)
    {
        $aux = false;
        foreach ($procedimento->getEspecialidades() as $especialidadesPossiveis) {
            if ($dentistaExecutor->getEspecialidade() == $especialidadesPossiveis)
                $aux = true;
        }
        if ($aux) {
            $this->tratamento = $tratamento;
            $this->procedimento_realizado = $procedimento;
            $this->data = $data;
            $this->horario = $horario;
            $this->dentistaExecutor = $dentistaExecutor;
            $this->status = FALSE;
            $this->save();
        } else {
            echo "Esse dentista não pode realizar esse procedimento\n";
        }
    }

    public function Procedimento_Realizado()
    {
        $this->status = TRUE;
        $this->dentistaExecutor->addProcedimento($this);
    }

    static public function getFilename()
    {
        return "ExecucaoDoTratamento.txt";
    }

    public function getTratamento(): Tratamento
    {
        return $this->tratamento;
    }

    public function getProcedimentoRealizado(): Procedimento
    {
        return $this->procedimento_realizado;
    }

    public function getData(): DateTime
    {
        return $this->data;
    }

    public function getHorario(): DateTime
    {
        return $this->horario;
    }

    public function getDentistaExecutor(): Dentista
    {
        return $this->dentistaExecutor;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
