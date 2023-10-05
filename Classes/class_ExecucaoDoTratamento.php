<?php
include_once('global.php');

class ExecucaoDoTratamento extends persist
{

    private $tratamento;
    private $data;
    private $horario;
    private $duracao;
    private $detalhamento;
    private $dentisaExecutor;

    public function __construct(Tratamento $_tratamento, DateTime $_data, DateTime $_horario, DateTime $_duracao, String $_Detalhamento, Dentista $_dentistaExecutor)
    {

        $this->tratamento = $_tratamento;
        $this->data = $_data;
        $this->horario = $_horario;
        $this->detalhamento = $_duracao;
        $this->detalhamento = $_Detalhamento;
        $this->dentisaExecutor = $_dentistaExecutor;
    }

    static public function getFilename()
    {
        return "ExecucaoDoTratamento.txt";
    }
}
