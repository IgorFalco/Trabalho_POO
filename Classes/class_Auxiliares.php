<?php

include_once('global.php');

class Auxiliares extends Funcionario
{

    public function __construct(string $nome, string $email, string $telefone, string $cpf, float $salario, string $logradouro, string $numero, string $bairro, string $cidade, string $estado)
    {
        parent::__construct($nome, $email, $telefone, $cpf, $logradouro, $numero, $bairro, $cidade, $estado, $salario);
    }

    static protected function criaUsuario(string $login, string $senha, string $email, Perfil $perfil): Usuario
    {
        return new Usuario($login, $senha, $email, $perfil);
    }

    static public function getFilename(): string
    {
        return 'Auxiliares.txt';
    }
}
