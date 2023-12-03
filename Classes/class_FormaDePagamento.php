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

    //getters e setters

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getTaxa(): float
    {
        return $this->taxa;
    }

    public function get_numeroDeParcelas(): int
    {
        return $this->numeroDeParcelas;
    }
}


