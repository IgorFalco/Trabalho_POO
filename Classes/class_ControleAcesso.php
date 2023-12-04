
<?php

class ControleAcesso
{
    private $usuarioLogado;

    public function __construct(Usuario $usuario)
    {
        $this->usuarioLogado = $usuario;
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

    public function listarFuncionalidadesDisponiveis(): array
    {
        $perfil = $this->usuarioLogado->getPerfil();
        $funcionalidadesDoPerfil = $perfil->getFuncionalidades();
        $funcionalidadesDisponiveis = [];

        foreach ($funcionalidadesDoPerfil as $funcionalidade) {
            $funcionalidadesDisponiveis[] = $funcionalidade->getNome();
        }

        return $funcionalidadesDisponiveis;
    }
}
