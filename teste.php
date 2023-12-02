<?php

include_once('global.php');

$especialidades = new Especialidades(
    "Ortodentista"
);

$dentista = new Dentista(
    'Dra. Maria',
    'maria@example.com',
    '987-654-3210',
    '98765432101',
    'CROSP54321',
    $especialidades,
    10.0,
    'Casa',
    '456',
    'Centro',
    'Cidade B',
    'Estado Y'
);

$pessoa = new Pessoa(
    'João Silva',
    'joao@example.com',
    '123-456-7890'
);

$dentista_celet = new DentistaCeletista(
    'Dra. Maria',
    'maria@example.com',
    '987-654-3210',
    '98765432101',
    'CROSP54321',
    $especialidades,
    10.0,
    'Casa',
    '456',
    'Centro',
    'Cidade B',
    'Estado Y',
    4500.02
);


$DentistaParcerio = new DentistaParceiro(
    'Dra. Maria',
    'maria@example.com',
    '987-654-3210',
    '98765432101',
    'CROSP54321',
    $especialidades,
    10.0,
    'Casa',
    '456',
    'Centro',
    'Cidade B',
    'Estado Y'
);

$procedimento1 = new Procedimento(
    'Limpeza Dental',
    'Limpeza dos dentes e remoção de placas',
    100, // Valor do procedimento
    ["Ortodentista", "Clinico Geral"]
);

$procedimento2 = new Procedimento(
    'Limpeza Dental 2',
    'Limpeza dos dentes e remoção de placas',
    100, // Valor do procedimento
    ["Ortodentista", "Clinico Geral"]
);

$procedimento3 = new Procedimento(
    'Limpeza Dental 3',
    'Limpeza dos dentes e remoção de placas',
    150, // Valor do procedimento
    ["Ortodentista", "Clinico Geral"]
);

$paciente = new Paciente(
    'Maria Santos',
    'maria@example.com',
    '987-654-3210',
    new DateTime('1990-05-15'), // Data de nascimento
    '1234567', // RG
    1 // ID do paciente
);


$vetor_proc = [$procedimento1, $procedimento2, $procedimento3];

$orcamento = new Orcamento(1, $paciente, $dentista_celet, new DateTime('2010-05-15'), $vetor_proc);

$consulta_avaliacao = new ConsultaAvaliacao($paciente, "aaaaaa", 150, $especialidades, new DateTime('2010-05-15 06:30'));

$orcamento2 = $consulta_avaliacao->gerarOrcamento(1, $dentista_celet, new DateTime('2010-05-15 10:30'), $vetor_proc);
echo $orcamento2;
?>