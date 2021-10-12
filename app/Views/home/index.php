<?php
if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}
?>
<div class="mx-auto" style="width: 800px;">
    <div class="row">
        <p class="h1">Amigo Secreto</p>
    </div>
    <div class="row">
        <p class="h3">Lista de participantes</p>
    </div>
    <div class="row">
        <?php
        if (isset($_SESSION['msg_home'])) {
            echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
            echo $_SESSION['msg_home'];
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">"
            . "<span aria-hidden=\"true\">&times;</span>"
            . "</button>";
            echo "</div>";

            unset($_SESSION['msg_home']);
        }
        if (isset($_SESSION['msg_home_erro'])) {
            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
            echo $_SESSION['msg_home_erro'];
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">"
            . "<span aria-hidden=\"true\">&times;</span>"
            . "</button>";
            echo "</div>";

            unset($_SESSION['msg_home_erro']);
        }
        ?>
    </div>
    <?php if (sizeof($this->dados['pessoas']) > 0): ?>
        <div class="row">
            <form method="POST" action="" class="form-inline my-2 my-lg-0 input-group mt-">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
                <input name="pesquisa" class="form-control mr-sm-2" type="text" placeholder="Nome ou Email" aria-label="Search"/>
                <input name="Pesquisar" class="btn btn-primary my-2 my-sm-0" type="submit" value="Pesquisar" style="margin-right: 5px;">
                <a href="/amigo-secreto/" class="btn btn-outline-primary my-2 my-sm-0">Limpar</a>
            </form>
        </div>
        <br>
        <div class="row">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Participante</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->dados['pessoas'] as $pessoa) {
                        extract($pessoa);

                        $pessoaJSON = json_encode($pessoa);

                        echo "<tr><td>" . $nome . "</td> <td><a href = \"mailto:" . $email . "\">" . $email . "</a></td><td class=\"text-center\">";
                        echo "<a href=\"/amigo-secreto/cadastrar/?id=$id\" style=\"color: #000000;\"><i class = \"fa fa-pencil-square-o\" aria-hidden=\"true\" style=\"margin-right: 15px;\"></i></a>"
                        . "<a data-toggle=\"modal\" data-target=\"#confirm-delete\" style=\"color: #dc3545;\" data-id=\"$id\" data-nome=\"$nome\" ><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="alert alert-light" role="alert">
                Nenhum participante cadastrado
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <a href="/amigo-secreto/cadastrar/" class="btn btn-primary btn-lg" role="button" aria-pressed="true" style="margin-right: 4px;">Cadastrar</a>
        <?php if (sizeof($this->dados['pessoas']) > 2): ?>
            <a href="/amigo-secreto/sortear/" class="btn btn-primary btn-lg" role="button" aria-pressed="true" style="margin-right: 4px;">Sortear</a>
        <?php endif; ?>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Confirmação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseja confirmar a exclusão do cadastro<br>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger btn-ok">Confirmar</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $('#confirm-delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var nome = button.data('nome');
        var id = button.data('id');
        var modal = $(this);
        var href = "/amigo-secreto/deletar/?id=" + id;
        modal.find('.modal-body').text('Deseja excluir o cadastro de: ' + nome + '?');
        modal.find('.btn-ok').attr('href', href);
    });
</script>