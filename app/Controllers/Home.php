<?php

namespace App\Controllers;

if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}

class Home {

    private $dados;

    public function index() {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['Pesquisar'])) {
            $this->busca($this->dados['pesquisa']);
        }
        $listarPessoas = new \App\Models\Pessoa;
        if (empty($this->dados['pessoas'])) {
            $this->dados['pessoas'] = $listarPessoas->listar();
        }
        $carregarView = new \Core\ConfigView("Views/home/index", $this->dados);
        $carregarView->renderizar();
    }

    private function busca($pesquisa) {
        $pessoa = new \App\Models\Pessoa();
        $this->dados['pessoas'] = $pessoa->buscar($pesquisa);
    }

}
