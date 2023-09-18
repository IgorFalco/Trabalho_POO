<?php
class ClinicaOdonto {
  private $clientes = [];
  private $pacientes = [];
  private $funcionarios = [];
  private $parceiros = [];
  
  public function cadastrarCliente(Cliente $cliente){
    $this -> clientes[] = $cliente;
  }

  public function cadastrarPaciente(Paciente $paciente){
    $this -> pacientes[] = $paciente;
  }

  public function cadastrarFuncionario(Funcionario $funcionario){
    $this -> funcionarios[] = $funcionario;
  }

  public function cadastrarParceiro(DentistaParceiro $dentistaParceiro){
    $this -> parceiros[] = $dentistaParceiro;
  }

  public function listarClientes() {
    return $this -> clientes;
  }

  public function listarPacientes() {
    return $this -> pacientes;
  }

  public function listarFuncionarios() {
    return $this -> funcionarios;
  }
  
  public function listarParceiros() {
    return $this -> parceiros;
  }
}
?>