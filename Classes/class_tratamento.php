<?php

include_once('./class_orcamento.php');
include_once('./global.php');


class Tratamento extends orcamento{

    private $formaDePagamento;

    public function __construct(int $_id, Paciente $_paciente, Dentista $_dentista, DateTime $_data, Procedimento $_procedimento, float $valorTotal, $formaDePagamento) {
        parent::__construct($_id, $_paciente, $_dentista, $_data, $_procedimento, $valorTotal);
        $this->formaDePagamento = $formaDePagamento;
    }
}