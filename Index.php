<?php

include_once('global.php');
include_once('Funcoes.php');


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

function fazerLogin(): ?string
{
    $autenticacao = Autenticacao::getInstance();

    echo "Digite seu login: ";
    $login = trim(fgets(STDIN));

    echo "Digite sua senha: ";
    $senha = trim(fgets(STDIN));

    $usuarioAutenticado = verificaCadastro($login, $senha);

    if ($usuarioAutenticado) {
        if ($autenticacao->login($usuarioAutenticado)) {
            $fachada = new ControleAcesso($usuarioAutenticado);
            $funcionalidadesDisponiveis = $fachada->listarFuncionalidadesDisponiveis();
            echo "Funcionalidades disponíveis:\n";
            foreach ($funcionalidadesDisponiveis as $index => $funcionalidade) {
                $indexaux = $index + 1;
                echo "$indexaux. {$funcionalidade}\n";
            }
            $indiceEscolhido = readline("Escolha a funcionalidade (digite o número correspondente): ");

            if (isset($funcionalidadesDisponiveis[$indiceEscolhido - 1])) {
                // Obtendo a especialidade escolhida pelo usuário
                return $funcionalidadesDisponiveis[$indiceEscolhido - 1];
            } else {
                echo "Índice inválido. Por favor, escolha um número válido.\n";
            }
        };
    } else {
        echo "Login falhou. Verifique suas credenciais.\n";
        sleep(2);
        fazerLogin();
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

function main()
{
    // $Perfil = new Perfil("Administrador",[
    //     "CalculaCustoMensal",
    //     "CadastrarDentista",
    //     "CadastrarCliente",
    //     "CadastrarPaciente",
    //     "CadastrarDentistaParceiro",
    //     "CadastrarNovoOrcamento",
    //     "CadastrarProcedimentos",
    //     "Logout"
    // ]);
    // $user = new Usuario("Admim", "Admim", "Administrador@gmail.com", $Perfil);
    // $funcao = fazerLogin();

    // escolhaFuncoes($funcao);
}

main();
