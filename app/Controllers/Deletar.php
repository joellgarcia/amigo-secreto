<?php

namespace App\Controllers;

if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}

class Deletar {

    private $id;

    public function index() {

        $this->id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
        $pessoa = new \App\Models\Pessoa();

        $pessoa->deletarPessoa($this->id);

        $urlDestino = "/amigo-secreto/";
        header("Location: $urlDestino");
    }

}
