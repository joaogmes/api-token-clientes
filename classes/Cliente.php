<?php

class Cliente{
	private $cnpj;
	private $nome;
	private $token;
	private $status;

	public function consulta($token){
		try{
		$host = "br920.hostgator.com.br";
		$dbname = "jotagome_api";
		$user = "jotagome_uapi";
		$pass = "Nkmm23#";
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			// $conn = new PDO('mysql:host=localhost;dbname=api', 'root', '');
		}catch(Exception $e){
			return $e->getMessage();
		}


		$consulta = $conn->prepare("SELECT status FROM cliente WHERE token = '".$token."'");
		$consulta->execute();
		
		if($consulta->rowCount() > 0){
			$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
			$status = $resultado['status'];
			header("Content-type: application/json; charset=utf-8");
			return json_encode($resultado);
		}else{
			throw new Exception("Nenhum resultado encontrado com o token informado");
		}

	}

	public function cadastrar($cnpj, $nome, $status){
		try{
			$conn = new PDO('mysql:host=localhost;dbname=api', 'root', '');
		}catch(Exception $e){
			return $e->getMessage();
		}

		$token = strtotime(date('d/m/y H:i:s.u'));
		$token = sha1($token);

		$verificarToken = $conn->prepare("SELECT token FROM cliente WHERE token = $token");
		$verificarToken->execute();

		if($verificarToken->rowCount() == 0){
			$insercao = "INSERT into CLIENTE VALUES('', '$cnpj', '$nome', '$token', '$status')";
			$insercao = $conn->prepare($insercao);
			try{
				$insercao->execute();
				return "Cadastro efetuado com sucesso. Token = ".$token;
			}catch(Exception $e){
				throw new Exception($e->getMessage());
				
			}
			
		}else{
			throw new Exception('Token já existe, tente novamente!');
		}
	}
}

?>