<?php
include_once('./global.php');

class Especialidades extends persist
{

    private $nome;

    public function __construct(String $_nome)
    {
        parent::__construct();
        $this->nome = $_nome;
    }
}
