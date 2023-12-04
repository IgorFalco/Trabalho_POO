
<?php

class ControleAcesso
{
    private $usuarioLogado = null;

    public function __construct(Usuario $usuario)
    {
        $autenticacao = Autenticacao::getInstance();
        if ($autenticacao->getUsuarioLogado() != null) {
            $this->usuarioLogado = $usuario;
        } else {
            echo "Usuário não está logado!\n";
        }
    }

    public function getuser()
    {
        return $this->usuarioLogado;
    }

    public function verificarAcesso(Funcionalidades $funcionalidade): bool
    {
        $perfil = $this->usuarioLogado->getPerfil();
        $funcionalidadesDoPerfil = $perfil->getFuncionalidades();

        foreach ($funcionalidadesDoPerfil as $funcionalidadePerfil) {
            if ($funcionalidadePerfil->getNome() === $funcionalidade->getNome()) {
                return true;
            }
        }

        return false;
    }

    public function listarFuncionalidadesDisponiveis(): ?array
    {
        if ($this->usuarioLogado != null) {
            $perfil = $this->usuarioLogado->getPerfil();
            $funcionalidadesDoPerfil = $perfil->getFuncionalidades();
            $funcionalidadesDisponiveis = [];

            foreach ($funcionalidadesDoPerfil as $funcionalidade) {
                $funcionalidadesDisponiveis[] = $funcionalidade;
            }

            return $funcionalidadesDisponiveis;
        }

        return [];
    }
}
