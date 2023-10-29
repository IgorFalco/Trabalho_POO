<?php
include_once('global.php');

class Funcionalidades
{
    private $nome;

    public function __construct(string $_nome)
    {
        $this->nome = $_nome;
    }
}
