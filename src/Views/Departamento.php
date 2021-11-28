<?php

namespace Src\Views;

class Departamento {

    public function renderTitulo() {
        echo '<h1>Departamentos</h1>';
    }

    public function listarDados($dados) {
        echo '<table border="1"s>';
        echo '    <tr>';
        echo '        <th>Código</th>';
        echo '        <th>Nome</th>';
        echo '        <th>Ações</th>';
        echo '    </tr>';
        echo '    <tr>';
        
        foreach ($dados as $ModelDepartamento) {
            echo '    <tr>';
            echo '        <td>' .$ModelDepartamento->getId(). '</td>';
            echo '        <td>' .$ModelDepartamento->getNome(). '</td>';
            echo '        <td>';
            echo '            <form method="POST" action="?p=departamento&acao=deletar">
                                  <button type="submit" name="reg" value="' .$ModelDepartamento->getId(). '" >Deletar</button>
                              </form>' ;
            echo '        </td>';
            echo '    </tr>';
        }

        echo '    </tr>';
        echo '</table>';
    }

    public function montaFormularioCadastro() {
?>
    <form method="POST" action="?p=departamento&acao=cadastrar">
        <div>
            <strong>Nome do Departamento: </strong>
        </div>
        <div>
            <input type="text" name="nome" required />
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
<?php
    }

}