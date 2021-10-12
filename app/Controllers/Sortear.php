<?php

namespace App\Controllers;

class Sortear {

    private $dados;

    public function index() {

        $listarPessoas = new \App\Models\Pessoa;
        $this->dados['pessoas'] = $listarPessoas->listar();
        $this->dados['resultado'] = $this->sorteia($this->dados['pessoas']);
        $carregarView = new \Core\ConfigView("Views/sorteio/resultado", $this->dados);
        $carregarView->renderizar();
    }

    function sorteia($participantes) {
        $participantes_tmp = $participantes;
        $resultado = array();
        $i = 0;

        if (count($participantes) == 1) {
            $resultado = $participantes;
        } else {
            while ($i < count($participantes)) {
                if ($participantes[$i] == $participantes_tmp[$i]) {
                    $i = 0;
                    shuffle($participantes);
                } else
                    $i++;
            }

            foreach ($participantes_tmp as $k => $v)
                $resultado[] = array($v, $participantes[$k]);
        }
        return $resultado;
    }

}
