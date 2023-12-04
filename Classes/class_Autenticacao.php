<?php

class Autenticacao
{
    private static ?Autenticacao $instancia = null;
    private ?Usuario $usuarioLogado = null;

    private function __construct()
    {
        // Construtor privado para evitar instância direta
    }

    public static function getInstance(): Autenticacao
    {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function login(Usuario $usuario): bool
    {
        if ($this->usuarioLogado === null) {
            $this->usuarioLogado = $usuario;
            echo "Login realizado com sucesso para o usuário: {$usuario->getLogin()}\n";
            return true;
        } else {
            echo "Já existe um usuário logado. Faça logout antes de fazer login novamente.\n";
            return false;
        }
    }

    public function logout(): void
    {
        if ($this->usuarioLogado !== null) {
            echo "Logout realizado para o usuário: {$this->usuarioLogado->getLogin()}\n";
            $this->usuarioLogado = null;
        } else {
            echo "Nenhum usuário está atualmente logado.\n";
        }
    }

    public function getUsuarioLogado(): ?Usuario
    {
        return $this->usuarioLogado;
    }
}
