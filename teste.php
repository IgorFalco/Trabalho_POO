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


$novoFuncionario = new Funcionario(
    'joao',
    'joao@gmail.com',
    '31983333333',
    '099123123123',
    'Rua dos Astecas',
    '2771',
    'Santa Monica',
    'BH',
    'MG',
    12345.67
);


$dataNascimentoPaciente = new DateTime('19-11-2001');
$dataHoje = new DateTime();


$_paciente = new Paciente(
    'pedro',
    'pedro@gmail.com',
    '31983333333',
    $dataNascimentoPaciente,
    '16167543',
    1234
);


$procedimentos = ['Remoção do Siso', 'Limpeza Geral'];


$novoOrcamento = new Orcamento(
    3333,
    $_paciente,
    $_dentista,
    $dataHoje,
    $procedimentos,
    420.69
);


$novaFormaDePagamento = new FormaDePagamento(
    'Cartão de Crédito', 
    0.012, 
    3
);
