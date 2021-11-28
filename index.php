<?php

use Src\Controllers\Departamento;
use Src\Controllers\Funcionario;

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
        new Funcionario;
        break;
    default:
        echo 'Home page';
        break;
}