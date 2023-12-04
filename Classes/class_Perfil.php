<?php
include_once('global.php');


class Perfil extends persist
{
    private $arrayFuncionalidades  = [];
    private $nome;

    public function __construct(string $_nome, array $_arrayFuncionalidades)
    {
        $this->nome = $_nome;
        $this->arrayFuncionalidades = $_arrayFuncionalidades;
        $this->save();
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getFuncionalidades(): array
    {
        return $this->arrayFuncionalidades;
    }

    public function addFuncionalidade(Funcionalidades $funcionalidade)
    {
        array_push($this->arrayFuncionalidades, $funcionalidade);
    }

    static public function getFilename()
    {
        return 'Perfil.txt';
    }
}
