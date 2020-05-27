<?php
		//inicia sessão
		session_start();

		//recebe dados da requisicao "form" 
		$imagem = filter_input(INPUT_POST, "imagem", FILTER_SANITIZE_SPECIAL_CHARS) ?? "Imagem não Selecionada";

			//adiciona proteção contra sqlinjection ao dado
			if(isset($imagem) AND !empty($imagem)) {
				$imagem_selecionada = addslashes(htmlspecialchars(trim($imagem))) ?? "Imagem não Selecionada";
				echo "<strong>Imagem selecionada para exclusão: </strong>" . $imagem_selecionada;
				echo "<br>" . PHP_EOL;
			}else {
				echo "Imagem não Selecionada !!";
			}

			//Realiza exclusão da imagem do sistema
			if(unlink("imgs/".$imagem_selecionada)) {
				echo "Imagem Excluida com suscesso !!";
				//Define sessão de exclusão de image
				$_SESSION["img_delete"] = "
				<div class='container'>
					<div class='row'>
						<div class='col-lg-12'>
							<div class='alert alert-primary text-center' role='alert'>
								<span class='text-center text-capitalize text-success lead'>Imagem Excluida Com Suscesso !!</span>
							</div>
						</div>
					</div>
				</div>";
				header("Location:deletar_images.php");
				exit;
			}else {
				//Define sessão de imagem invalida ou não existente
				$_SESSION["img_invalida"] = "
				<div class='container'>
					<div class='row'>
						<div class='col-lg-12'>
							<div class='alert alert-primary text-center' role='alert'>
								<span class='text-center text-capitalize text-danger lead'>Imagem Não Existente ou Nome Invalido !!</span>
							</div>
						</div>
					</div>
				</div>";
				header("Location:deletar_images.php");
			}
?>