<?php

namespace Src\Controllers;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Src\Models\Funcionario as ModelFuncionario;
use Src\Models\Departamento as ModelDepartamento;
use Src\Views\Funcionario as ViewFuncionario;

class Funcionario {

    public function __construct() {
        $this->gerenciaAcoes();

        $ViewFuncionario = new ViewFuncionario();
        $ViewFuncionario->renderTitulo();
        $this->mostraDados();
        $this->mostraFormCadastro();
    }

    private function mostraFormCadastro() {
        $ViewFuncionario = new ViewFuncionario();
        $ViewFuncionario->montaFormularioCadastro();
    }

    private function mostraDados() {
        $ModelFuncionario = new ModelFuncionario();
        $ViewFuncionario  = new ViewFuncionario();

        $ViewFuncionario->listarDados($ModelFuncionario->getDados());
    }

    private function deletar() {
        $ModelFuncionario = new ModelFuncionario();
        $ModelFuncionario->setId($_POST['reg']);

        $ModelFuncionario->deletar();
    }

    private function cadastrar() {
        $ModelFuncionario  = new ModelFuncionario();
        $ModelDepartamento = new ModelDepartamento();
        $PwdGen = new ComputerPasswordGenerator();

        $ModelFuncionario->setNome($_POST['nome']);
        $ModelFuncionario->setSenha($PwdGen->generatePassword());
        $ModelFuncionario->setCep($_POST['cep']);
        $ModelFuncionario->setNascimento($_POST['nascimento']);

        $ModelDepartamento->setId($_POST['dpto']);

        $ModelFuncionario->setDepartamento($ModelDepartamento);

        $ModelFuncionario->cadastrar();
    }

    private function gerenciaAcoes() {
        $acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);

        switch ($acao) {
            case 'cadastrar':
                $this->cadastrar();
                break;
            case 'deletar':
                $this->deletar();
                break;
            
            default:
                # code...
                break;
        }

    }

}
