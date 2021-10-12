<div class="mx-auto" style="width: 840px;">
    <nav class="shadow p-3 mb-5 bg-white rounded navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/amigo-secreto/"><img src="/amigo-secreto/imagens/logo.png"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == "/amigo-secreto/"){ echo "active";} ?>">
                    <a class="nav-link" href="/amigo-secreto/">Home <span class="sr-only">(Página atual)</span></a>
                </li>
                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == "/amigo-secreto/cadastrar/"){ echo "active";} ?>">
                    <a class="nav-link" href="/amigo-secreto/cadastrar/">Cadastrar</a>
                </li>
                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == "/amigo-secreto/sortear/"){ echo "active";} ?>">
                    <a class="nav-link" href="/amigo-secreto/sortear/">Sortear</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
