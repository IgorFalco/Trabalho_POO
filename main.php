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
            $fachada = new ControleAcesso($usuarioAutenticado);
            $funcionalidadesDisponiveis = $fachada->listarFuncionalidadesDisponiveis();
            echo "Funcionalidades disponíveis:\n";
            foreach ($funcionalidadesDisponiveis as $funcionalidade) {
                echo "- $funcionalidade\n";
            }
        };
    } else {
        echo "Login falhou. Verifique suas credenciais.\n";
        sleep(2);
        fazerLogin();
    }
}

function main()
{
    cadastrarProcedimento();
}
main();
