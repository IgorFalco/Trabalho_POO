<?php

include_once('global.php');


$Perfil = new Perfil("PerfilTeste", [
    "CalculaCustoMensal",
    "CadastrarDentista",
    "CadastrarCliente",
    "CadastrarPaciente",
    "CadastrarDentistaParceiro",
    "CadastrarNovoOrcamento",
    "CadastrarAgenda",
    "Logout"
]);

$PerfilTodas = new Perfil("PerfilTotal", [
    "CalculaCustoMensal",
    "CadastrarDentista",
    "CadastrarCliente",
    "CadastrarPaciente",
    "CadastrarDentistaParceiro",
    "CadastrarNovoOrcamento",
    "CadastrarAgenda",
    "CadastrarProcedimento",
    "Logout"
]);
$usuario = new Usuario("UserTeste", "UserTeste", " ", $Perfil);

$controleAcesso = new ControleAcesso($usuario);

$controleAcesso->listarFuncionalidadesDisponiveis();

if ($controleAcesso->getUser() == null) {
    $login = Autenticacao::getInstance();

    $login->login($usuario);

    $controleAcesso = new ControleAcesso($usuario);

    $Limpeza = [
        'nome' => "Limpeza",
        'descricao' => "",
        'valor' => 200,
        'especialidadesEscolhidas' => ["Clínica Geral"],
        'numeroConsultas' => 1,
        'duracao' => 30,
    ];
    $Restauração = [
        'nome' => "Restauração",
        'descricao' => "",
        'valor' => 185,
        'especialidadesEscolhidas' => ["Clínica Geral"],
        'numeroConsultas' => 1,
        'duracao' => 30,
    ];
    $Extração_Comum = [
        'nome' => "Extração Comum",
        'descricao' => "Não inclui dente siso",
        'valor' => 280,
        'especialidadesEscolhidas' => ["Clínica Geral"],
        'numeroConsultas' => 1,
        'duracao' => 30,
    ];
    $Canal = [
        'nome' => "Canal",
        'descricao' => "",
        'valor' => 800,
        'especialidadesEscolhidas' => ["Endodontia"],
        'numeroConsultas' => 1,
        'duracao' => 30,
    ];
    $Extração_de_Siso = [
        'nome' => "Extração de Siso",
        'descricao' => "Valor por dente",
        'valor' => 400,
        'especialidadesEscolhidas' => ["Cirurgia"],
        'numeroConsultas' => 1,
        'duracao' => 30,
    ];
    $Clareamento_a_laser = [
        'nome' => "Clareamento a laser",
        'descricao' => "",
        'valor' => 1700,
        'especialidadesEscolhidas' => ["Estética"],
        'numeroConsultas' => 1,
        'duracao' => 30,
    ];
    $Clareamento_de_moldeira = [
        'nome' => "Clareamento de moldeira",
        'descricao' => "Clareamento caseiro",
        'valor' => 900,
        'especialidadesEscolhidas' => ["Estética"],
        'numeroConsultas' => 1,
        'duracao' => 30,
    ];
    //User sem permissão
    $LIMPEZACAD = $controleAcesso->cadastrarProcedimento($Limpeza);
    $controleAcesso->Sair();

    $usuarioPoderoso = new Usuario("ADMIM", "ADMIM", " ", $PerfilTodas);

    $login->login($usuarioPoderoso);

    $controleAcesso = new ControleAcesso($usuarioPoderoso);

    $LIMPEZACAD = $controleAcesso->cadastrarProcedimento($Limpeza);
    $RESTAURACAOCAD = $controleAcesso->cadastrarProcedimento($Restauração);
    $EXTRACAOCAD = $controleAcesso->cadastrarProcedimento($Extração_Comum);
    $CANALCAD = $controleAcesso->cadastrarProcedimento($Canal);
    $EXTRACAOSISOCAD = $controleAcesso->cadastrarProcedimento($Extração_de_Siso);
    $CLAREAMENTOLAZERCAD = $controleAcesso->cadastrarProcedimento($Clareamento_a_laser);


    $Dinheiro = new FormaDePagamento("Dinheiro à Vista", 0, 1);
    $Pix = new FormaDePagamento("Pix", 0, 1);
    $Débito = new FormaDePagamento("Débito", 0, 1);
    $Crédito_de_1 = new FormaDePagamento("Crédito à vista", 4, 1);
    $Crédito_de_2 = new FormaDePagamento("Crédito 2 vezes", 4, 2);
    $Crédito_de_3 = new FormaDePagamento("Crédito 3 vezes", 4, 3);
    $Crédito_de_4 = new FormaDePagamento("Crédito à vista", 7, 4);
    $Crédito_de_5 = new FormaDePagamento("Crédito 2 vezes", 7, 5);
    $Crédito_de_6 = new FormaDePagamento("Crédito 3 vezes", 7, 6);

    $DentistaCLT = [
        'nome' => "JorgeCLT",
        'email' => "clt@gmail.com",
        'telefone' => "99999-9999",
        'cpf' => "12345678985",
        'cro' => "123456789",
        'especialidade' => ["Clínica Geral", "Endodontia", "Cirurgia"],
        'salario' => 5000,
        'logradouro' => "Rua J",
        'numero' => "15",
        'bairro' => "Centro",
        'cidade' => "BH",
        'estado' => "MG",
    ];
    $DentistaParceiro = [
        'valorPorcentagem' => 40,
        'nome' => "JorgeCLT",
        'email' => "parceiro@gmail.com",
        'telefone' => "99999-9999",
        'cpf' => "12345678985",
        'cro' => "123456789",
        'especialidade' => ["Clínica Geral", "Estética", "Cirurgia"],
        'salario' => 0,
        'logradouro' => "Rua J",
        'numero' => "15",
        'bairro' => "Centro",
        'cidade' => "BH",
        'estado' => "MG",
        'login' => "DentistaParceiro",
        'senha' => "Senha123",
        'perfil' => $Perfil,
    ];

    $CLT = $controleAcesso->cadastrarDentista($DentistaCLT);
    $PARCEIRO = $controleAcesso->cadastrarDentistaParceiro($DentistaParceiro);


    $CLT->getAgenda()->abrirAgendaPadrao(
        new DateTime('2023-11-01'),
        new DateTime('2023-11-30'),
        [
            ["8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00"]
        ],
        ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira']
    );

    $PARCEIRO->getAgenda()->abrirAgendaPadrao(
        new DateTime('2023-11-01'),
        new DateTime('2023-11-30'),
        [
            ['14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'],
            ['8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00'],
            ['8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00'],
            ['8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00'],
            ['14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'],
        ],
        ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira']
    );

    $Cliente = [
        'nome' => "Cliente",
        'email' => "cliente@email.com",
        'telefone' => "32323232",
        'cpf' => "313131313",
        'rg' => "131313131313",
    ];

    $CLIENTECADASTRADO = $controleAcesso->cadastrarCliente($Cliente);

    $Paciente = [
        'nome' => "Paciente",
        'email' => "paciente@gmail.com",
        'telefone' => "32323232323",
        'data_nascimento' => "2010-12-01",
        'rg' => "123131313",
        'responsavel' => $CLIENTECADASTRADO,
    ];

    $PACIENTECADASTRADO = $controleAcesso->cadastrarPaciente($Paciente);

    $CLIENTECADASTRADO->addPaciente($PACIENTECADASTRADO);


    $consultaParceiro = [
        'paciente' => $PACIENTECADASTRADO,
        'dentista' => $PARCEIRO,
        'valor' => 0,
        'data' => new DateTime('2023-11-06'),
        'horario' =>  "14:00",
    ];

    $consultaCLT = [
        'paciente' => $PACIENTECADASTRADO,
        'dentista' => $CLT,
        'valor' => 0,
        'data' => new DateTime('2023-11-06'),
        'horario' =>  "14:00",
    ];

    $CONSULTAPARCEIRO = $controleAcesso->criarConsulta($consultaParceiro);
    $CONSULTACLT = $controleAcesso->criarConsulta($consultaCLT);


    if (!$PARCEIRO->getAgenda()->agendarConsulta($CONSULTAPARCEIRO)) {
        $CLT->getAgenda()->agendarConsulta($CONSULTACLT);

        $dadosOrcamento = [
            'paciente' => $PACIENTECADASTRADO,
            'dentista' => $CLT,
            'procedimentos' => [$LIMPEZACAD, $CLAREAMENTOLAZERCAD, $RESTAURACAOCAD, $RESTAURACAOCAD],
            'dataOrcamento' => $CONSULTACLT->getData(),
        ];

        $ORCAMENTOCADASTRADO = $controleAcesso->cadastrarNovoOrcamento($dadosOrcamento);

        
        $Pix->setValor(1135);
        $Crédito_de_3->setValor(1135);
        $TRATAMENTOCADASTRADO = $ORCAMENTOCADASTRADO->AprovarOrcamento(true, [$Pix, $Crédito_de_3]);
        $TRATAMENTOCADASTRADO->confirmaPagamento($Pix, new DateTime('2023-11-06'));
        $TRATAMENTOCADASTRADO->confirmaPagamento($Crédito_de_3, new DateTime('2023-11-06'));
    } else {

        $dadosOrcamento = [
            'paciente' => $PACIENTECADASTRADO,
            'dentista' => $PARCEIRO,
            'procedimentos' => [$LIMPEZACAD, $CLAREAMENTOLAZERCAD, $RESTAURACAOCAD, $RESTAURACAOCAD],
            'dataOrcamento' => $CONSULTAPARCEIRO->getData(),
        ];
    
        $ORCAMENTOCADASTRADO = $controleAcesso->cadastrarNovoOrcamento($dadosOrcamento);
        $TRATAMENTOCADASTRADO = $ORCAMENTOCADASTRADO->AprovarOrcamento(true, [$Pix, $Crédito_de_3]);
        $TRATAMENTOCADASTRADO->confirmaPagamento($Pix, new DateTime('2023-11-06'));
        $TRATAMENTOCADASTRADO->confirmaPagamento($Crédito_de_3, new DateTime('2023-11-06'));
    }

    echo "Receita final: R$ " . number_format($controleAcesso->calculaCustoMensal(11, 2023), 2, ',', '.') . PHP_EOL;


    $pasta = 'Classes/dataFiles';
    $arquivos = glob($pasta . '/*');
    foreach ($arquivos as $arquivo) {
        if (is_file($arquivo)) {
            unlink($arquivo);
        }
    }
}
