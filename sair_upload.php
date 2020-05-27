<?php
		//define sessão
		session_start();

		//verifica se existe sessão de usuario para upload
		if(isset($_SESSION["usuario_files"]) AND !empty($_SESSION["usuario_files"])) {
			//destroi dados da sessão
			session_destroy();
			//finaliza sesão
			unset($_SESSION["usuario_files"]);
			header("Location:index.php");
			exit;
		}else {
			echo "<p class='text text-danger'>Não há sessão existente !!</p>";
		}
?>