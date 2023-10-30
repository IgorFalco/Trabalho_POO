<?php
include_once('../global.php');

class ExecucaoDoTratamento extends persist
{

    private $tratamento;
    private $procedimento_realizado;
    private $data;
    private $horario;
    private $duracao;
    private $detalhamento;
    private $dentistaExecutor;
    private $status;

    public function __construct(Tratamento $_tratamento, Procedimento $_procedimento, DateTime $_data, DateTime $_horario, DateTime $_duracao, string $_detalhamento, Dentista $_dentistaExecutor)
    {
        $intersect = array_intersect($_dentistaExecutor->getEspec(), $_procedimento->getEspecialidades());
        if( empty($intersect) == 0 ){
            $this->tratamento = $_tratamento;
            $this->procedimento_realizado = $_procedimento;
            $this->data = $_data;
            $this->horario = $_horario;
            $this->duracao = $_duracao;
            $this->detalhamento = $_detalhamento;
            $this->dentistaExecutor = $_dentistaExecutor;
            $this->status = FALSE;
        }
        else{
            echo "Esse dentista não pode realizar esse procedimento";
        }
    }

    public function Tratamento_Realizado(){
        $this->status = TRUE;
    }

    static public function getFilename()
    {
        return "ExecucaoDoTratamento.txt";
    }
}


