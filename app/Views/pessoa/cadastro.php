<?php
if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}

if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
?>

<div class="mx-auto" style="width: 800px;">
    <div class="row">
        <h1>Cadastro de Pessoa</h1>
    </div>
    <div class="row">
        <form method="POST" action="" class="form-group">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input name="nome" 
                       id="nome"
                       type="text" 
                       placeholder="Digite seu nome" 
                       value="<?php
                       if (isset($valorForm['nome'])) {
                           echo $valorForm['nome'];
                       }
                       ?>"
                       class="form-control" id="nome"
                       />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" 
                       id="email"
                       type="email" 
                       placeholder="nome@exemplo.com"
                       value="<?php
                       if (isset($valorForm['email'])) {
                           echo $valorForm['email'];
                       }
                       ?>"
                       class="form-control" id="email" aria-describedby="emailHelp"
                       />
            </div>
            <input name="id" type="hidden" value="<?php
            if (isset($valorForm['id'])) {
                echo $valorForm['id'];
            }
            ?>"/>
                   <?php if (empty($valorForm['id'])): ?>
                <input name="CadastrarPessoa" id="btnCadastrar" type="submit" value="Cadastrar" class="btn btn-primary" />
            <?php else: ?>
                <input name="AtualizarPessoa" id="btnCadastrar" type="submit" value="Salvar" class="btn btn-primary" />
            <?php endif; ?>
        </form>
    </div>
    <div class="row">
        <?php
        if (isset($_SESSION['msg'])) {
            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">" .
            $_SESSION['msg'] .
            "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" .
            "<span aria-hidden=\"true\">&times;</span>" .
            "</button>" .
            "</div>";
            unset($_SESSION['msg']);
        }

        if (isset($_SESSION['msg_sucesso'])) {
            echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
            echo $_SESSION['msg_sucesso'];
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">"
            . "<span aria-hidden=\"true\">&times;</span>"
            . "</button>";
            echo "</div>";

            unset($_SESSION['msg_sucesso']);
        }

        if (isset($_SESSION['msg_aviso'])) {
            echo "<div class=\"alert alert-primary alert-dismissible fade show\" role=\"alert\">";
            echo $_SESSION['msg_aviso'];
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">"
            . "<span aria-hidden=\"true\">&times;</span>"
            . "</button>";
            echo "</div>";

            unset($_SESSION['msg_aviso']);
        }
        ?>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#nome').on('input change', function () {
            verificaCampos();
        });

        $('#email').on('input change', function () {
            verificaCampos();
        });

        function verificaCampos() {
            if ($('#nome').val() !== '' && $('#email').val()) {
                $('#btnCadastrar').prop('disabled', false);
            } else {
                $('#btnCadastrar').prop('disabled', true);
            }
        }
    });
</script>