<?php 
include_once('./class_pessoa.php');
include_once('./global.php');

class Funcionario extends Pessoa {
  protected $cpf;
  protected $endereco = [];
  protected $salariofixo;

  public function __construct($nome, $email, $telefone, $cpf, $logradouro, $numero, $bairro, $cidade, $estado, $salariofixo){
    parent::__construct($nome, $email, $telefone)
    $this->cpf = $cpf;
    $this->endereco = [
      'logradouro' => $logradouro,
      'numero' => $numero,
      'bairro' => $bairro,
      'cidade' => $cidade,
      'estado' => $estado
    ];
    $this->salariofixo = $salariofixo
  }
}
?>