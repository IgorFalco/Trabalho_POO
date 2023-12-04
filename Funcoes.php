<?php
include_once('global.php');

function cadastrarProcedimento()
{
    // Obtém a lista de especialidades
    $especialidades = Especialidade::getRecords();

    // Exibe a lista de especialidades para o usuário escolher
    echo "Especialidades Disponíveis:\n";
    foreach ($especialidades as $index => $especialidade) {
        echo "$index. {$especialidade->getNome()}\n";
    }

    // Solicita ao usuário que escolha as especialidades pelo número
    echo "Escolha os números correspondentes às especialidades (separados por vírgula): ";
    $indicesEspecialidades = array_map('intval', explode(',', readline()));

    // Verifica se os índices fornecidos pelo usuário são válidos
    foreach ($indicesEspecialidades as $index) {
        if ($index < 0 || $index >= count($especialidades)) {
            echo "Índice $index é inválido. Operação cancelada.\n";
            return;
        }
    }

    // Obtém os detalhes das especialidades escolhidas
    $especialidadesEscolhidas = array_map(function ($index) use ($especialidades) {
        return $especialidades[$index];
    }, $indicesEspecialidades);

    // Solicita ao usuário outras informações necessárias
    echo "Nome do procedimento: ";
    $nome = readline();

    echo "Descrição do procedimento: ";
    $descricao = readline();

    echo "Valor do procedimento: ";
    $valor = floatval(readline());

    echo "Número de consultas: ";
    $numeroConsultas = intval(readline());

    echo "Duração do procedimento (em minutos): ";
    $duracao = new DateTime();
    $duracao->add(new DateInterval('PT' . intval(readline()) . 'M'));

    // Cria o objeto Procedimento
    $proc = new Procedimento($nome, $descricao, $valor, $especialidadesEscolhidas, $numeroConsultas, $duracao);

    // Salva o procedimento
    $proc->save();

    echo "Procedimento cadastrado com sucesso!\n";
};

function calculaCustoMensal(int $mes, int $ano): float
{
    $salarioTotal = 0;
    $receitaTotal = 0;

    // Dentistas
    $dentistas = Dentista::getRecords();
    foreach ($dentistas as $dentista) {
        $salarioTotal += $dentista->getSalario();
    }

    // Dentistas Parceiros
    $dentistasParceiros = DentistaParceiro::getRecords();
    foreach ($dentistasParceiros as $dentistaParceiro) {
        $salarioTotal += $dentistaParceiro->calcularSalarioMensal($mes, $ano);
    }

    // Auxiliares
    $auxiliares = Auxiliares::getRecords();
    foreach ($auxiliares as $auxiliar) {
        $salarioTotal += $auxiliar->getSalario();
    }

    // Secretários
    $secretarios = Secretarios::getRecords();
    foreach ($secretarios as $secretario) {
        $salarioTotal += $secretario->getSalario();
    }

    // Carregar os dados existentes dos tratamentos
    $tratamentos = Tratamento::getRecords();



    // Iterar sobre os tratamentos
    foreach ($tratamentos as $tratamento) {
        // Verificar se o tratamento foi quitado no mês e ano desejados
        if ($tratamento->getQuitado() && $tratamento->getDataPagamento()->format('m') == $mes && $tratamento->getDataPagamento()->format('Y') == $ano) {
            // Adicionar a receita do tratamento à receita total
            $receitaTotal += $tratamento->calculaValores();
        }
    }

    return $receitaTotal - $salarioTotal;
}
