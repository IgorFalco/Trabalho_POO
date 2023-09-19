<?php

  include_once ('class_pessoa.php');

  class Dentista extends Pessoa {
    protected $cpf;
    protected $cro;
    protected $especialidade = [];
    protected $endereco = [];

    public function __construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $logradouro, $numero, $bairro, $cidade, $estado){
      parent::__construct($nome, $email, $telefone);
      $this->endereco = [
        'logradouro' => $logradouro,
        'numero' => $numero,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'estado' => $estado
      ];
      $this->cpf = $cpf;
      $this->cro = $cro;
      $this->especialidade = $especialidade;
    }

    public function getCPF(){
      return $this -> cpf;
    }

    public function getCRO(){
      return $this -> cro;
    }

    public function getEspec(){
      return $this -> especialidade;
    }

    public function getEndereco(){
      return $this -> endereco;
    }

    public function setCPF($novo_cpf){
      $this->cpf = $novo_cpf;
    }

    public function setCRO($novo_cro){
      $this->cro = $novo_cro;
    }

    public function setEspec($nova_espec){
      $this->especialidade = $nova_espec;
    }

    public function setEndereco($novo_logradouro, $novo_numero, $novo_bairro, $nova_cidade, $novo_estado){
      $this->endereco = [
        'logradouro' => $novo_logradouro,
        'numero' => $novo_numero,
        'bairro' => $novo_bairro,
        'cidade' => $nova_cidade,
        'estado' => $novo_estado
      ];
    }
  }
?>