<?php
	
$descricao = $_POST['descricao'];
$nome = $_POST['nome'];
$url = $_POST['url'];

//Primeiro conectar ao banco
$conexao = mysqli_connect("localhost","root","","tecweb");

if(!$conexao){
    echo "Erro ao conectar no banco!";
}else{
    $sql = "INSERT INTO receitas(id, nome, url, descricao, votos) VALUES (NULL,'".$nome."','".$url."','".$descricao."',0)";

    $query = mysqli_query($conexao,$sql);
    $listReceitas = [];
    
    echo $query;
	}

?>