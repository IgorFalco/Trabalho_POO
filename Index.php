<?php

include_once('global.php');


function verificaCadastro(string $login, string $senha): ?Usuario
{
    // Obtém todos os registros de usuários
    $usuarios = Usuario::getRecords();

    // Verifica se há um usuário com o login fornecido
    foreach ($usuarios as $usuario) {
        if ($usuario->getLogin() === $login && $usuario->getSenha() === $senha) {
            return $usuario;
        }
    }

    // Retorna nulo se não encontrar um usuário correspondente
    return null;
}

function fazerLogin()
{
    $autenticacao = Autenticacao::getInstance();

    echo "Digite seu login: ";
    $login = trim(fgets(STDIN));

    echo "Digite sua senha: ";
    $senha = trim(fgets(STDIN));

    $usuarioAutenticado = verificaCadastro($login, $senha);

    if ($usuarioAutenticado) {
        if ($autenticacao->login($usuarioAutenticado)) {
            echo "Bem vindo " . $usuarioAutenticado->getLogin();
        } else {
            echo "Login falhou. Verifique suas credenciais.\n";
            sleep(2);
            fazerLogin();
        }
    }
}

function atualizaFuncionalidades()
{
    // Substitua 'caminho/do/seu/arquivo.json' pelo caminho real do seu arquivo JSON
    $jsonFilePath = 'Funcionalidades.json';

    // Lê o conteúdo do arquivo
    $jsonData = file_get_contents($jsonFilePath);

    // Decodifica o JSON
    $data = json_decode($jsonData, true);

    // Verifica se a decodificação foi bem-sucedida
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        die('Erro ao decodificar o JSON.');
    }

    // Itera sobre as funções e instancia a classe Especialidade
    foreach ($data['funcoes'] as $funcao) {
        $Funcionalidade = new Funcionalidades($funcao); // Substitua com os valores desejados
        $Funcionalidade->save();
    }
}

function CleanBanco()
{
    //LIMPA O BANCO 

    $pasta = 'Classes/dataFiles';
    $arquivos = glob($pasta . '/*');
    foreach ($arquivos as $arquivo) {
        if (is_file($arquivo)) {
            unlink($arquivo);
        }
    }
}

function main()
{
    CleanBanco(); //LIMPA O BANCO 

    $Perfil = new Perfil("Administrador", [
        "CalculaCustoMensal",
        "CadastrarDentista",
        "CadastrarCliente",
        "CadastrarPaciente",
        "CadastrarDentistaParceiro",
        "CadastrarNovoOrcamento",
        "CadastrarProcedimentos",
        "Logout"
    ]);
    new Usuario("Admim", "Admim", "Administrador@gmail.com", $Perfil);
    fazerLogin();

    $autenticacao = Autenticacao::getInstance();

    $Controle = new ControleAcesso($autenticacao->getUsuarioLogado());

    while (1) {
        $funcionalidadesDisponiveis = $Controle->listarFuncionalidadesDisponiveis();
        echo "\nFuncionalidades disponíveis:\n";
        foreach ($funcionalidadesDisponiveis as $index => $funcionalidade) {
            $indexaux = $index + 1;
            echo "$indexaux. {$funcionalidade}\n";
        }
        $indiceEscolhido = readline("Escolha a funcionalidade (digite o número correspondente): ");

        if (isset($funcionalidadesDisponiveis[$indiceEscolhido - 1])) {
            // Obtendo a especialidade escolhida pelo usuário
            $Controle->escolhaFuncoes($funcionalidadesDisponiveis[$indiceEscolhido - 1]);
        } else {
            echo "Índice inválido. Por favor, escolha um número válido.\n";
        }
    };
}

main();

