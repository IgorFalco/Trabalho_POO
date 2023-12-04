<?php

include_once('global.php');

class Procedimento extends persist
{

    private $nome;
    private $descricao;
    private $valor;
    private $numeroConsultas;
    private $duracao;
    private $especialidades = [];

    public function __construct(string $nome, string $descricao, float $valor, array $_especialidades, int $numeroConsultas, int $duracao)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->especialidades = $_especialidades;
        $this->numeroConsultas = $numeroConsultas;
        $this->duracao = $duracao;
        $this->save();
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getNome()
    {
        return $this->valor;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getEspecialidades(): array
    {
        return $this->especialidades;
    }

    public function getNumeroConsultas()
    {
        return $this->numeroConsultas;
    }

    public function getDuracao()
    {
        return $this->duracao;
    }

    static public function getFilename()
    {
        return 'Procedimentos.txt';
    }
}
