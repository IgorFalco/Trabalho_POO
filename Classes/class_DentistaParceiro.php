<?php

include_once('global.php');

class DentistaParceiro extends Dentista
{

    private $valorPorcentagem;
    private $listaSalarios = [];
    public function __construct(float $valorPorcentagem, string $nome, string $email, string $telefone, string $cpf, string $cro, Especialidade $especialidade, float $salario, string $logradouro, string $numero, string $bairro, string $cidade, string $estado, string $login, string $senha, Perfil $perfil, Agenda $agenda)
    {
        parent::__construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $salario, $logradouro, $numero, $bairro, $cidade, $estado, $login, $senha, $perfil,  $agenda);
        $this->valorPorcentagem = $valorPorcentagem;
    }

    public function calcularSalarioMensal(int $mes, int $ano): float
    {
        $salarioTotal = 0;

        foreach ($this->procedimentos_realizados as $execucao) {
            $dataExecucao = $execucao->getData();
            $mesExecucao = (int)$dataExecucao->format('m');
            $anoExecucao = (int)$dataExecucao->format('Y');

            if ($mesExecucao === $mes && $anoExecucao === $ano) {
                // O procedimento foi realizado no mês desejado
                $valorProcedimento = $execucao->getProcedimentoRealizado()->getValor();
                $porcentagem = $this->getPorcentagem();
                $salarioTotal += ($valorProcedimento * $porcentagem);
            }
        }

        $listaSalarios["$mes.$ano"] = $salarioTotal;

        return $salarioTotal;
    }

    public function getPorcentagem(): float
    {
        return $this->valorPorcentagem;
    }

    public function getLista(): array
    {
        return $this->listaSalarios;
    }

    static public function getFilename(): string
    {
        return 'DentistasParceiros.txt';
    }
}
