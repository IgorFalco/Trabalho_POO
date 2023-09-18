<?php

class Endereco {
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;

    public function __construct($logradouro, $numero, $bairro, $cidade, $estado) {
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setLogradouro($novo_logradouro) {
        this->logradouro = $novo_logradouro;
    }

    public function setNumero($novo_numero) {
        this->numero = $novo_numero;
    }

    public function setBairro($novo_bairro) {
        this->bairro = $novo_bairro;
    }

    public function setCidade($nova_cidade) {
        this->cidade = $nova_cidade;
    }

    public function setEstado($novo_estado) {
        this->estado = $novo_estado;
    }
}

?>