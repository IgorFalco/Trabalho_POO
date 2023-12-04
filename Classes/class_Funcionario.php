<?php

include_once('global.php');

abstract class Funcionario extends Pessoa
{
    protected $cpf;
    protected $endereco = [];
    protected $salario;

    public function __construct(string $nome, string $email, string $telefone, string $cpf, string $logradouro, string $numero, string $bairro, string $cidade, string $estado, float $salario)
    {
        parent::__construct($nome, $email, $telefone);
        $this->cpf = $cpf;
        $this->endereco = [
            'Logradouro' => $logradouro,
            'Numero' => $numero,
            'Bairro' => $bairro,
            'Cidade' => $cidade,
            'Estado' => $estado
        ];
        $this->salario = $salario;
        $this->save();
    }

    abstract static protected function criaUsuario(string $login, string $senha, string $email, Perfil $perfil);

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    static public function getFilename()
    {
        return 'Funcionarios.txt';
    }
}
