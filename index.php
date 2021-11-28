<?php

use Src\Controllers\Departamento;

require __DIR__ . '/vendor/autoload.php';

echo '<div>';
echo '    <a href="?p=departamento">Departamento</a>';
echo '    <a href="?p=funcionario">Funcionário</a>';
echo '</div>';

switch ($_GET['p']) {
    case 'departamento':
        new Departamento;
        break;
    case 'funcionario':
        echo 'Carrega funcionário';
        break;
    default:
        echo 'Home page';
        break;
}