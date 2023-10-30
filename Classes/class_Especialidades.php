<?php
include_once('global.php');

class Especialidades extends persist
{

    private $nome;
    private $percentDentistaParceiro;

    public function __construct(String $_nome, float $_percentDentistaParceiro)
    {
        $this->nome = $_nome;
        $this->percentDentistaParceiro = $_percentDentistaParceiro;
    }

    public function getEspec()
    {
        return [$this-> nome];
    }

    static public function getFilename()
    {
        return "Especialidades.txt";
    }
}
