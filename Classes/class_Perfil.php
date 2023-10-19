<?php
include_once('global.php');


class Perfil
{
    private $arrayFuncionalidades  = [];
    private $nome;

    public function __construct(string $_nome, array $_arrayFuncionalidades)
    {
        $this->nome = $_nome;
        $this->arrayFuncionalidades = $_arrayFuncionalidades;
    }
}
