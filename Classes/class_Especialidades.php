<?php
include_once('./global.php');

class Especialidades extends persist
{

    private string $nome;

    public function __construct(String $_nome)
    {
        $this->nome = $_nome;
    }

    public function getEspec()
    {
        return $this-> nome;
    }

    static public function getFilename()
    {
        return "Especialidades.txt";
    }
}
