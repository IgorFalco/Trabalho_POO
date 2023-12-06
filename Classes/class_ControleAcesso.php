
<?php

class ControleAcesso
{
    public $usuarioLogado = null;

    public function __construct(Usuario $usuario)
    {
        $autenticacao = Autenticacao::getInstance();
        if ($autenticacao->getUsuarioLogado() != null && $usuario == $autenticacao->getUsuarioLogado()) {
            $this->usuarioLogado = $usuario;
        } else {
            echo "Usuário não está logado!\n";
        }
    }

    public function getuser()
    {
        return $this->usuarioLogado;
    }

    public function verificarAcesso(string $funcionalidade): bool
    {

        $perfil = $this->usuarioLogado->getPerfil();
        $funcionalidadesDoPerfil = $perfil->getFuncionalidades();

        foreach ($funcionalidadesDoPerfil as $funcionalidadePerfil) {
            if ($funcionalidadePerfil->getNome() === $funcionalidade) {
                return true;
            }
        }

        return false;
    }
    public function verificaValidadeUsuario(string $func)
    {
        if ($this->usuarioLogado == null) {
            echo "Usuário não está logado\n";
            return false;
        } else {
            if ($this->verificarAcesso($func)) {
                return true;
            } else {
                echo "Usuário não possuí acesso\n";
            }
        }
    }

    public function listarFuncionalidadesDisponiveis(): ?array
    {
        if ($this->usuarioLogado != null) {
            $perfil = $this->usuarioLogado->getPerfil();
            $funcionalidadesDoPerfil = $perfil->getFuncionalidades();
            $funcionalidadesDisponiveis = [];

            foreach ($funcionalidadesDoPerfil as $funcionalidade) {
                $funcionalidadesDisponiveis[] = $funcionalidade;
            }

            return $funcionalidadesDisponiveis;
        }

        echo "Usuário não está logado!\n";

        return [];
    }

    public function calculaCustoMensal(int $mes, int $ano): float
    {
        if ($this->verificaValidadeUsuario("CalculaCustoMensal")) {


            $salarioTotal = 0;
            $receitaTotal = 0;

            // Dentistas
            $dentistas = Dentista::getRecords();
            foreach ($dentistas as $dentista) {
                $salarioTotal += $dentista->getSalario();
            }

            // Dentistas Parceiros
            $dentistasParceiros = DentistaParceiro::getRecords();
            foreach ($dentistasParceiros as $dentistaParceiro) {
                $salarioTotal += $dentistaParceiro->calcularSalarioMensal($mes, $ano);
            }
            // Auxiliares
            $auxiliares = Auxiliares::getRecords();
            foreach ($auxiliares as $auxiliar) {
                $salarioTotal += $auxiliar->getSalario();
            }

            // Secretários
            $secretarios = Secretario::getRecords();
            foreach ($secretarios as $secretario) {
                $salarioTotal += $secretario->getSalario();
            }

            // Carregar os dados existentes dos tratamentos
            $tratamentos = Tratamento::getRecords();


            // Iterar sobre os tratamentos
            foreach ($tratamentos as $tratamento) {

                // Verificar se o tratamento foi quitado no mês e ano desejados
                if ($tratamento->getDataPagamento()->format('m') == $mes && $tratamento->getDataPagamento()->format('Y') == $ano) {
                    // Adicionar a receita do tratamento à receita total
                    $receitaTotal += $tratamento->calculaValores();
                }
            }

            return $receitaTotal - $salarioTotal;
        }
    }

