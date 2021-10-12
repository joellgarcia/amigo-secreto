<?php

namespace App\Models;

if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}

use PDO;

class Pessoa extends Conn {

    private $conn;
    private $pessoa;
    private $valida = false;
    private $resultadoDB;

    public function listar() {
        $this->conn = $this->connect();
        $query_pessoas = "SELECT * FROM pessoas ORDER BY nome";
        $result_pessoas = $this->conn->prepare($query_pessoas);
        $result_pessoas->execute();
        $retorno = $result_pessoas->fetchALL();
        return $retorno;
    }

    public function buscarPessoa(string $id) {
        //$this->pessoa = $pessoa;
        $this->conn = $this->connect();
        $query_cad_pessoa = "SELECT * FROM pessoas WHERE id = :id";

        $cad_pessoa = $this->conn->prepare($query_cad_pessoa);
        $cad_pessoa->bindValue(":id", $id, PDO::PARAM_STR);
        $cad_pessoa->execute();
        $retorno = $cad_pessoa->fetch();
        return $retorno;
    }

    public function deletarPessoa(string $id) {
        echo "AQUI " . $id;
        $this->pessoa = $pessoa;
        $this->pessoa = $this->buscarPessoa($id);
        var_dump($this->pessoa);
        $this->conn = $this->connect();
        $query_deleta_pessoa = "DELETE FROM pessoas WHERE pessoas.id = :id";
        $deleta_pessoa = $this->conn->prepare($query_deleta_pessoa);
        $deleta_pessoa->bindValue(":id", $id, PDO::PARAM_STR);
        $deleta_pessoa->execute();
        if ($deleta_pessoa->rowCount()) {
            $_SESSION['msg_home'] = $this->pessoa['nome'] . " removido(a) com sucesso!";
            return true;
        } else {
            $_SESSION['msg_home_erro'] = "Erro: problema ao deletar o cadastro do usuário.<br>" . $this->pessoa['nome'];
            return false;
        }
    }

    public function atualizar(array $pessoa = null) {
        $this->pessoa = $pessoa;
        $this->conn = $this->connect();
        $query_atualiza_pessoa = "UPDATE pessoas SET nome = :nome, email = :email WHERE pessoas.id = :id";
        $atualiza_pessoa = $this->conn->prepare($query_atualiza_pessoa);
        $atualiza_pessoa->bindParam(":nome", $this->pessoa['nome'], PDO::PARAM_STR);
        $atualiza_pessoa->bindParam(":email", $this->pessoa['email'], PDO::PARAM_STR);
        $atualiza_pessoa->bindParam(":id", $this->pessoa['id'], PDO::PARAM_STR);
        $atualiza_pessoa->execute();
        if ($atualiza_pessoa->rowCount()) {
            $_SESSION['msg_sucesso'] = $this->pessoa['nome'] . " atualizado(a) com sucesso!";
            return true;
        } else {
            $_SESSION['msg'] = "Erro: problema ao atualizar o cadastro do usuário.";
            return false;
        }
    }

    public function cadastrar(array $pessoa = null) {
        $this->pessoa = $pessoa;
        $this->conn = $this->connect();
        $query_cad_pessoa = "INSERT INTO pessoas 
                (nome, email) 
                VALUES 
                (:nome, :email);";
        $cad_pessoa = $this->conn->prepare($query_cad_pessoa);
        $cad_pessoa->bindParam(":nome", $this->pessoa['nome'], PDO::PARAM_STR);
        $cad_pessoa->bindParam(":email", $this->pessoa['email'], PDO::PARAM_STR);
        $cad_pessoa->execute();
        if ($cad_pessoa->rowCount()) {
            $_SESSION['msg_home'] = $this->pessoa['nome'] . " cadastrado(a) com sucesso!";
            return true;
        } else {
            $_SESSION['msg'] = "Erro: usuário não cadastrado.";
            return false;
        }
    }

    public function buscar($pesquisa) {
        $this->conn = $this->connect();

        $termos = explode(" ", $pesquisa);
        //var_dump($termos);

        $query_pessoas = 'SELECT * FROM pessoas WHERE ';

        foreach ($termos as $key => $value) {
            $query_pessoas .= "nome LIKE '%" . $value . "%' OR email LIKE '%" . $value . "%' OR ";
        }

        $query_pessoas = substr($query_pessoas, 0, -3);

        $result_pessoas = $this->conn->prepare($query_pessoas);
        $result_pessoas->execute();
        $retorno = $result_pessoas->fetchALL();
        return $retorno;
    }

    public function validaFormCadastro(array $pessoa = null) {
        $this->pessoa = $pessoa;
        $this->conn = $this->connect();
        $query_valida_usuario = "SELECT email FROM pessoas WHERE email =:email LIMIT 1";
        $result_verifica_email = $this->conn->prepare($query_valida_usuario);
        $result_verifica_email->bindParam(":email", $this->pessoa['email'], PDO::PARAM_STR);
        $result_verifica_email->execute();
        $this->resultadoDB = $result_verifica_email->fetch();
        if ($this->resultadoDB) {
            $this->valida = false;
            $_SESSION['msg'] = "<p style='color: #ff0000;'>Email já cadastrado.</p>";
        } else {
            $this->valida = true;
        }
    }

    function getValida(): bool {
        return $this->valida;
    }

}
