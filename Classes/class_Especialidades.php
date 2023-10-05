<?php
include_once('global.php');

class Especialidades extends persist
{

    private $nome;

    public function __construct(String $_nome)
    {
        $this->nome = $_nome;
    }

    static public function getFilename()
    {
        return "Especialidades.txt";
    }
}
