<?php

if(empty($_POST['id'])){
	echo "Esse script nao pode ser acessado diretamente!";
}else{
	
	$id = $_POST['id'];
		
	//Primeiro conectar ao banco
	$conexao = mysqli_connect("localhost","root","","tecweb");
	
	if(!$conexao){
		echo "Erro ao conectar no banco!";
	}else{
		$sql = "SELECT * FROM receitas WHERE id=".$id.";";
		
		$query = mysqli_query($conexao,$sql);
		
		$listReceitas = [];

		while($dados = mysqli_fetch_array($query)){
            array_push($listReceitas, ["id"=> utf8_encode($dados ['id']),
				"nome"=> utf8_encode($dados ['nome']), 
				"url"=>utf8_encode($dados['url']),
				"receita"=>utf8_encode($dados['receita']),
				"votos"=>utf8_encode($dados['votos'])
            ]);
		}
		echo json_encode($listReceitas);
	}
}
?>