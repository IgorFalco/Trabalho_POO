<?php


include_once('global.php');

class FormaDePagamento
{

    private $nome;
    private $taxa;
    private $numeroDeParcelas;


    public function __construct(string $_nome, float $_taxa, int $_numeroDeParcelas)
    {
        $this->nome = $_nome;
        $this->taxa = $_taxa;
        $this->numeroDeParcelas = $_numeroDeParcelas;
    }
}
