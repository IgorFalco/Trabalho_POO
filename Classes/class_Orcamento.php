<?php

include_once('./global.php');

class Orcamento extends persist
{

    protected $id;
    protected $paciente;
    protected $dentistaResponsavel;
    protected $dataOrcamento;
    protected $procedimentos = [];
    protected $valorTotal = 0;

    public function __construct(Paciente $_paciente, Dentista $_dentista, DateTime $_Data, array $_procedimento)
    {
        $this->id = uniqid('', true);
        $this->paciente = $_paciente;
        $this->dentistaResponsavel = $_dentista;
        $this->dataOrcamento = $_Data;
        $this->procedimentos = $_procedimento;

        foreach ($_procedimento as $item) {
            $this->valorTotal += $item->getValor();
        }
        $this->save();
    }

    public function AprovarOrcamento(bool $respostaAprovado, array $formaDePagamento): ?Tratamento
    {
        if ($respostaAprovado) {
            $tratamentoAprovado = new Tratamento($this->paciente, $this->dentistaResponsavel, $this->dataOrcamento, $this->procedimentos, $formaDePagamento);
            return $tratamentoAprovado;
        }
    }

    static public function getFilename()
    {
        return 'Orcamentos.txt';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPaciente(): Paciente
    {
        return $this->paciente;
    }

    public function getDentista(): Dentista
    {
        return $this->dentistaResponsavel;
    }

    public function getData(): DateTime
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
}
