<?php

namespace App\Controllers;

if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}

class Cadastrar {

    private $dados;
    private $dadosBanco;
    private $id;

    public function index() {

        $this->id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $pessoa = new \App\Models\Pessoa();

        if (!empty($this->dados['AtualizarPessoa'])) {
            $this->dadosBanco = $pessoa->buscarPessoa($this->id);
            if (!empty(array_diff($this->dadosBanco, $this->dados))) {
                $pessoa->atualizar($this->dados);
            } else {
                $_SESSION['msg_aviso'] = "Nenhuma alteração encontrada.";
            }
        }

        if (!empty($this->dados['CadastrarPessoa'])) {
            if ($this->validaCampos()) {
                $pessoa->validaFormCadastro($this->dados);
                if ($pessoa->getValida()) {
                    $pessoa->cadastrar($this->dados);
                    $urlDestino = "/amigo-secreto/";
                    header("Location: $urlDestino");
                }
            }
        }

        if (!empty($this->id)) {
            $this->dados = $pessoa->buscarPessoa($this->id);
        }

        $this->dados['form'] = $this->dados;
        $carregarView = new \Core\ConfigView("Views/pessoa/cadastro", $this->dados);
        $carregarView->renderizar();
    }

    private function validaCampos(): bool {
        if ((strlen($this->dados['nome']) > 0) AND (strlen($this->dados['email']) > 0)) {
            return true;
        } else {
            $_SESSION['msg'] = "Por favor, preencha todos os campos.";
            return false;
        }
    }

}
