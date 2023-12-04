<?php


include_once('global.php');

class FormaDePagamento extends persist
{

    private $nome;
    private $taxa;
    private $valor;
    private $numeroDeParcelas;


    public function __construct(string $_nome, float $_taxa, int $_numeroDeParcelas)
    {
        $this->nome = $_nome;
        $this->taxa = $_taxa;
        $this->numeroDeParcelas = $_numeroDeParcelas;
        $this->save();
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

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor)
    {
        $this->valor = $valor;
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
