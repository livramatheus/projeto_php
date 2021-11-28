<?php
namespace Src\Controllers;

use Src\Models\Departamento as ModelDepartamento;
use Src\Views\Departamento as ViewDepartamento;

class Departamento {

    public function __construct() {
        $ViewDpt = new ViewDepartamento();
        $this->gerenciaAcoes();
        
        $ViewDpt->renderTitulo();
        $this->mostraDados();
        $this->mostraFormCadastro();
    }

    private function mostraDados() {
        $ModelDpt = new ModelDepartamento();
        $ViewDpt  = new ViewDepartamento();

        $ViewDpt->listarDados($ModelDpt->getDados());
    }

    private function mostraFormCadastro() {
        $ViewDpt = new ViewDepartamento();
        $ViewDpt->montaFormularioCadastro();
    }

    private function cadastrar() {
        $ModelDpt = new ModelDepartamento();
        $ModelDpt->setNome($_POST['nome']);

        $ModelDpt->cadastrar();
    }

    private function deletar() {
        $ModelDpt = new ModelDepartamento();
        $ModelDpt->setId($_POST['reg']);

        $ModelDpt->deletar();
    }

    private function gerenciaAcoes() {
        $acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);

        switch ($acao) {
            case 'cadastrar':
                $this->cadastrar();
                break;
            case 'deletar':
                $this->deletar();
            default:
                # code...
                break;
        }
    }

}
