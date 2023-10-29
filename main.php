<?php


include_once('global.php');

$especialidades = new Especialidades(
    "Ortodentista",
    0.25,
);
echo $especialidades;

$Auxiliares = new Auxiliares(
    "João",
    "joao@example.com",
    "123456789",
    "123.456.789-00",
    "Rua Exemplo",
    "123",
    "Bairro Teste",
    "Cidade Teste",
    "SP",
    2500.00
);
echo $Auxiliares;

$dentista = new Dentista(
    'Dra. Maria',
    'maria@example.com',
    '987-654-3210',
    '98765432101',
    'CROSP54321',
    $especialidades,
    10.0,
    '456',
    'Centro',
    'Cidade B',
    'Estado Y'
);
echo $dentista;


$DentistaParcerio = new DentistaParceiro(
    "João",
    "joao@example.com",
    "123456789",
    "123.456.789-00",
    "Rua Exemplo",
    $especialidades,
    120,
    "Cidade Teste",
    "SP",
    "2500.00",
    "Sao Paulo",
    "Minas"
);
echo $DentistaParcerio;

$secretario = new Secretario(
    'Joana',
    'joana@example.com',
    '987-654-3210',
    '98765432101',
    'Rua Principal',
    '123',
    'Centro',
    'Cidade C',
    'Estado Z',
    2500.00 // Salário fixo do secretário
);
echo $secretario;

$cliente = new Cliente(
    "Igor",
    "igortsfalco@gmail.com",
    "32991504152",
    "12017998648",
    "18886231",
    []
);
echo $cliente;


$procedimento = new Procedimento(
    'Limpeza Dental',
    'Limpeza dos dentes e remoção de placas',
    100, // Valor do procedimento
    []
);
echo $procedimento;

$pessoa = new Pessoa(
    'João Silva',
    'joao@example.com',
    '123-456-7890'
);
echo $pessoa;

$paciente = new Paciente(
    'Maria Santos',
    'maria@example.com',
    '987-654-3210',
    new DateTime('1990-05-15'), // Data de nascimento
    '1234567', // RG
    1 // ID do paciente
);
echo $paciente;

$Funcionario = new Funcionario(
    "João",
    "joao@example.com",
    "123456789",
    "123.456.789-00",
    "Rua Exemplo",
    "123",
    "Bairro Teste",
    "Cidade Teste",
    "SP",
    2500.00
);
echo $Funcionario;

$orcamento = new Orcamento(
    1, // ID do orçamento
    $paciente, // Instância do objeto Paciente (substitua pelo objeto real)
    $dentista, // Instância do objeto Dentista (substitua pelo objeto real)
    new DateTime('2010-05-15'), // Data do orçamento (substitua pela data real)
    [$procedimento], // Procedimentos (substitua pelos procedimentos reais)
    100.00 // Valor total (substitua pelo valor real)
  );
echo $orcamento;

$tratamento = new Tratamento(1, $paciente, $dentista, new DateTime("16:00"), [$procedimento], 100.00, "Cartão");
echo $tratamento;

$data = new DateTime('2023-10-05');
$horario = new DateTime('14:30:00');
$duracao = new DateTime('01:00:00');
$detalhamento = "Consulta de rotina";

$ExecucaoDoTratamento = new ExecucaoDoTratamento($tratamento, $procedimento_realizado, $data, $horario, $duracao, $detalhamento, $dentistaExecutor, $status);
echo $ExecucaoDoTratamento;


echo $cliente;