    public function cadastrarDentistaManualmente()
    {
        if ($this->verificaValidadeUsuario("CadastrarDentista")) {

            // Exibindo opções disponíveis para especialidade
            $especialidades = Especialidade::getRecords();
            echo "Especialidades disponíveis:\n";
            foreach ($especialidades as $index => $especialidade) {
                echo "$index. {$especialidade->getNome()}\n";
            }

            $indiceEscolhido = readline("Escolha a especialidade (digite o número correspondente): ");

            if (isset($especialidades[$indiceEscolhido])) {
                // Obtendo a especialidade escolhida pelo usuário
                $especialidadeEscolhida = $especialidades[$indiceEscolhido];
            } else {
                echo "Índice inválido. Por favor, escolha um número válido.\n";
            }

            // Criar array com todos os dados
            $dadosDentista = [
                'nome' => readline("Nome: "),
                'email' => readline("Email: "),
                'telefone' => readline("Telefone: "),
                'cpf' => readline("CPF: "),
                'cro' => readline("CRO: "),
                'especialidade' => $especialidades[$especialidadeEscolhida],
                'salario' => readline("Salário: "),
                'logradouro' => readline("Logradouro: "),
                'numero' => readline("Número: "),
                'bairro' => readline("Bairro: "),
                'cidade' => readline("Cidade: "),
                'estado' => readline("Estado: "),
                'login' => readline("Login: "),
                'senha' => readline("Senha: "),
            ];

            $this->cadastrarDentista($dadosDentista);

            echo "Dentista cadastrado com sucesso!\n";
        }
    }

    public function cadastrarDentista(array $dadosDentista)
    {
        if ($this->verificaValidadeUsuario("CadastrarDentista")) {

            $dentista = new Dentista(
                $dadosDentista['nome'],
                $dadosDentista['email'],
                $dadosDentista['telefone'],
                $dadosDentista['cpf'],
                $dadosDentista['cro'],
                $dadosDentista['especialidade'],
                $dadosDentista['salario'],
                $dadosDentista['logradouro'],
                $dadosDentista['numero'],
                $dadosDentista['bairro'],
                $dadosDentista['cidade'],
                $dadosDentista['estado'],
                $dadosDentista['login'],
                $dadosDentista['senha'],
                $dadosDentista['perfil']
            );

            // Criando objeto de agenda
            $agenda = new Agenda($dentista);
            $dentista->addAgenda($agenda);

            return $dentista;
        }
    }

    public function cadastrarClienteManualmente()
    {
        if ($this->verificaValidadeUsuario("CadastrarCliente")) {


            // Obtendo dados do usuário
            $dadosCliente = [
                'nome' => readline("Nome: "),
                'email' => readline("Email: "),
                'telefone' => readline("Telefone: "),
                'cpf' => readline("CPF: "),
                'rg' => readline("RG: "),
            ];

            $this->cadastrarCliente($dadosCliente);

            echo "Cliente cadastrado com sucesso!\n";
        }
    }

    public function cadastrarCliente(array $dadosCliente)
    {
        if ($this->verificaValidadeUsuario("CadastrarCliente")) {


            return new Cliente(
                $dadosCliente['nome'],
                $dadosCliente['email'],
                $dadosCliente['telefone'],
                $dadosCliente['cpf'],
                $dadosCliente['rg'],
                []
            );
        }
    }

    public function cadastrarPacienteManualmente()
    {
        if ($this->verificaValidadeUsuario("CadastrarPaciente")) {




            // Obtendo responsáveis financeiros disponíveis
            $responsaveisFinanceiros = Cliente::getRecords();
            // Verificando se existem responsáveis financeiros
            if (empty($responsaveisFinanceiros)) {
                echo "Não há responsáveis financeiros disponíveis. Cadastre um responsável financeiro primeiro.\n";
                return;
            }

            // Exibindo responsáveis financeiros disponíveis
            echo "Responsáveis Financeiros Disponíveis:\n";
            foreach ($responsaveisFinanceiros as $index => $responsavel) {
                echo "$index. " . $responsavel->getNome() . "\n";
            }

            // Solicitando ao usuário escolher um responsável financeiro
            $indiceResponsavel = (int)readline("Escolha o número correspondente ao responsável financeiro: ");

            // Verificando se o índice é válido
            if (!isset($responsaveisFinanceiros[$indiceResponsavel])) {
                echo "Índice inválido. Operação cancelada.\n";
                return;
            }

            // Obtendo o responsável financeiro escolhido
            $responsavelEscolhido = $responsaveisFinanceiros[$indiceResponsavel];

            // Obtendo dados do paciente
            $dadosPaciente = [
                'nome' => readline("Nome: "),
                'email' => readline("Email: "),
                'telefone' => readline("Telefone: "),
                'data_nascimento' => readline("Data de Nascimento (formato: Y-m-d): "),
                'rg' => readline("RG: "),
                'reponsavel' => $responsavelEscolhido,
            ];

            $this->cadastrarPaciente($dadosPaciente);

            echo "Paciente cadastrado com sucesso!\n";
        }
    }

