<?php
session_start();
ob_start();
include_once("./conection/conexao.php");

if(isset($_POST['save_marker'])) {

	//Receber os dados do formulário
	$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
        if($dados['select'] == "enchente") {
          $option = 1;
        }
        else if($dados['select'] == "poluicao") {
		  $option = 2;
        }
        else if($dados['select'] == "iluminacao") {
	      $option = 3;
        }
        else if($dados['select'] == "buraco") {
		  $option = 4;
        }
        else if($dados['select'] == "engarrafamento") {
		  $option = 5;
        }
	$latitu = $_COOKIE['lat'] + 0.002197;
	$longi = $_COOKIE['lng'] + 0.0069549;

	$user_id = $_SESSION['id'];

	//Salvando marcador
	$resultado_markers = $conn->query("INSERT INTO markers(name, address, lat, lng, user_id) 
					VALUES 
					('".$dados['name']."', '".$dados['address']."', '".$latitu."', '".$longi."','".$user_id."');");
					
	if($conn->lastInsertId()){

	   $last_id = $conn->lastInsertId();

		$_SESSION['msg'] = "<span style='color: green';>Endereço cadastrado com sucesso!</span>";
		header("Location: mapa.php");	
	}else{
		$_SESSION['msg'] = "<span style='color: red';>Erro: Endereço não foi cadastrado com sucesso!</span>";
		header("Location: mapa.php");	
	}


	/* Salvando relato */
	$r = $conn->query("INSERT INTO tb_relato(cd_problema, nm_problema, id_marker_relato) 
			  	VALUES('$option', '".$dados['select']."', '$last_id')");

	if($conn->lastInsertId()) {

		$_SESSION['msg'] = "<span style='color: green';>Endereço cadastrado com sucesso!</span>";
		header("Location: mapa.php");	
	}else{
		$_SESSION['msg'] = "<span style='color: red';>Erro: Endereço não foi cadastrado com sucesso!</span>";
		header("Location: mapa.php");	
	} 
}