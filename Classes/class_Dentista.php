<?php

include_once('global.php');

class Dentista extends Funcionario
{
    protected $cro;
    protected $especialidade;
    protected $procedimentos_realizados = [];
    protected $agenda;


    public function __construct(string $nome, string $email, string $telefone, string $cpf, string $cro, Especialidade $especialidade, float $salario, string $logradouro, string $numero, string $bairro, string $cidade, string $estado)
    {
        parent::__construct($nome, $email, $telefone, $cpf, $logradouro, $numero, $bairro, $cidade, $estado, $salario);

        $this->especialidade = $especialidade;
        $this->cro = $cro;
    }

    public function addAgenda(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    public function addProcedimento(ExecucaoDoProcedimento $procedimentoRealizado)
    {
        array_push($this->procedimentos_realizados, $procedimentoRealizado);
    }

    static protected function criaUsuario(string $login, string $senha, string $email, Perfil $perfil): Usuario
    {
        return new Usuario($login, $senha, $email, $perfil);
    }

    public function getCro()
    {
        return $this->cro;
    }

    public function getEspecialidade()
    {
        return $this->especialidade;
    }
    public function getProcedimentos()
    {
        return $this->procedimentos_realizados;
    }

   

    static public function getFilename()
    {
        return 'Dentistas.txt';
    }
}