    public function cadastrarPaciente(array $dadosPaciente)
    {
        if ($this->verificaValidadeUsuario("CadastrarPaciente")) {
            // Criando objeto de data de nascimento
            $dataNascimento = DateTime::createFromFormat('Y-m-d', $dadosPaciente['data_nascimento']);

            // Criando o objeto do paciente
            return new Paciente(
                $dadosPaciente['nome'],
                $dadosPaciente['email'],
                $dadosPaciente['telefone'],
                $dataNascimento,
                $dadosPaciente['rg'],
                $dadosPaciente['responsavel'],
            );
        }
    }

    public function cadastrarProcedimentoManualmente()
    {
        if ($this->verificaValidadeUsuario("CadastrarProcedimento")) {


            // Obtém a lista de especialidades
            $especialidades = Especialidade::getRecords();

            // Exibe a lista de especialidades para o usuário escolher
            echo "Especialidades Disponíveis:\n";
            foreach ($especialidades as $index => $especialidade) {
                echo "$index. {$especialidade->getNome()}\n";
            }

            // Solicita ao usuário que escolha as especialidades pelo número
            echo "Escolha os números correspondentes às especialidades (separados por vírgula): ";
            $indicesEspecialidades = array_map('intval', explode(',', readline()));

            // Verifica se os índices fornecidos pelo usuário são válidos
            foreach ($indicesEspecialidades as $index) {
                if ($index < 0 || $index >= count($especialidades)) {
                    echo "Índice $index é inválido. Operação cancelada.\n";
                    return;
                }
            }

            // Obtém os detalhes das especialidades escolhidas
            $especialidadesEscolhidas = array_map(function ($index) use ($especialidades) {
                return $especialidades[$index];
            }, $indicesEspecialidades);

            // Solicita ao usuário outras informações necessárias
            echo "Nome do procedimento: ";
            $nome = readline();

            echo "Descrição do procedimento: ";
            $descricao = readline();

            echo "Valor do procedimento: ";
            $valor = floatval(readline());

            echo "Número de consultas: ";
            $numeroConsultas = intval(readline());

            echo "Duração do procedimento (em minutos): ";
            $duracao = intval(readline());

            // Cria o objeto Procedimento
            $proc = new Procedimento($nome, $descricao, $valor, $especialidadesEscolhidas, $numeroConsultas, $duracao);

            $dadosPorc = [
                'nome' => $nome,
                'descricao' => $descricao,
                'valor' => $valor,
                'especialidadesEscolhidas' => $especialidadesEscolhidas,
                'numeroConsultas' => $numeroConsultas,
                'duracao' => $duracao,
            ];

            $this->cadastrarProcedimento($dadosPorc);
            echo "Procedimento cadastrado com sucesso!\n";
        }
    }

