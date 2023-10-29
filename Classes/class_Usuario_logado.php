<?php  
    include_once('../global.php');
    class Usuario_logado extends Usuario{

        static private $ptr_container = null;

        private function __construct(){}

        static function getInstance(){
            if ( self::$ptr_container == null ){
                self::$ptr_container = new Usuario_logado();
                echo "\n", 'Logou', "\n";
            }
            else{
                echo "\n";
                echo 'Já está logado';
                echo "\n";
            }
            return self::$ptr_container;
        }

        public function logout(){
            self::$ptr_container = null;
            echo "\n", "Deslogou", "\n";
        }

    }