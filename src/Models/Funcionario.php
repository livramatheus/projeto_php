<?php

namespace Src\Models;

use Claudsonm\CepPromise\CepPromise;
use Src\Config\Db;
use PDO;

class Funcionario {

    /** @var Departamento */
    private $Departamento;

    private $id;
    private $nome;
    private $senha;
    private $cep;
    private $nascimento;

    public function getDepartamento() {
        return $this->Departamento;
    }

    public function setDepartamento($Departamento) {
        $this->Departamento = $Departamento;

        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;

        return $this;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = (int) $cep;

        return $this;
    }

    public function getNascimento() {
        return $this->nascimento;
    }

    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;

        return $this;
    }

    public function getRua() {
        return CepPromise::fetch($this->getCep())->street;
    }

    public function getDados() {
        $Db = new Db;

        $sql = "SELECT funcionarios.id,
                      funcionarios.nome,
                      funcionarios.cep,
                      funcionarios.nascimento,
                      departamentos.id as iddpto,
                      departamentos.nome as nomedpto
                 FROM funcionarios
                      JOIN departamentos ON
                      funcionarios.departamento = departamentos.id;";

        $res = $Db->getConexao()->query($sql);

        $dados = [];

        while ($linha = $res->fetch(PDO::FETCH_ASSOC)) {
            $Funcionario  = new Funcionario();
            $Departamento = new Departamento();

            $Funcionario->setId($linha['id']);
            $Funcionario->setNome($linha['nome']);
            $Funcionario->setCep($linha['cep']);
            $Funcionario->setNascimento($linha['nascimento']);

            $Departamento->setId($linha['iddpto']);
            $Departamento->setNome($linha['nomedpto']);

            $Funcionario->setDepartamento($Departamento);

            $dados[] = $Funcionario;
        }

        return $dados;
    }

    public function cadastrar() {
        $sql = "INSERT INTO funcionarios(nome, senha, cep, nascimento, departamento)
                                 VALUES (?, ?, ?, ?, ?)";

        $Db = new Db;
        $cnx = $Db->getConexao();

        $transacao = $cnx->prepare($sql);
        $transacao->execute([
            $this->getNome(),
            $this->getSenha(),
            $this->getCep(),
            $this->getNascimento(),
            $this->getDepartamento()->getId()
        ]);
    }

    public function deletar() {
        $sql = 'DELETE
                  FROM funcionarios
                 WHERE id = ?;';

        $Db = new Db;
        $cnx = $Db->getConexao();

        $transacao = $cnx->prepare($sql);
        $transacao->execute([$this->getId()]);
    }
}