    public function cadastrarProcedimento(array $dadosProcedimento)
    {
        if ($this->verificaValidadeUsuario("CadastrarProcedimento")) {


            return new Procedimento(
                $dadosProcedimento['nome'],
                $dadosProcedimento['descricao'],
                $dadosProcedimento['valor'],
                $dadosProcedimento['especialidadesEscolhidas'],
                $dadosProcedimento['numeroConsultas'],
                $dadosProcedimento['duracao'],
            );
        }
    }
    public function cadastrarDentistaParceiroManualmente()
    {
        if (!$this->verificaValidadeUsuario("cadastrarDentista")) return;
        // Exibindo opções disponíveis para especialidade
        $especialidades = Especialidade::getRecords();
        echo "Especialidades disponíveis:\n";
        foreach ($especialidades as $index => $especialidade) {
            echo "$index. {$especialidade->getNome()}\n";
        }

        $indiceEscolhido = readline("Escolha a especialidade (digite o número correspondente): ");

        if (isset($especialidades[$indiceEscolhido])) {
            // Obtendo a especialidade escolhida pelo usuário
            $especialidadeEscolhida = $especialidades[$indiceEscolhido];
        } else {
            echo "Índice inválido. Por favor, escolha um número válido.\n";
        }

        // Exibindo opções disponíveis para perfil
        $perfils = Perfil::getRecords();
        echo "Especialidades disponíveis:\n";
        foreach ($perfils as $index => $perfil) {
            echo "$index. {$perfil->getNome()}\n";
        }

        $indiceEscolhido = readline("Escolha a especialidade (digite o número correspondente): ");

        if (isset($perfils[$indiceEscolhido])) {
            // Obtendo a especialidade escolhida pelo usuário
            $perfilEscolhido = $perfils[$indiceEscolhido];
        } else {
            echo "Índice inválido. Por favor, escolha um número válido.\n";
        }

        // Obtendo dados do dentista parceiro
        $dadosDentistaParceiro = [
            'valorPorcentagem' => (float)readline("Valor da Porcentagem: "),
            'nome' => readline("Nome: "),
            'email' => readline("Email: "),
            'telefone' => readline("Telefone: "),
            'cpf' => readline("CPF: "),
            'cro' => readline("CRO: "),
            'especialidade' => [$especialidadeEscolhida], // Considerando que você tenha um método para obter especialidades disponíveis
            'salario' => (float)readline("Salário: "),
            'logradouro' => readline("Logradouro: "),
            'numero' => readline("Número: "),
            'bairro' => readline("Bairro: "),
            'cidade' => readline("Cidade: "),
            'estado' => readline("Estado: "),
            'login' => readline("Login: "),
            'senha' => readline("Senha: "),
            'perfil' => $perfilEscolhido, // Considerando que você tenha um método para obter perfis disponíveis
        ];

        $this->cadastrarDentistaParceiro($dadosDentistaParceiro);

        echo "Dentista Parceiro cadastrado com sucesso!\n";
    }

    public function cadastrarDentistaParceiro(array $dadosDentistaParceiro)
    {

        if (!$this->verificaValidadeUsuario("cadastrarDentista")) return;
        // Criando objeto de perfil
        $perfil = new Perfil($dadosDentistaParceiro['perfil'], []); // Substitua Perfil pela classe correta

        // Criando objeto de dentista parceiro
        $dentistaParceiro = new DentistaParceiro(
            $dadosDentistaParceiro['valorPorcentagem'],
            $dadosDentistaParceiro['nome'],
            $dadosDentistaParceiro['email'],
            $dadosDentistaParceiro['telefone'],
            $dadosDentistaParceiro['cpf'],
            $dadosDentistaParceiro['cro'],
            $dadosDentistaParceiro['especialidade'],
            $dadosDentistaParceiro['salario'],
            $dadosDentistaParceiro['logradouro'],
            $dadosDentistaParceiro['numero'],
            $dadosDentistaParceiro['bairro'],
            $dadosDentistaParceiro['cidade'],
            $dadosDentistaParceiro['estado'],
            $dadosDentistaParceiro['login'],
            $dadosDentistaParceiro['senha'],
            $perfil,
        );

        // Criando objeto de agenda
        $agenda = new Agenda($dentistaParceiro);
        $dentistaParceiro->addAgenda($agenda);

        return $dentistaParceiro;
    }

    public function cadastrarNovoOrcamentoManualmente()
    {
        if (!$this->verificaValidadeUsuario("CadastrarNovoOrcamento")) return;
        $pacientes = Paciente::getRecords();
        echo "Especialidades disponíveis:\n";
        foreach ($pacientes as $index => $paciente) {
            echo "$index. {$paciente->getNome()}\n";
        }

        $indiceEscolhido = readline("Escolha a especialidade (digite o número correspondente): ");

        if (isset($pacientes[$indiceEscolhido])) {
            // Obtendo a especialidade escolhida pelo usuário
            $pacienteEscolhido = $pacientes[$indiceEscolhido];
        } else {
            echo "Índice inválido. Por favor, escolha um número válido.\n";
        }

        echo "O dentista é parceiro\n?";

        $escolha = readline("1. Sim\n 2.Não \n");

        switch ($escolha) {
            case 1:
                $dentistas = Dentista::getRecords();
                echo "Dentistas disponíveis:\n";
                foreach ($dentistas as $index => $dentista) {
                    echo "$index. {$dentista->getNome()}\n";
                }

                $indiceEscolhido = readline("Escolha a especialidade (digite o número correspondente): ");

                if (isset($dentista[$indiceEscolhido])) {
                    // Obtendo a especialidade escolhida pelo usuário
                    $dentistaescolhido = $dentista[$indiceEscolhido];
                } else {
                    echo "Índice inválido. Por favor, escolha um número válido.\n";
                }
                break;
            case 2:
                $dentistas = DentistaParceiro::getRecords();
                echo "Dentistas disponíveis:\n";
                foreach ($dentistas as $index => $dentista) {
                    echo "$index. {$dentista->getNome()}\n";
                }

                $indiceEscolhido = readline("Escolha a especialidade (digite o número correspondente): ");

                if (isset($dentista[$indiceEscolhido])) {
                    // Obtendo a especialidade escolhida pelo usuário
                    $dentistaescolhido = $dentista[$indiceEscolhido];
                } else {
                    echo "Índice inválido. Por favor, escolha um número válido.\n";
                }
                break;
        }

        // Obtendo dados para o novo orçamento
        $dadosOrcamento = [
            'paciente' => $pacienteEscolhido,
            'dentista' => $dentistaescolhido,
            'procedimentos' => $this->selecionarProcedimentos(),
            'dataOrcamento' => readline("Digite a data do orçamento (Formato: YYYY-MM-DD): "),
        ];

        $this->cadastrarNovoOrcamento($dadosOrcamento);

        echo "Orçamento cadastrado com sucesso!\n";
    }

