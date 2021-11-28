<?php

namespace Src\Models;
use Src\Config\Db, PDO;

class Departamento {

    private $id;
    private $nome;

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

    public function cadastrar() {
        $sql = 'INSERT INTO departamentos (nome)
                                  VALUES (?);';

        $Db = new Db;
        $cnx = $Db->getConexao();

        $transaction = $cnx->prepare($sql);
        $transaction->execute([$this->getNome()]);
    }

    public function deletar() {
        $sql = 'DELETE
                  FROM departamentos
                 WHERE id = ?;';
        
        $Db = new Db;
        $cnx = $Db->getConexao();

        $transaction = $cnx->prepare($sql);

        $transaction->execute([$this->getId()]);
    }

    public function getDados() {
        $Db = new Db;
        
        $sql= 'SELECT *
                 FROM departamentos;';

        $res = $Db->getConexao()->query($sql);

        $dados = [];

        while($linha = $res->fetch(PDO::FETCH_ASSOC)) {
            $dpt = new Departamento();

            $dpt->setId($linha['id']);
            $dpt->setNome($linha['nome']);

            $dados[] = $dpt;
        }

        return $dados;
    }

}
