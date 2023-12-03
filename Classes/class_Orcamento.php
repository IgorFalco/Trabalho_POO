<?php

include_once('./global.php');

class Orcamento extends persist
{

    protected $id;
    protected $paciente;
    protected $dentistaResponsavel;
    protected $dataOrcamento;
    protected $procedimentos = [];
    protected $valorTotal;

    public function __construct(int $_id, Paciente $_paciente, Dentista $_dentista, DateTime $_Data, array $_procedimento)
    {
        $this->id = $_id;
        $this->paciente = $_paciente;
        $this->dentistaResponsavel = $_dentista;
        $this->dataOrcamento = $_Data;
        $this->procedimentos = $_procedimento;
        $this->valorTotal = 0;
        foreach ($_procedimento as $item) {
            $this->valorTotal += $item->getValorProced();
        }
    }

    public function AprovarOrcamento(bool $respostaAprovado, String $formaDePagamento): ?Tratamento
    {
        if ($respostaAprovado) {
            $tratamentoAprovado = new Tratamento($this->id, $this->paciente, $this->dentistaResponsavel, $this->dataOrcamento, $this->procedimentos, $this->valorTotal, $formaDePagamento);
            return $tratamentoAprovado;
        }
    }

    // getters
    public function getID(): int
    {
        return $this->id;
    }
    public function getPaciente(): Paciente
    {
        return $this->paciente;
    }
    public function getDentistaResponsalvel(): Dentista
    {
        return $this->dentistaResponsavel;
    }
    public function getDataOrcamento(): DateTime
    {
        return $this->dataOrcamento;
    }
    public function getProcedimentos(): array
    {
        return $this->procedimentos;
    }
    public function getValorTotal(): float
    {
        return $this->valorTotal;
    }

    //setters

    public function setID(int $_id)
    {
        $this->id = $_id;
    }
    public function setPaciente(Paciente $_paciente)
    {
        $this->paciente = $_paciente;
    }
    public function setDentistaResponsalvel(Dentista $_dentista)
    {
        $this->dentistaResponsavel = $_dentista;
    }
    public function setDataOrcamento(DateTime $_data)
    {
        $this->dataOrcamento = $_data;
    }
    public function setProcedimentos(Procedimento $_procedimento)
    {
        $this->procedimentos[] = $_procedimento;
    }
    public function setValorTotal(int $_valorTotal)
    {
        $this->valorTotal = $_valorTotal;
    }

    static public function getFilename()
    {
        return "Orcamento.txt";
    }
}
