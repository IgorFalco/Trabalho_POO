<?php

include_once('global.php');

class Tratamento extends Orcamento
{

    private $formaDePagamento = [];
    private $procedimentosExecucao = [];
    private $valorFaturado = 0;
    private $taxa_cartao = [];
    private $impostos;
    private $receita;
    private bool $tratamentoQuitado = false;
    private $listapagamento_efetuado = [];
    private $DataPagamento;


    public function __construct(Paciente $paciente, Dentista $dentista, DateTime $data, array $procedimento, array $formaDePagamento)
    {
        parent::__construct($paciente, $dentista, $data, $procedimento);

        $this->formaDePagamento = $formaDePagamento;
        $this->impostos = 0.0;
        $this->receita = 0.0;
        $this->DataPagamento = $data;

        foreach ($procedimento as $procedimentos) {
            $this->valorFaturado += $procedimentos->getValor();
        }
        foreach ($formaDePagamento as $pagamento) {
           
            $this->taxa_cartao[] = $pagamento->getValor() * (($pagamento->getTaxa())/100);
        }
        foreach ($formaDePagamento as $pagamento) {
            $this->listapagamento_efetuado[$pagamento->getNome()] = false;
        }

        $this->save();
    }
    

    public function marcaExecucao(Procedimento $procedimento, DateTime $data, DateTime $horario, Dentista $dentistaExecutor)
    {
        $execucao = new ExecucaoDoProcedimento($this, $procedimento, $data, $horario, $dentistaExecutor);

        array_push($procedimentosExecucao, $execucao);
    }

    public function confirmaPagamento(FormaDePagamento $pagamento, DateTime $data)
    {
        global $TaxaImposto;
        $this->listapagamento_efetuado[$pagamento->getNome()] = true;
        $this->impostos +=  ($TaxaImposto / 100) * $pagamento->getValor();
        $this->DataPagamento = $data;
    }

    public function calculaValores(): float
    {
        $taxa = 0;
        foreach ($this->listapagamento_efetuado as $pagamentos) {
            $this->tratamentoQuitado = true;
            if ($pagamentos == false)
                $this->tratamentoQuitado = false;
        }
        foreach ($this->taxa_cartao as $taxaTotal) {
            $taxa += $taxaTotal;
        }
        $this->receita = $this->valorFaturado - $taxa - $this->impostos;

        return $this->receita;
    }

    public function verificaProcedimentos(): bool
    {
        $status = true;
        foreach ($this->procedimentosExecucao as $procedimentoListado) {
            if ($procedimentoListado->getStatus() == false)
                $status = false;
            break;
        }
        return $status;
    }

    public function getFormaDePagamento(): array
    {
        return $this->formaDePagamento;
    }

    public function getQuitado(): bool
    {
        return $this->tratamentoQuitado;
    }

    public function getDataPagamento(): DateTime
    {
        return $this->DataPagamento;
    }

    public function setFormaDePagamento(FormaDePagamento $Pagamento)
    {
        $this->formaDePagamento = $Pagamento;
        $this->taxa_cartao = $Pagamento->getTaxa();
    }

    static public function getFilename()
    {
        return 'Tratamentos.txt';
    }
}
