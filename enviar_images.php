<?php
		//define sessão de login para manipulação de arquivos
		session_start();
		if(isset($_SESSION["usuario_files"]) AND !empty($_SESSION["usuario_files"])) {
			//echo $_SESSION["usuario_files"];
		}else {
			header("Location:login_upload_files.php");
			exit;
		}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Developer Roger Panosso</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="bg-dark">
	<article>
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="p-4"></div>
						<H1 class="page-header text-center text-primary lead" style="font-size:36px;">
							Enviar Arquivos
						</H1>
					</div>
				</div>
			</div>
			<div class="p-1"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="p-2"></div>
						<a class="nav-link-item text-center link-striped badge badge-success" title="Página Incial" href="index.php">
							Página Incial
						</a>
					</div>
					<div class="col-lg-6">
						<img src="imgs/user.png" width="42" class="img-responsive img-fluid" title="Usuário Logado"/>
						<span class="text text-success m-1" style="font-family:verdana;"><?php echo $_SESSION["usuario_files"];?></span>
						<a class="nav-link-item link-striped alert-link m-2" style="text-decoration:none" title="Finalizar Sessão" href="sair_upload.php">
							<img src="imgs/off.png" width="40" class="img-responsive img-fluid" title="Finalizar Sessão"/>
						</a>
						<span class="text text-success" style="font-family:verdana;">Encerrar Sessão</span>
					</div>
				</div>
			</div>
		</header>
		<div class='p-1'></div>
		<?php
			//define sessão de envio de arquivo valido
			if(isset($_SESSION["arquivo_valido"]) AND !empty($_SESSION["arquivo_valido"])) {
				echo $_SESSION["arquivo_valido"];
				//finaliza sessão
				unset($_SESSION["arquivo_valido"]);
			}

			//define sessão de arquivo invalido
			if(isset($_SESSION["arquivo_invalido"]) AND !empty($_SESSION["arquivo_invalido"])) {
				echo $_SESSION["arquivo_invalido"];
				//finaliza sessão
				unset($_SESSION["arquivo_invalido"]);
			}
		?>
		<hr class="bg-success">
		<section>
			<div class="container">
				<form name="images" method="POST" action="recebe_images.php" enctype="multipart/form-data">
					<div class="form-row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text text-warning" style="font-family:verdana;">Enviar Arquivo</label>
								<input type="file" name="arquivo" class="form-control-file form-control-lg border border-info" autocomplete="off" id="arquivo" required/>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<button class="btn btn-skin btn-lg btn btn-success" type="submit">Enviar Arquivo</button>
								<button class="btn btn-skin btn-lg btn btn-danger" type="reset">Resetar Arquivo</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</section>
	</article>	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"/></script>
	<script type="text/javascript" src="bootstrap/js/script.js"/></script>
</body>
</html>