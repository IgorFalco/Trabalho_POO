<?php

include_once('global.php');

class Tratamento extends Orcamento
{

    protected $formaDePagamento;
    protected $taxa_cartao;
    protected $impostos;
    protected $receita;
    protected bool $pagamento_efetuado;
    protected $data_pagamento = 0;

    public function __construct(int $_id, Paciente $_paciente, Dentista $_dentista, DateTime $_data, array $_procedimento, string $_formaDePagamento, float $taxa_cartao, float $impostos, float $receita)
    {
        parent::__construct($_id, $_paciente, $_dentista, $_data, $_procedimento, $_valorTotal);
        $this->formaDePagamento = $_formaDePagamento;
        $this->taxa_cartao = $taxa_cartao;
        $this->impostos = $impostos;
        $this->receita = $receita;
        $this->pagamento_efetuado = 0;
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
