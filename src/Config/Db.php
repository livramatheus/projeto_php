<?php

namespace Src\Config;

use PDO;

class Db {

    /**
     * @return PDO
     */
    public function getConexao() {
        return new PDO("mysql:host=localhost;dbname=desafio_php", 'root', '');
    }

}