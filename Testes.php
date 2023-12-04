<?php

include_once('global.php');
include_once('Funcoes.php');


$Perfil = new Perfil("PerfilTeste", [
    "CalculaCustoMensal",
    "CadastrarDentista",
    "CadastrarCliente",
    "CadastrarPaciente",
    "CadastrarDentistaParceiro",
    "CadastrarNovoOrcamento",
    "Logout"
]);
$usuario = new Usuario("UserTeste", "UserTeste", " ", $Perfil);

$controleAcesso = new ControleAcesso($usuario);

try {
    $controleAcesso->listarFuncionalidadesDisponiveis();
} catch (Exception $e) {
    echo "Erro ao listar funcionalidades, usuário não está logado\n";
}
if ($controleAcesso->getUser() == null) {
    $login = Autenticacao::getInstance();

    $funcao = $login->login($usuario);

    $controleAcesso = new ControleAcesso($usuario);
    $Limpeza = new Procedimento("Limpeza", "", 200, ["Clínica Geral"], 1, 30);
    $Restauração = new Procedimento("Restauração", "", 185, ["Clínica Geral"], 1, 30);
    $Extração_Comum = new Procedimento("Extração Comum", "Não inclui dente siso", 280, ["Clínica Geral"], 1, 30);
    $Canal = new Procedimento("Canal", "", 800, ["Endodontia"], 1, 30);
    $Extração_de_Siso = new Procedimento("Extração de Siso", "Valor por dente", 400, ["Cirurgia"], 1, 30);
    $Clareamento_a_laser = new Procedimento("Clareamento a laser", "", 1700, ["Estética"], 1, 30);
    $Clareamento_de_moldeira = new Procedimento("Clareamento de moldeira", "Clareamento caseiro", 900, ["Estética"], 1, 30);

    $Dinheiro = new FormaDePagamento("Dinheiro à Vista", 0, 1);
    $Pix = new FormaDePagamento("Pix", 0, 1);
    $Débito = new FormaDePagamento("Débito", 0, 1);
    $Crédito_de_1 = new FormaDePagamento("Crédito à vista", 4, 1);
    $Crédito_de_2 = new FormaDePagamento("Crédito 2 vezes", 4, 2);
    $Crédito_de_3 = new FormaDePagamento("Crédito 3 vezes", 4, 3);
    $Crédito_de_4 = new FormaDePagamento("Crédito à vista", 7, 4);
    $Crédito_de_5 = new FormaDePagamento("Crédito 2 vezes", 7, 5);
    $Crédito_de_6 = new FormaDePagamento("Crédito 3 vezes", 7, 6);

    $DentistaCLT = new Dentista("JorgeCLT", "clt@gmail.com", "99999-9999", "12345678985", "123456789", ["Clínica Geral", "Endodontia", "Cirurgia"], 5000, "Rua J", "15", "Centro", "BH", "MG");
    $DentistaParceiro = new DentistaParceiro(40, "JorgeCLT", "clt@gmail.com", "99999-9999", "12345678985", "123456789", ["Clínica Geral", "Estética", "Cirurgia"], 0, "Rua J", "15", "Centro", "BH", "MG", "DentistaParceiro", "Senha123", $Perfil);
    $agendaClt = new Agenda($DentistaCLT);
    $agendaClt->abrirAgendaPadrao(
        new DateTime('2023-11-01'),
        new DateTime('2023-11-30'),
        [
            ["8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00"]
        ],
        ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira']
    );
    $DentistaCLT->addAgenda($agendaClt);
    $agendaParceiro = new Agenda($DentistaParceiro);
    $agendaParceiro->abrirAgendaPadrao(
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
    $DentistaParceiro->addAgenda($agendaParceiro);

    $Cliente = new Cliente("Cliente", "cliente@email.com", "32323232", "313131313", "131313131313", []);
    $Paciente = new Paciente("Paciente", "paciente@gmail.com", "32323232323", new DateTime(2010 - 12 - 01), "123131313", $Cliente);
    $Cliente->addPaciente($Paciente);

    $consulta = new ConsultaAvaliacao($Paciente, $DentistaParceiro, 0, new DateTime('2023-11-06'), "14:00");
    if (!$DentistaParceiro->getAgenda()->agendarConsulta($consulta)) {
        $DentistaCLT->getAgenda()->agendarConsulta($consulta);
        $orcamento = new Orcamento($Paciente, $DentistaCLT, $consulta->getData(), [$Limpeza, $Clareamento_a_laser, $Restauração, $Restauração]);
        $Pix->setValor(1135);
        $Crédito_de_3->setValor(1135);
        $tratamento = $orcamento->AprovarOrcamento(true, [$Pix, $Crédito_de_3]);
        $tratamento->confirmaPagamento($Pix, new DateTime('2023-11-06'));
        $tratamento->confirmaPagamento($Crédito_de_3, new DateTime('2023-11-06'));
    } else {
        $orcamento = new Orcamento($Paciente, $DentistaParceiro, $consulta->getData(), [$Limpeza, $Clareamento_a_laser, $Restauração, $Restauração]);
    }

    echo "Receita final: R$ " . number_format(calculaCustoMensal(11, 2023), 2, ',', '.') . PHP_EOL;


    $pasta = 'Classes/dataFiles';
    $arquivos = glob($pasta . '/*');
    foreach ($arquivos as $arquivo) {
        if (is_file($arquivo)) {
            unlink($arquivo);
        }
    }
}
