<?php 
include_once('./class_paciente.php');
include_once('./class_dentista.php');
include_once('./class_tratamento.php');
include_once('./global.php');

class orcamento {

    private $id;
    private $paciente;
    private $dentistaResponsavel;
    private $dataOrcamento;
    private $procedimentos = [];
    private $valorTotal;
    
    public function __construct(int $_id, Paciente $_paciente, Dentista $_dentista, DateTime $_Data, Procedimento $_procedimento, float $valorTotal) {
        $this->id = $_id;
        $this->paciente = $_paciente;
        $this->dentistaResponsavel = $_dentista;
        $this->dataOrcamento = $_Data;
        $this->procedimentos = $_procedimento;
        $this->valorTotal = $valorTotal;
    }

    public function AprovarOrcamento(bool $respostaAprovado, String $formaDePagamento) : Tratamento{
        
        if ($respostaAprovado) {
            $tratamentoAprovado = new Tratamento($this->id, $this->paciente, $this->dentistaResponsavel, $this->dataOrcamento, $this->procedimentos, $this->valorTotal, $formaDePagamento);
            return $tratamentoAprovado;
        } 
    }
}

