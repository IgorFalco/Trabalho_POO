<?php

  include_once ('class_pessoa.php');

  class DentistaParceiro extends Pessoa {
    protected $cpf;
    protected $cro;
    protected $especialidade = [];
    protected $endereco = [];
    protected $comissao;
    protected $percComissao;

    public function __construct($nome, $email, $telefone, $cpf, $cro, $especialidade, $percComissao, $logradouro, $numero, $bairro, $cidade, $estado){
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
      $this->percComissao = $percComissao;
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

    public function getEndere(){
    return $this -> endereco;
    }

    public function getComissao(){
    return $this -> comissao;
    }

    public function getPercComissao(){
    return $this -> percComissao;
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

    public function addComissao($nova_comissao){
      $this->comissao += $this->percComissao * $nova_comissao;
    }

    public function resetComissao(){
      $this->comissao = 0;
    }
  }
?>