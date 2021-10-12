<?php

namespace Core;

if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}

class ConfigView {

    private $nome;
    private $dados;

    public function __construct($nome, array $dados = null) {
        $this->nome = $nome;
        $this->dados = $dados;
    }

    public function renderizar() {
        if (file_exists('app/' . $this->nome . '.php')) {
            include('app/' . $this->nome . '.php');
        } else {
            echo "</br></br>Erro ao carregar a página</br>";
            echo "Erro ao carregar a View: {$this->nome}</br>";
        }
    }

}
