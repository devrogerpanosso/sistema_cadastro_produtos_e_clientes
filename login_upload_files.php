<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<title>Login | Enviar Images</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="loginUploadImgs img-responsive img-fluid">
	<article>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<hgroup>
							<div class="p-4"></div>
							<H1 class="page-header text-center text-capitalize lead" style="font-size:40px; color:#34A96F;">
								Login
							</H1>
						</hgroup>
					</div>
				</div>
				<a class="nav-link-item link-striped alert-link badge badge-success" title="Página Inicial" href="index.php">
					Página Incial
				</a>
			</div>
		</header>
		<?php
			//define sessão de login
			session_start();
			if(isset($_SESSION["login"]) AND !empty($_SESSION["login"])) {
				echo $_SESSION["login"];
				//destroi dados da sessão
				session_destroy();
				//finaliza sessão
				unset($_SESSION["login"]);
			}
		?>
		<hr class="bg-success">
		<section>
			<div class="p-1"></div>
			<div class="container">
				<form name="login_upload" method="POST" action="valida_login_upload.php">
					<div class="form-row">
						<div class="col-lg-12">
							<div class="form-group">
								<label style="padding-right:5px;" class="text text-warning form-text" for="usuario">
									<img src="imgs/user.png" class="img-responsive img-fluid" title="Usuário">
								</label>
								<input type="text" name="usuario" class="form-control form-control-lg border border-info" autocomplete="off" placeholder=" Informe seu Usuário.. " id="usuario" required/>
								<small class="form-text text text-warning" style="font-family:verdana;">Não compartilharemos esta informação.</small>
							</div>
						</div>
						<div class="p-1"></div>
						<div class="col-lg-12">
							<div class="form-group">
								<label style="padding-right:5px;" class="text text-warning form-text" for="usuario">
									<img src="imgs/password.png" class="img-responsive img-fluid" title="Usuário">
								</label>
								<input type="password" name="senha" class="form-control form-control-lg border border-info" autocomplete="off" placeholder=" Informe sua Senha.. " id="senha" required/>
								<small class="form-text text text-warning" style="font-family:verdana;">Não compartilharemos esta informação.</small>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<button type="submit" class="btn btn-skin btn-lg btn-success">Entrar</button>
								<button type="reset" class="btn btn-skin btn-lg btn-danger">Resetar Dados</button>
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