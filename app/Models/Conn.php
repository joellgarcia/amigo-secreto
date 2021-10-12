<?php

namespace App\Models;

if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}

use PDO;

class Conn {

    private $db = "mysql";
    private $host = "db";
    private $user = "admin";
    private $pass = "admin";
    private $dbname = "amigo-secreto";
    private $port = 3306;
    private $connect;

    protected function connect() {
        try {
            $this->connect = new PDO($this->db . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname, $this->user, $this->pass);
            return $this->connect;
        } catch (Exception $ex) {
            die('Erro: Por favor tente novamente. Caso o problema 
                persista, entre em contato com o administrador 
                <a href="mailto:joell.garcia@gmail.com">
                joell.garcia@gmail.com</a>.</br></br>');
        }
    }

}
