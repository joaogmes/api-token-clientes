<?php
require_once('classes/Cliente.php');
if(isset($_REQUEST['token'])){
	$token = $_REQUEST['token'];
	$cliente = new Cliente;
	try{
		$consulta = $cliente->consulta($token);
		
		echo $consulta;
	}catch(Exception $e){
		echo $e->getMessage();
	}
}else{
	if(isset($_REQUEST['cadastrar'])){
		$cliente = new Cliente;
		try{
			$cnpj = $_REQUEST['cnpj'];
			$nome = $_REQUEST['nome'];
			$status = $_REQUEST['status'];
			$token = $cliente->cadastrar($cnpj,$nome,$status);
			echo "<h3>".$token."</h3>";
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>API Jota Gomes</title>
		<link rel="stylesheet" href="">
		<style type="text/css" media="screen">
			*{
				color:white;
			}
			body{
				overflow: hidden;
				overflow: hidden;
				font-family: 'Calibri Light';
				background: #070d22;
			}
			h3{
				font-size:2em;
				color:#f60;
			}
			p{
				font-size: 1.5em;
			}
			button{
				width: 50%;
				background: #f60;
				padding: 1rem;
				color: #fff;
				font-weight: 700;
				font-family: Calibri;
				font-size: 1.5rem;
				border-radius: 1rem;
				box-shadow: 1px 1px 1rem #e3e3e3;
			}
			button:hover{
				cursor: pointer;
			}
			.center
			{
				display: grid;
				align-content: center;
				width: 100vw;
				height: 100vh;
				vertical-align: middle;
				overflow: hidden;
			}
			.center div
			{
				height: auto;
				width: 50vw;
				background: #fdfdfd;
				border-radius: 2rem;
				margin: auto;
				text-align: center;
				padding: 2rem;
				box-shadow: 1px 1px 2rem #000;
				color:#333;
			}
		</style>
	</head>
	<body>
		<div class="center">
			<div>
				<h3>API de consultas Jota Gomes</h3>
				<p>Para obter nosso manual e entender como usar a API entre em contato pelo botão abaixo:</p>
				<button type="btn" onclick="window.open('https://wa.me/5517988251166')">Contato</button>
			</div>
		</div>
	</body>
	</html>

	<?php
}
?>