    public function selecionarProcedimentos()
    {
        // Obter procedimentos disponíveis usando o método getRecords da classe Procedimento
        $procedimentos = Procedimento::getRecords();

        $procedimentosSelecionados = [];

        echo "Escolha os procedimentos (Digite os números separados por vírgula):\n";
        foreach ($procedimentos as $index => $procedimento) {
            echo "{$index}. {$procedimento->getNome()}\n";
        }

        $input = readline("Digite os números dos procedimentos selecionados: ");
        $indicesSelecionados = explode(',', $input);

        // Adicionar procedimentos selecionados ao array final
        foreach ($indicesSelecionados as $indice) {
            $indice = intval($indice) - 1;
            if (isset($procedimentos[$indice])) {
                $procedimentosSelecionados[] = $procedimentos[$indice];
            }
        }

        return $procedimentosSelecionados;
    }

    public function cadastrarNovoOrcamento(array $dadosOrcamento)
    {
        if (!$this->verificaValidadeUsuario("CadastrarNovoOrcamento")) return;

        // Obter paciente e dentista responsável usando o índice fornecido
        $paciente = $dadosOrcamento['paciente'];
        $dentista = $dadosOrcamento['dentista'];

        // Obter procedimentos selecionados
        $procedimentos = $dadosOrcamento['procedimentos'];

        // Criar objeto de orçamento
        return new Orcamento($paciente, $dentista, new DateTime($dadosOrcamento['dataOrcamento']), $procedimentos);
    }

    public function criarConsulta(array $dadosConsulta)
    {
        $paciente = $dadosConsulta['paciente'];
        $dentistaAvaliador = $dadosConsulta['dentista'];
        $valorConsulta = $dadosConsulta['valor'];
        $data = $dadosConsulta['data'];
        $horario = $dadosConsulta['horario'];

        return new ConsultaAvaliacao($paciente,  $dentistaAvaliador,  $valorConsulta,  $data,  $horario);
    }

    public function escolhaFuncoes(string $funcaoEscolhida)
    {
        switch ($funcaoEscolhida) {
            case "CalculaCustoMensal":

                $mes = (int)readline("Digite o número do mês: ");
                $ano = (int)readline("Digite o número do ano: ");
                echo "Custo Mensal: " . $this->calculaCustoMensal($mes, $ano);
                break;
            case "CadastrarDentista":
                $this->cadastrarDentistaManualmente();
                break;

            case "CadastrarDentistaParceiro":
                $this->cadastrarDentistaParceiroManualmente();
                break;
            case "CadastrarCliente":
                $this->cadastrarClienteManualmente();
                break;
            case "CadastrarPaciente":
                $this->cadastrarPacienteManualmente();
                break;
            case "CadastrarNovoOrcamento":
                $this->cadastrarNovoOrcamentoManualmente();
                break;
            case "CadastrarProcedimento":
                $this->cadastrarProcedimentoManualmente();
                break;
            case "Logout":
                $autenticacao = Autenticacao::getInstance();
                $autenticacao->logout();
                exit;
                break;
        }
    }
}
