<?php
		//inicia sessão
		session_start();

		if(isset($_SESSION["usuario"]) AND !empty($_SESSION["usuario"])) {
			//finaliza sessão
			unset($_SESSION["usuario"]);
			header("Location:login.php");
			exit;
		}else {
			echo "<p class='text text-danger'>Sessão de usuario não existente !!</p>";
		}
?>