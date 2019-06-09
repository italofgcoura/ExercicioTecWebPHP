<?php

//serviços que vai necessitar
//só vai funcionar se o get do serviço não estiver vazio

if (!empty($_GET['servico'])) {
    $servico = $_GET['servico'];

    //pode conectar a partir daqui porque quando entra aqui quer dier que tem 
    //um pedido de serviço

    //primeiro -> CONECTAR COM O BANCO
    //mysqli_connect("servidor","login","senha","banco");


    $conexao = mysqli_connect("localhost", "root", "", "tecweb");
    if (!$conexao) {
        echo "ERRO AO CONECTAR NO BANCO!!!";
    } else {


        //listar
        if ($servico == "listar") {
            //faz o sleect no banco 
            $sql = "SELECT * FROM receitas;";

            //pedido de informação ao banco, recebe a coneção e o select do sql
            $query = mysqli_query($conexao, $sql);

            //variável com vetor de receitas
            $listaReceitas = [];

            while ($dados = mysqli_fetch_array($query)) {

                array_push(
                    $listaReceitas,
                    [
                        "id" => $dados['id'], "votos" => $dados['votos'],
                        "nome" => $dados['nome'], "url" => $dados['url'], "descricao" => $dados['descricao']
                    ]
                );
            }
            echo json_encode($listaReceitas);
        }


        //inserir
        if ($servico == "inserir" && !empty($_POST['nome']) && !empty($_POST['url']) && !empty($_POST['descricao'])) {



            $nome = $_POST['nome'];
            $url = $_POST['url'];
            $descricao = $_POST['descricao'];


            $sql = "INSERT INTO `receitas` (`nome`, `url`, `descricao`) VALUES('" . $nome . "', '" . $url . "', '" . $descricao . "');";
            //   $sql = "INSERT INTO `churrasco` (`produto`, `url_img`, `quant`) VALUES('".$produto."', '".$url_img."', 0);";


            $query = mysqli_query($conexao, $sql);

            if ($query) {
                echo '1';
            } else {
                echo '0';
            }
        }

        //deletar
        if ($servico == "deletar" && !empty($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM receitas WHERE id=" . $id . ";";

            $query = mysqli_query($conexao, $sql);

            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }

        //adicionaro+1 - votar
        if ($servico == "votar" && !empty($_GET['id'])) {

            $id = $_GET['id'];

            $sql = "UPDATE receitas SET votos = (votos+1) WHERE id=" . $id . ";";

            $query = mysqli_query($conexao, $sql);

            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }
} else {
    echo "Este script não pode ser acessado diretamente!";
}
