
<?php

class Usuario extends persist
{
    private $login;
    private $senha;
    private $email;
    private $perfil;

    public function __construct(string $login, string $senha, string $email, Perfil $perfil)
    {
        $this->login = $login;
        $this->senha = $senha;
        $this->email = $email;
        $this->perfil = $perfil;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPerfil(): Perfil
    {
        return $this->perfil;
    }

    static public function getFilename()
    {
        return 'Usuarios.txt';
    }
}
