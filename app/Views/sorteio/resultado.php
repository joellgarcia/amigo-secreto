<?php
if (!defined('$6$eMmqoT8N2tnAVIyf$cifHy5UCzc2KtQa/y9mqZ4z')) {
    header("Location: /amigo-secreto/");
    die("Erro: página não encontrada.");
}
?>
<div class="mx-auto" style="width: 800px;">
    <div class="row">
        <h1>Resultado do sorteio</h1>
    </div>

    <?php
    echo "Número de participantes: " . sizeof($this->dados['resultado']) . "<br><br>";
    if (sizeof($this->dados['resultado']) > 2) {
        foreach ($this->dados['resultado'] as $row) {
            echo "<div class = \"card bg-light mb-3\" style = \"max-width: 18rem;\">";
            echo "<div class = \"card-body\">";
            echo "<h5 class = \"card-title\">" . $row[0]['nome'] . "</h5>";
            echo "<h6 class = \"card-subtitle mb-2 text-muted\">tirou</h6>";
            echo "<p class = \"card-text\">" . $row[1]['nome'] . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        //echo "Entrou no else<br><br>";
        echo "<div class = \"alert alert-danger\" role = \"alert\">";
        echo "Necessário no mínimo 3 participantes para realizar o sorteio!</br>";
        echo "<a href=\"/amigo-secreto/cadastrar/\">Cadastre mais participantes</a>";
        echo "</div>";
    }
    ?>
</div>
</div>