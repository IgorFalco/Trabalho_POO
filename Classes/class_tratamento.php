<?php

include_once('./class_orcamento.php');
include_once('./global.php');


class Tratamento extends orcamento
{

    private $formaDePagamento;

    public function __construct(int $_id, Paciente $_paciente, Dentista $_dentista, DateTime $_data, array $_procedimento, float $_valorTotal, $_formaDePagamento)
    {
        parent::__construct($_id, $_paciente, $_dentista, $_data, $_procedimento, $_valorTotal);
        $this->formaDePagamento = $_formaDePagamento;
    }

    public function getFormaDePagamento()
    {
        return $this->formaDePagamento;
    }

    public function setFormaDePagamento(string $_formaDePagamento)
    {
        $this->formaDePagamento = $_formaDePagamento;
    }
}
