<?php


include_once('global.php');

class FormaDePagamento extends persist
{

    private $nome;
    private $valor;
    private $taxa;
    private $numeroDeParcelas;


    public function __construct(string $_nome, float $_taxa, int $_numeroDeParcelas, float $valor)
    {
        $this->nome = $_nome;
        $this->valor = $valor;
        $this->taxa = $_taxa * $_numeroDeParcelas;
        $this->numeroDeParcelas = $_numeroDeParcelas;
    }

    static public function getFilename()
    {
        return 'FormaPagamento.txt';
    }

    //getters e setters

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getValor(): string
    {
        return $this->valor;
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
