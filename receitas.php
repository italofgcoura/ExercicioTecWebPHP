<?php

if(empty($_POST['id'])){
	echo "Esse script nao pode ser acessado diretamente!";
}else{
	
	$id_produto = $_POST['id'];
		
	//Primeiro conectar ao banco
	$conexao = mysqli_connect("localhost","root","root","tecweb");
	
	if(!$conexao){
		echo "Erro ao conectar no banco!";
	}else{
		if($id == "true"){
			$sql = "SELECT * FROM receitas;";
		}else{
			$sql = "SELECT * FROM receitas WHERE id=".$id.";";
		}
		
		$query = mysqli_query($conexao,$sql);
		
		$receitas = [];
		
		while($dados = mysqli_fetch_array($query)){
				array_push($receitas, ["nome"=>$dados['nome'],"url"=>$dados['url']]);
		}
		echo json_encode($receitas);
	}
}
?>