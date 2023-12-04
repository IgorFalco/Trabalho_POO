<?php

include_once('global.php');

class Pessoa extends persist
{
    protected $nome;
    protected $email;
    protected $telefone;

    public function __construct(string $nome, string $email, string $telefone)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->save();
    }

    static public function getFilename()
    {
        return 'Pessoas.txt';
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

}
