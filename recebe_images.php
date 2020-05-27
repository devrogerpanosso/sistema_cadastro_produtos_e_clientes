<?php
		//inicia sessão
		session_start();

		//recebe dados da requisicao "form" recuperando dados do arquivo $_FILES
		if(isset($_FILES["arquivo"]) AND !empty($_FILES["arquivo"])) {
			echo "<pre>";
			print_r($_FILES["arquivo"]);
			echo "</pre>";
		}else {
			echo "Arquivo não informado";
		}

		//testa se extensões dos arquivos "imgs" a serem enviados são validos
		//armazena extensões da image em variavel composta array
		$extensoes = array("image/jpg","image/jpeg","image/png","image/svg");
		if(in_array($_FILES["arquivo"]["type"], $extensoes)) {
			//sendo validas as extensões do arquivo, verifica se há conteudo na 
			//pasta temporaria em que os arquivos é armazenado no servidor tempora
			//riamente ["tmp_name"] e realiza movimentação
			if(isset($_FILES["arquivo"]["tmp_name"]) AND !empty($_FILES["arquivo"]["tmp_name"])) {
				move_uploaded_file($_FILES["arquivo"]["tmp_name"], "imgs/" . $_FILES["arquivo"]["name"]);
				//executa sessão de arquivo valido
				$_SESSION["arquivo_valido"] = "
				<div class='container'>
					<div class='row'>
						<div class='col-lg-12 text-center'>
							<div class='alert alert-primary' role='alert'>
								<span class='text-success text-center' style='font-family:verdana;'>
									Arquivo enviado com Suscesso, pois a extenção é valida !!
								</span>
							</div>
						</div>
					</div>
				</div>";
				header("Location:enviar_images.php");
				exit;
			}
		}else {
			//caso o arquivo a ser enviado seja com outras extensões
			//define sessão de arquivo invalido
			$_SESSION["arquivo_invalido"] = "
			<div class='container'>
				<div class='row'>
					<div class='col-lg-12 text-center'>
						<div class='alert alert-primary text-center' role='alert'>
							<span class='text-danger text-center' style='font-family:verdana;'>
								Arquivo Invalido. Pois a extenção não é valida !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:enviar_images.php");
			exit;
		}

		
?>