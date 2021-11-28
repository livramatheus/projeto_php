<?php

namespace Src\Views;

class Funcionario {

    public function renderTitulo() {
        echo '<h1>Funcinários</h1>';
    }

    public function listarDados($dados) {
        echo '<table border="1"s>';
        echo '    <tr>';
        echo '        <th>Código</th>';
        echo '        <th>Nome</th>';
        echo '        <th>Nascimento</th>';
        echo '        <th>Rua</th>';
        echo '        <th>Código Departamento</th>';
        echo '        <th>Nome Departamento</th>';
        echo '        <th>Ações</th>';
        echo '    </tr>';
        echo '    <tr>';

        foreach ($dados as $ModelFuncionario) {
            echo '    <tr>';
            echo '        <td>' . $ModelFuncionario->getId() . '</td>';
            echo '        <td>' . $ModelFuncionario->getNome() . '</td>';
            echo '        <td>' . $ModelFuncionario->getNascimento() . '</td>';
            echo '        <td>' . $ModelFuncionario->getRua() . '</td>';
            echo '        <td>' . $ModelFuncionario->getDepartamento()->getId() . '</td>';
            echo '        <td>' . $ModelFuncionario->getDepartamento()->getNome() . '</td>';
            echo '        <td>';
            echo '            <form method="POST" action="?p=funcionario&acao=deletar">
                                  <button type="submit" name="reg" value="' . $ModelFuncionario->getId() . '" >Deletar</button>
                              </form>';
            echo '        </td>';
            echo '    </tr>';
        }

        echo '    </tr>';
        echo '</table>';
    }

    public function montaFormularioCadastro() {
?>
        <form method="POST" action="?p=funcionario&acao=cadastrar">
            <div>
                <strong>Nome do Funcionario: </strong>
            </div>
            <div>
                <input type="text" name="nome" required />
            </div>
            <div>
                <strong>CEP do Funcionario: </strong>
            </div>
            <div>
                <input type="text" name="cep" required />
            </div>
            <div>
                <strong>Data de Nascimento: </strong>
            </div>
            <div>
                <input type="date" name="nascimento" required />
            </div>
            <div>
                <strong>Departamento do Funcionario: </strong>
            </div>
            <div>
                <input type="number" name="dpto" required />
            </div>
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
<?php
    }
}
