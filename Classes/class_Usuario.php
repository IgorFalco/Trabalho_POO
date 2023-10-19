<?php
    include_once('../global.php');
    class Usuario extends persist{

        protected $nome;
        protected $senha;
        protected $email;
        //protected $Perfil;

        public function __construct(string $_nome, string $_senha, string $_email)
        {
            $this->nome = $_nome;
            $this->senha = $_senha;
            $this->email = $_email;
            //$this->Perfil = $_perfil;
        }

        static public function login(){
            $Logar = Usuario_logado::getInstance();
            return $Logar;
            
        }

        static public function getFilename()
        {
            return "Usuario.txt";
        }



    }
