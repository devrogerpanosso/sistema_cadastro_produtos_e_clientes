<?php
		//estabelece conexão com MySQL
		$dsn = "mysql:dbname=images_backgrounds;port=3306;host=localhost";
		$dbuser = "root";
		$dbpass = "";

		try {
			//Realiza instancia da classe PDO criando objeto de conexão
			$connect = new PDO($dsn, $dbuser, $dbpass);
			//define metodo PDO setAttribute para prover erros internos de conexão
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if($connect == TRUE) {
				//echo "<font color='green'>Conexão estabelecida com suscesso !!</font>";
			}
		} catch (PDOException $erro) {
			echo "Erro de Conexão => " . $erro->getMessage();
		}
?>