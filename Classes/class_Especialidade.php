<?php

include_once('global.php');

class Especialidade extends persist
{
    private $nome;
    private $porcentagem;

    public function __construct(string $nome, float $porcentagem)
    {
        $this->nome = $nome;
        $this->porcentagem = $porcentagem;
        $this->save();
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPorcentagem()
    {
        return $this->porcentagem;
    }

    static public function getFilename()
    {
        return "Especialidades.txt";
    }
}
