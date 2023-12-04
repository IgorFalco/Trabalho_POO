<?php
include_once('global.php');

class Funcionalidades extends persist
{
    private $nome;

    public function __construct(string $_nome)
    {
        $this->nome = $_nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    static public function getFilename()
    {
        return 'Funcionalidades.txt';
    }
}
